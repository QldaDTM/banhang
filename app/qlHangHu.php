<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class qlHangHu extends Model
{
  protected $table= 'chitietkhohong';
  public $timestamps = false;
  
 	function getncc(){
      $kq= DB::select("select * from chitietkhohong,sanpham where sanpham.MaSanPham= chitietkhohong.MaSanPham");      
      return $kq;
  }
    
  function ncctable(){
    $kq=$this->getncc();
    $string='';
    foreach($kq as $mang){       
      $string.= '<tr class="text-center">';   
      $string.= '<th scope="row">'. $mang->MaNhapKhoHong  .'</th>';
      $string.= '<td>' . $mang->TenSanPham . '</td>';
      $string.= '<td>' . $mang->MaKhuHong . '</td>';
      $string.= '<td>' . $mang->SoLuong . '</td>';
      $string.= '<td>' . $mang->TinhTrang . '</td>';
      $string.= '<td>
                  <button data-toggle="modal" onclick="suancc(' . 
                     "'" .$mang->MaSanPham ."'" . ','.
                    "'" .$mang->MaNhapKhoHong ."'" . ','.
                    "'" .$mang->TenSanPham ."'" . ','.
                    "'" .$mang->MaKhuHong ."'" . ','.
                    "'" .$mang->SoLuong ."'" . ','.
                    "'" .$mang->TinhTrang ."'" . ','.  
                    ')" value="' .$mang->MaNhapKhoHong . '" data-target="#suancc" class="btn btn-primary" type="button" >Sửa</button>
                  <button data-toggle="modal" onclick="xoancc(' . "'" .$mang->MaNhapKhoHong .";".$mang->MaSanPham."'" . ')" data-target="#xoancc" class="btn btn-danger" type="button" >Xoá</button></td>';
      $string .='</tr>';
    }
    return $string;
  }


  function kiemtramaxk($id){
      $kq= DB::select("select sanpham.MaSanPham,TenSanPham,SoLuong from chitietxuatkho,sanpham where
      chitietxuatkho.MaPhieuXuatKho='$id'  and sanpham.MaSanPham=chitietxuatkho.MaSanPham");
     return count($kq);
  }
  function getmasp($id){
      $sql= DB::select("select sanpham.MaSanPham,TenSanPham,SoLuong from chitietxuatkho,sanpham where
      chitietxuatkho.MaPhieuXuatKho='$id'  and sanpham.MaSanPham=chitietxuatkho.MaSanPham");
      return $sql;
  }

  function getselectkho($masanpham){
      $sql= DB::select("select * from khohong where MaSanPham='$masanpham' ");
      return $sql;
  }
  function laysoluong($mang){
      $sql ="select MaKhu,(SoLuongChuaToiDa - SoLuongDangChua)as slcon from khohong where ";
      foreach($mang as $id){
        $sql.= " MaKhu = '$id' or";
        
      }
      $sql= substr($sql,0,strlen($sql)-2);
      $kq= DB::select($sql);
      return $kq;
    }
  function getsoluonghdxk($masp,$maxk){
      $sql = "select SoLuong from chitietxuatkho where MaPhieuXuatKho='$maxk' and MaSanPham='$masp' ";
      $kq = DB::select($sql);
     $sql="select SoLuong from nhapkhohong, chitietkhohong where 
     nhapkhohong.MaNhapKhoHong= chitietkhohong.MaNhapKhoHong and MaSanPham='$masp' and MaPhieu='$maxk'";
      $kq1= DB::select($sql); 
      if (count($kq1)>0) return  $kq[0]->SoLuong - $kq1[0]->SoLuong;
      return $kq[0]->SoLuong;
   
    }

  function getidtoinsert(){
    $sql= 'select MaNhapKhoHong from nhapkhohong order by MaNhapKhoHong DESC LIMIT 1';
    $id= DB::select($sql);
    if (count($id)==0){
      return 'HK01';
    }
    else{
      $id=substr($id[0]->MaNhapKhoHong,2)+1;
      $id =strlen($id+0)==1?'HK0'.$id : 'HK'.$id; 
      return $id;
    }
  }

  function TaoPhieuNhapKho($mang){

      $bool= true;
      $idhd=$this->getidtoinsert();
      $idtv= $mang->MaNhanVien;
      $maxk= $mang->nhapkhosubmit;
      foreach($mang->checknk as $id){
        
        $tongsp= $mang['slnk'.$id];
        $khosp= $mang['vtknk'.$id];
        
        $soluongkho=$this->laysoluong($khosp);
   
        $r='';
        foreach($soluongkho as $slk){
           $giatri=($tongsp>=$slk->slcon ? $slk->slcon:$tongsp);
          
            $sql="update khohong set SoLuongDangChua = SoLuongDangChua + ". $giatri ." where MaKhu ='".$slk->MaKhu ."'";
           
            $r.=  $slk->MaKhu.';';
            $demCount = DB::update($sql);
            if ($demCount==0) {
              return $bool= false;
            }
            
             
            if($tongsp>=$slk->slcon){
              $tongsp-= $slk->slcon;
            }
            else $tongsp= 0;
        }
      }
     
      $sql= "insert into nhapkhohong values('$idhd', now(),'$maxk', '$idtv')";
      //print_r($sql);exit();
     $check = DB::insert($sql);
      if ($check==false) return $bool= false;
      
        $sql= "insert into chitietkhohong values";
        foreach($mang->checknk as $id){
          $r=substr($r,0,strlen($r)-1);
          
          $sql.="(  '". $idhd ."' ,'".$mang['mspnk'.$id] ."', '".$r."' ,'".$mang['slnk'.$id]. "',0 ),";
          
        }
        $sql= substr($sql,0,strlen($sql)-1);
        
       
       $check = DB::insert($sql);
        if ($check==false) {
           $bool= false;
           $sql= "delete from nhapkhohong where MaPhieuNhapKho ='$idhd'";
           DB::delete($sql);
           return $bool;
        }
        return $idhd;
    }
}