<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class qlSanPham extends Model
{
  protected $table= 'sanpham';
  public $timestamps = false;
  public function nhacungcap(){
		return $this->belongsTo('App\qlNhaCungCap','MaNhaCungCap','MaNhaCungCap');
  }
  
  public function getmasp(){
    $sql= 'select MaSanPham,TenSanPham from sanpham';
    return DB::select($sql);
  }
  public function search($searchData) {
    $sanpham =  DB::select("select * from sanpham,nhacungcap where sanpham.MaNhaCungCap= nhacungcap.MaNhaCungCap and (TenSanPham like '%$searchData%' or MaSanPham like '%$searchData%' or TenNhaCungCap like '%$searchData%')");
   $string='';
   foreach($sanpham as $mang){   
 				$string.= '<tr class="text-center">';   
        $string.= '<th scope="row">'. $mang->MaSanPham  .'</th>';
        $string.= '<td>' . $mang->TenSanPham . '</td>';
        $string.= '<td>' . $mang->TenNhaCungCap . '</td>';
        $string.= '<td>' . $mang->SoLuongTon . '</td>';
        $string.= '<td>' . $mang->DonGia . '</td>';
        $string.= '<td>' . $mang->DonVi . '</td>';
        $string.= '<td>
                    <button data-toggle="modal" onclick="suacsp(' . 
                      "'" .$mang->MaSanPham ."'" . ','.
                      "'" .$mang->TenSanPham ."'" . ','.
                      "'" .$mang->MaNhaCungCap ."'" . ','.
                      "'" .$mang->SoLuongTon ."'" . ','.
                      "'" .$mang->DonGia ."'" . ','.
                      "'" .$mang->DonVi ."'" .
                      ')" value="' .$mang->MaSanPham . '" data-target="#suacsp" class="btn btn-primary" type="button" >Sửa</button>
                    <button data-toggle="modal" onclick="xoacsp(' . "'" .$mang->MaSanPham ."'" . ')" data-target="#xoacsp" class="btn btn-danger" type="button" >Xoá</button></td>';
   	$string .= '</tr>';
   	}
    return($string);
   
  }
}