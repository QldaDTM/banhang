<?php

namespace App;

use Illuminate\Support\Facades\DB;

class thongKeTT
{
  public $timestamps = false;

  function cTable($sql)
  {
    $kq = DB::select($sql);
    $stt =0;
    $tongtien = 0;
    $sl = 0;
    $string='<thead class="thead-inverse">
      <tr>  
        <th scope="col">STT</th>
        <th scope="col">Mã nhập kho hỏng</th>
        <th scope="col">Ngày nhập</th>
        <th scope="col">Phiếu xuất kho</th> 
        <th scope="col">Tên vật liệu</th>  
        <th scope="col">Vị trí</th>    
        <th scope="col">Số lượng</th>
        <th scope="col">Đơn giá</th> 
        <th scope="col">Nhân viên</th> 
      </tr>
    </thead>
    <tbody>';
    foreach($kq as $mang){   
      $tongtien += $mang->sl * $mang->dg;
      $sl += $mang->sl;
      $string.= '<tr>';   
      $string.= '<th scope="row">'. ++$stt  .'</th>';
      $string.= '<td>' . $mang->manhap . '</td>';
      $string.= '<td>' . $mang->ngaynhap . '</td>';
      $string.= '<td>' . $mang->maphieu . '</td>';
      $string.= '<td>' . $mang->tensp . '</td>';
      $string.= '<td>' . $mang->vitri . '</td>';
      $string.= '<td>' . $mang->sl . '</td>';
      $string.= '<td>' . $mang->dg . '</td>';
      $string.= '<td>' . $mang->TenThanhVien . '</td>';
      $string .='</tr> </tbody>';
    }
    $string.= '<tfoot><tr class="text-right">
              <td colspan="7"><b>Tổng số lượng: '.$sl.'</td>';
    $string.= '<td colspan="2"><b>Tổng tiền: '.$tongtien.'</b>';
    $string.= '</td></tr></tfoot>';
    return $string;
  }

