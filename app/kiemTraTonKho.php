<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kiemTraTonKho extends Model
{
	function filter($name, $types, $key){
      if ($key == "")
        $sql = "select sp.TenSanPham as tensp, sp.MaSanPham as masp, ncc.TenNhaCungCap as tenncc, kho.SoLuongDangChua as sl, sp.DonVi as dv, kho.TenKhu as tenkhu, kho.MaKhu as makhu
      from sanpham sp, nhacungcap ncc, kho
      where kho.MaSanPham = sp.MaSanPham and
      sp.MaNhaCungCap = ncc.MaNhaCungCap
      order by ".$name." ".$types;
      else
        $sql = "select sp.TenSanPham as tensp, sp.MaSanPham as masp, ncc.TenNhaCungCap as tenncc, kho.SoLuongDangChua as sl, sp.DonVi as dv, kho.TenKhu as tenkhu, kho.MaKhu as makhu
      from sanpham sp, nhacungcap ncc, kho
      where kho.MaSanPham = sp.MaSanPham and
      sp.MaNhaCungCap = ncc.MaNhaCungCap and (sp.TenSanPham like '%".$key."%' or ncc.TenNhaCungCap like '%".$key."%' or kho.TenKhu like '%".$key."%')
      order by ".$name." ".$types;

      return $this->cTable($sql);
    }

  function cTable($sql)
  {
    $kq =  DB::select($sql);
    $stt = 0;
    $string='';
    $tsl = 0;
    foreach($kq as $mang){  
      $tsl += $mang->sl;  
      $string.= '<tr>';   
      $string.= '<th scope="row">'. ++$stt .'</th>';
      $string.= '<td>'. $mang->tensp . '</td>';
      $string.= '<td>'. $mang->masp . '</td>';
      $string.= '<td>'. $mang->tenncc . '</td>';
      $string.= '<td>'. $mang->makhu . '</td>';
      $string.= '<td>'. $mang->tenkhu . '</td>';
      $string.= '<td>'. $mang->sl . '</td>';
      $string.= '<td>'. $mang->dv . '</td>';
      $string .='</tr>';
    }
    $string.='
    <tr class="text-right">
      <td colspan ="8"><b>Tổng số lượng: '.$tsl.'</b></td>
    </tr>';
    return $string;
  }
}