<?php

namespace App;

use Illuminate\Support\Facades\DB;

class xuatKho
{
  public function console($nd){
		echo '<script>console.log("'.print_r($nd).'")</script>';
  }
  
	public function alert($nd){
		echo '<script>alert("'.$nd.'")</script>';
  }
  
  function updateTbSanPham($masp, $sl)
  {
    $sql ="update sanpham set SoLuongTon = '".$sl."'where MaSanPham = '".$masp."'";
    return DB::update($sql);
  } 

  function updateTbKho($makho, $sl)
  {
    $sql ="update kho set SoLuongDangChua = '".$sl."'where MaKhu = '".$makho."'";
    return DB::update($sql);
  } 

  function getDetailById($id){
    $sql = "select sp.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, sp.SoLuongTon as sl, sp.DonVi as dv, sp.DonGia as dongia
    from sanpham sp, nhacungcap ncc
    where
    sp.MaNhaCungCap = ncc.MaNhaCungCap and
    sp.MaSanPham ='".$id."'";
    return DB::select($sql);
  }

  function getMaxStt()
  {
    $sql = "select MaPhieuXuatKho from phieuxuatkho";
    $kq = DB::select($sql);
    $stt = array();
    foreach($kq as $ma)
    {
      array_push($stt, substr($ma->MaPhieuXuatKho, 2));
    }
    $max = 0;
    foreach($stt as $so)
    {
      if ($so > $max)
        $max = $so;
    }
    return $max;   
  }

  function getIdNv($ten)
  {
    $sql="select id, name from users where name=:id";
    $kq = DB::select($sql, ["id"=>$ten]);   
    return $kq;
  }

  function ThemPhieu($maphieu, $ngayxuat, $idnv)
  {
    $sql = "insert into phieuxuatkho values (:maphieu,:ngayxuat,:idnv)";
    $kq = DB::insert($sql,["maphieu"=>$maphieu, "ngayxuat"=>$ngayxuat,
                            "idnv"=>$idnv]);
    return $kq;
  }

   function ThemChiTietPhieu($maphieu, $masp, $soluong, $dongia)
  {
    $sql = "insert into chitietxuatkho values (:maphieu,:masp,:soluong,:dongia)";
    $kq = DB::insert($sql,["maphieu"=>$maphieu,"masp"=>$masp,
                            "soluong"=>$soluong,"dongia"=>$dongia]);
    return $kq;
  }
  function getKho($masp)
  {
    $sql="select * from kho where MaSanPham=:id";
    $kq = DB::select($sql,["id"=>$masp]);      
    return $kq;
  }

  function getKhobyId($id)
  {
    $sql="select * from kho where MaKhu=:id";
    $kq = DB::select($sql,["id"=>$id]);      
    return $kq;
  }
}