  function getDetails($name, $type, $key, $dates, $datee, $tt)
  {
	  if ($datee != "")
	    $datee.= " 23:59:59";
	  if ($key == "" || $key==null)
	  {
	    if($dates == "" && $datee != "")
	    $sql = "select nkh.MaNhapKhoHong as manhap, nkh.NgayNhapKho as ngaynhap, sp.TenSanPham as tensp, ctkh.SoLuong as sl, ctxk.DonGia as dg, nkh.MaPhieu as maphieu, kh.TenKhu as vitri, tv.TenThanhVien from nhapkhohong nkh, khohong kh, sanpham sp, chitietkhohong ctkh, chitietxuatkho ctxk, thanhvien tv where nkh.MaNhapKhoHong = ctkh.MaNhapKhoHong and nkh.MaPhieu = ctxk.MaPhieuXuatKho and ctkh.MaSanPham = ctxk.MaSanPham and ctkh.MaKhuHong = kh.MaKhu and tv.MaThanhVien = nkh.MaNhanVien and sp.MaSanPham = ctkh.MaSanPham and ctkh.TinhTrang = '".$tt."' and nkh.NgayNhapKho <= '".$datee."' order by ".$name." ".$type;
	    elseif($datee == "" && $dates != "")
	      $sql = "select nkh.MaNhapKhoHong as manhap, nkh.NgayNhapKho as ngaynhap, sp.TenSanPham as tensp, ctkh.SoLuong as sl, ctxk.DonGia as dg, nkh.MaPhieu as maphieu, kh.TenKhu as vitri, tv.TenThanhVien from nhapkhohong nkh, khohong kh, sanpham sp, chitietkhohong ctkh, chitietxuatkho ctxk, thanhvien tv where nkh.MaNhapKhoHong = ctkh.MaNhapKhoHong and nkh.MaPhieu = ctxk.MaPhieuXuatKho and ctkh.MaSanPham = ctxk.MaSanPham and ctkh.MaKhuHong = kh.MaKhu and tv.MaThanhVien = nkh.MaNhanVien and sp.MaSanPham = ctkh.MaSanPham and ctkh.TinhTrang = '".$tt."' and nkh.NgayNhapKho >= '".$dates."' order by ".$name." ".$type;
	      elseif($datee != "" && $dates != "") 
	         $sql = "select nkh.MaNhapKhoHong as manhap, nkh.NgayNhapKho as ngaynhap, sp.TenSanPham as tensp, ctkh.SoLuong as sl, ctxk.DonGia as dg, nkh.MaPhieu as maphieu, kh.TenKhu as vitri, tv.TenThanhVien from nhapkhohong nkh, khohong kh, sanpham sp, chitietkhohong ctkh, chitietxuatkho ctxk, thanhvien tv where nkh.MaNhapKhoHong = ctkh.MaNhapKhoHong and nkh.MaPhieu = ctxk.MaPhieuXuatKho and ctkh.MaSanPham = ctxk.MaSanPham and ctkh.MaKhuHong = kh.MaKhu and tv.MaThanhVien = nkh.MaNhanVien and sp.MaSanPham = ctkh.MaSanPham and ctkh.TinhTrang = '".$tt."' and nkh.NgayNhapKho <= '".$datee."' and nkh.NgayNhapKho >= '".$dates."' order by ".$name." ".$type;
	        else
	         $sql = "select nkh.MaNhapKhoHong as manhap, nkh.NgayNhapKho as ngaynhap, sp.TenSanPham as tensp, ctkh.SoLuong as sl, ctxk.DonGia as dg, nkh.MaPhieu as maphieu, kh.TenKhu as vitri, tv.TenThanhVien from nhapkhohong nkh, khohong kh, sanpham sp, chitietkhohong ctkh, chitietxuatkho ctxk, thanhvien tv where nkh.MaNhapKhoHong = ctkh.MaNhapKhoHong and nkh.MaPhieu = ctxk.MaPhieuXuatKho and ctkh.MaSanPham = ctxk.MaSanPham and ctkh.MaKhuHong = kh.MaKhu and tv.MaThanhVien = nkh.MaNhanVien and sp.MaSanPham = ctkh.MaSanPham and ctkh.TinhTrang = '".$tt."'order by ".$name." ".$type; 
	  }
	  else
	  {
	    if($dates == "" && $datee != "")
	    $sql = "select nkh.MaNhapKhoHong as manhap, nkh.NgayNhapKho as ngaynhap, sp.TenSanPham as tensp, ctkh.SoLuong as sl, ctxk.DonGia as dg, nkh.MaPhieu as maphieu, kh.TenKhu as vitri, tv.TenThanhVien from nhapkhohong nkh, khohong kh, sanpham sp, chitietkhohong ctkh, chitietxuatkho ctxk, thanhvien tv where nkh.MaNhapKhoHong = ctkh.MaNhapKhoHong and nkh.MaPhieu = ctxk.MaPhieuXuatKho and ctkh.MaSanPham = ctxk.MaSanPham and ctkh.MaKhuHong = kh.MaKhu and tv.MaThanhVien = nkh.MaNhanVien and sp.MaSanPham = ctkh.MaSanPham and ctkh.TinhTrang = '".$tt."' and nkh.NgayNhapKho <= '".$datee."' and (nkh.MaNhapKhoHong like '%".$key."%' or sp.TenSanPham like '%".$key."%' or nkh.MaPhieu like '%".$key."%') order by ".$name." ".$type;
	    elseif($datee == "" && $dates != "")
	      $sql = "select nkh.MaNhapKhoHong as manhap, nkh.NgayNhapKho as ngaynhap, sp.TenSanPham as tensp, ctkh.SoLuong as sl, ctxk.DonGia as dg, nkh.MaPhieu as maphieu, kh.TenKhu as vitri, tv.TenThanhVien from nhapkhohong nkh, khohong kh, sanpham sp, chitietkhohong ctkh, chitietxuatkho ctxk, thanhvien tv where nkh.MaNhapKhoHong = ctkh.MaNhapKhoHong and nkh.MaPhieu = ctxk.MaPhieuXuatKho and ctkh.MaSanPham = ctxk.MaSanPham and ctkh.MaKhuHong = kh.MaKhu and tv.MaThanhVien = nkh.MaNhanVien and sp.MaSanPham = ctkh.MaSanPham and ctkh.TinhTrang = '".$tt."' and nkh.NgayNhapKho >= '".$dates."' and (nkh.MaNhapKhoHong like '%".$key."%' or sp.TenSanPham like '%".$key."%' or nkh.MaPhieu like '%".$key."%') order by ".$name." ".$type;
	      elseif($datee != "" && $dates != "")
	         $sql = "select nkh.MaNhapKhoHong as manhap, nkh.NgayNhapKho as ngaynhap, sp.TenSanPham as tensp, ctkh.SoLuong as sl, ctxk.DonGia as dg, nkh.MaPhieu as maphieu, kh.TenKhu as vitri, tv.TenThanhVien from nhapkhohong nkh, khohong kh, sanpham sp, chitietkhohong ctkh, chitietxuatkho ctxk, thanhvien tv where nkh.MaNhapKhoHong = ctkh.MaNhapKhoHong and nkh.MaPhieu = ctxk.MaPhieuXuatKho and ctkh.MaSanPham = ctxk.MaSanPham and ctkh.MaKhuHong = kh.MaKhu and tv.MaThanhVien = nkh.MaNhanVien and sp.MaSanPham = ctkh.MaSanPham and ctkh.TinhTrang = '".$tt."' and nkh.NgayNhapKho <= '".$datee."' and nkh.NgayNhapKho >= '".$dates."' and (nkh.MaNhapKhoHong like '%".$key."%' or sp.TenSanPham like '%".$key."%' or nkh.MaPhieu like '%".$key."%') order by ".$name." ".$type;
	        else
	          $sql = "select nkh.MaNhapKhoHong as manhap, nkh.NgayNhapKho as ngaynhap, sp.TenSanPham as tensp, ctkh.SoLuong as sl, ctxk.DonGia as dg, nkh.MaPhieu as maphieu, kh.TenKhu as vitri, tv.TenThanhVien from nhapkhohong nkh, khohong kh, sanpham sp, chitietkhohong ctkh, chitietxuatkho ctxk, thanhvien tv where nkh.MaNhapKhoHong = ctkh.MaNhapKhoHong and nkh.MaPhieu = ctxk.MaPhieuXuatKho and ctkh.MaSanPham = ctxk.MaSanPham and ctkh.MaKhuHong = kh.MaKhu and tv.MaThanhVien = nkh.MaNhanVien and sp.MaSanPham = ctkh.MaSanPham and ctkh.TinhTrang = '".$tt."'and (nkh.MaNhapKhoHong like '%".$key."%' or sp.TenSanPham like '%".$key."%' or nkh.MaPhieu like '%".$key."%') order by ".$name." ".$type;   
	  }   
	  return $this->cTable($sql);
  }
}