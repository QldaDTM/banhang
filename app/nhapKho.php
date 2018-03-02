<?php

namespace App;

use Illuminate\Support\Facades\DB;

class nhapKho
{
  public function getselectkho($masp){
    $sql= 'select * from kho where MaSanPham = $masp';
    return DB::select($sql);
  }

  function getIdToInsert(){
    $sql= 'select MaPhieuNhapKho from phieunhapkho order by MaPhieuNhapKho DESC LIMIT 1';
    $id = DB::select($sql);
    if (count($id) == 0){
      return 'NK01';
    }
    else{
      $id = substr($id[0]->MaPhieuNhapKho,2) + 1;
      $id = strlen($id+0)==1?'NK0'.$id : 'NK'.$id; 
      return $id;
    }
  }

  function LaySoLuong($mang){
    $sql ="select MaKhu,(SoLuongChuaToiDa - SoLuongDangChua) as slcon from kho where ";
    foreach($mang as $id){
      $sql.= " MaKhu = '$id' or";     
    }
    $sql= substr($sql,0,strlen($sql)-3);
    $kq= DB::select($sql);
    return $kq;
  }

  function TaoPhieuNhapKho($mang){
    $bool= true;
    $idhd = $this->getIdToInsert();
    $idtv= "TV1";
    
    foreach($mang->checknk as $id){
      $tongsp = $mang['slnk'.$id];
      $khosp = $mang['vtknk'.$id];
      $soluongkho=$this->LaySoLuong($khosp);
      $r='';    
      foreach($soluongkho as $slk){
        $giatri=($tongsp >= $slk->slcon ? $slk->slcon : $tongsp);
        $sql="update kho set SoLuongDangChua = SoLuongDangChua + ". $giatri ." where MaKhu ='".$slk->MaKhu."'";
        $r.=  $slk->MaKhu.':'.$giatri .';';
        if (DB::update($sql) == 0) {
          return $bool= false;
        }
        if($tongsp >= $slk->slcon){
          $tongsp -= $slk->slcon;
        }
        else $tongsp = 0;
      }
    }
    $sql = "insert into phieunhapkho values('$idhd', now(), '$idtv')";
    if ( DB::update($sql) == 0 ) return $bool = false;
      $sql = "insert into chitietnhapkho values";
      foreach($mang->checknk as $id){
        $r = substr($r,0,strlen($r)-1);
        $sql.="( '".$idhd ." ','".$mang['mspnk'.$id] ." ', '".$r."','".$mang['slnk'.$id]."','".$mang['dgnk'.$id]."' ),"; 
      }
      $sql = substr($sql,0,strlen($sql)-1);
      if (DB::update($sql) == 0) {
         $bool= false;
         //$sql = "delete from phieunhapkho where MaPhieuNhapKho ='$idhd'";
         return $bool;
      }
      return $bool;
  }

}