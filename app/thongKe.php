<?php
namespace App;

use Illuminate\Support\Facades\DB;

class thongKe
{
  public $timestamps = false;


  function getDetailXuat($name, $type, $key, $dates, $datee){
    if ($datee != "")
      $datee.= " 23:59:59";
    if ($key == "")
    {
      if($dates == "" && $datee != "")
      $sql = "select pxk.MaPhieuXuatKho as maphieu, pxk.NgayXuatKho as ngayxuat, ct.MaSanPham as masp, sp.TenSanPham as tensp, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieuxuatkho pxk, chitietxuatkho ct, sanpham sp
    where pxk.MaPhieuXuatKho = ct.MaPhieuXuatKho and ct.MaSanPham = sp.MaSanPham and 
    pxk.NgayXuatKho <= '".$datee."' order by ".$name." ".$type;
      elseif($datee == "" && $dates != "")
        $sql = "select pxk.MaPhieuXuatKho as maphieu, pxk.NgayXuatKho as ngayxuat, ct.MaSanPham as masp, sp.TenSanPham as tensp, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieuxuatkho pxk, chitietxuatkho ct, sanpham sp
    where pxk.MaPhieuXuatKho = ct.MaPhieuXuatKho and
    ct.MaSanPham = sp.MaSanPham and pxk.NgayXuatKho >= '".$dates."' order by ".$name." ".$type;
        elseif($datee != "" && $dates != "") 
           $sql = "select pxk.MaPhieuXuatKho as maphieu, pxk.NgayXuatKho as ngayxuat, ct.MaSanPham as masp, sp.TenSanPham as tensp, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieuxuatkho pxk, chitietxuatkho ct, sanpham sp
    where pxk.MaPhieuXuatKho = ct.MaPhieuXuatKho and pxk.NgayXuatKho <= '".$datee."' and
    ct.MaSanPham = sp.MaSanPham and pxk.NgayXuatKho >= '".$dates."' order by ".$name." ".$type;
          else
           $sql = "select pxk.MaPhieuXuatKho as maphieu, pxk.NgayXuatKho as ngayxuat, ct.MaSanPham as masp, sp.TenSanPham as tensp, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieuxuatkho pxk, chitietxuatkho ct, sanpham sp
    where pxk.MaPhieuXuatKho = ct.MaPhieuXuatKho and ct.MaSanPham = sp.MaSanPham
    order by ".$name." ".$type; 
    }
      
    else
    {
      if($dates == "" && $datee != "")
      $sql = "select pxk.MaPhieuXuatKho as maphieu, pxk.NgayXuatKho as ngayxuat, ct.MaSanPham as masp, sp.TenSanPham as tensp, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieuxuatkho pxk, chitietxuatkho ct, sanpham sp
    where pxk.MaPhieuXuatKho = ct.MaPhieuXuatKho and ct.MaSanPham = sp.MaSanPham and 
    pxk.NgayXuatKho <= '".$datee."' and (sp.TenSanPham like '%".$key."%' or pxk.MaPhieuXuatKho like '%".$key."%') order by ".$name." ".$type;
      elseif($datee == "" && $dates != "")
        $sql = "select pxk.MaPhieuXuatKho as maphieu, pxk.NgayXuatKho as ngayxuat, ct.MaSanPham as masp, sp.TenSanPham as tensp, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieuxuatkho pxk, chitietxuatkho ct, sanpham sp
    where pxk.MaPhieuXuatKho = ct.MaPhieuXuatKho and
    ct.MaSanPham = sp.MaSanPham and pxk.NgayXuatKho >= '".$dates."' and (sp.TenSanPham like '%".$key."%' or pxk.MaPhieuXuatKho like '%".$key."%') order by ".$name." ".$type;
        elseif($datee != "" && $dates != "")
           $sql = "select pxk.MaPhieuXuatKho as maphieu, pxk.NgayXuatKho as ngayxuat, ct.MaSanPham as masp, sp.TenSanPham as tensp, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieuxuatkho pxk, chitietxuatkho ct, sanpham sp
    where pxk.MaPhieuXuatKho = ct.MaPhieuXuatKho and pxk.NgayXuatKho <= '".$datee."' and
    ct.MaSanPham = sp.MaSanPham and pxk.NgayXuatKho >= '".$dates."' and (sp.TenSanPham like '%".$key."%' or pxk.MaPhieuXuatKho like '%".$key."%') order by ".$name." ".$type;
          else
            $sql = "select pxk.MaPhieuXuatKho as maphieu, pxk.NgayXuatKho as ngayxuat, ct.MaSanPham as masp, sp.TenSanPham as tensp, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieuxuatkho pxk, chitietxuatkho ct, sanpham sp
    where pxk.MaPhieuXuatKho = ct.MaPhieuXuatKho and
    ct.MaSanPham = sp.MaSanPham and (sp.TenSanPham like '%".$key."%' or pxk.MaPhieuXuatKho like '%".$key."%') order by ".$name." ".$type;
    }        

    return $this->cTableXuat($sql);
  }

  function cTableXuat($sql)
  {
    $kq = DB::select($sql);
    $stt =0;
    $tongtien = 0;
    $sl = 0;
    $string='<thead class="thead-inverse">
      <tr>  
        <th scope="col">STT</th>
        <th scope="col">Mã phiếu</th>
        <th scope="col">Ngày xuất</th>
        <th scope="col">Mã vật liệu</th>
        <th scope="col">Tên vật liệu</th>     
        <th scope="col">Số lượng</th>
        <th scope="col">Đơn vị</th> 
        <th scope="col">Đơn giá</th>  
      </tr>
    </thead>
    <tbody>';
    foreach($kq as $mang){   
      $tongtien += $mang->sl * $mang->dg;
      $sl += $mang->sl;
      $string.= '<tr>';   
      $string.= '<th scope="row">'. ++$stt  .'</th>';
      $string.= '<td>' . $mang->maphieu . '</td>';
      $string.= '<td>' . $mang->ngayxuat . '</td>';
      $string.= '<td>' . $mang->masp . '</td>';
      $string.= '<td>' . $mang->tensp . '</td>';
      $string.= '<td>' . $mang->sl . '</td>';
      $string.= '<td>' . $mang->dv . '</td>';
      $string.= '<td>' . $mang->dg . '</td>';
      $string .='</tr> </tbody>';
    }
    $string.= '<tfoot><tr class="text-right">
              <td colspan="6"><b>Tổng số lượng: '.$sl.'</td>';
    $string.= '<td colspan="2"><b>Tổng tiền: '.$tongtien.' VNĐ</b>';
    $string.= '</td></tr></tfoot>';
    return $string;
  }

  function getDetailNhap($name, $type, $key, $dates, $datee){
    if ($datee != "")
      $datee.= " 23:59:59";
    if ($key == "")
    {
      if($dates == "" && $datee != "")
      $sql = "select pnk.MaPhieuNhapKho as maphieu, pnk.NgayNhapKho as ngaynhap, ct.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieunhapkho pnk, chitietnhapkho ct, sanpham sp, nhacungcap ncc
    where pnk.MaPhieuNhapKho = ct.MaPhieuNhapKho and
    ct.MaSanPham = sp.MaSanPham and 
    sp.MaNhaCungCap = ncc.MaNhaCungCap and
    pnk.NgayNhapKho <= '".$datee."' order by ".$name." ".$type;
      elseif ($datee == "" && $dates != "")
        $sql = "select pnk.MaPhieuNhapKho as maphieu, pnk.NgayNhapKho as ngaynhap, ct.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieunhapkho pnk, chitietnhapkho ct, sanpham sp, nhacungcap ncc
    where pnk.MaPhieuNhapKho = ct.MaPhieuNhapKho and
    ct.MaSanPham = sp.MaSanPham and 
    sp.MaNhaCungCap = ncc.MaNhaCungCap and
    pnk.NgayNhapKho >= '".$dates."' order by ".$name." ".$type;
        elseif($datee != "" && $dates != "")
           $sql = "select pnk.MaPhieuNhapKho as maphieu, pnk.NgayNhapKho as ngaynhap, ct.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieunhapkho pnk, chitietnhapkho ct, sanpham sp, nhacungcap ncc
    where pnk.MaPhieuNhapKho = ct.MaPhieuNhapKho and
    ct.MaSanPham = sp.MaSanPham and 
    sp.MaNhaCungCap = ncc.MaNhaCungCap and  pnk.NgayNhapKho <= '".$datee."' and
    pnk.NgayNhapKho >= '".$dates."' order by ".$name." ".$type;
          else
            $sql = "select pnk.MaPhieuNhapKho as maphieu, pnk.NgayNhapKho as ngaynhap, ct.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieunhapkho pnk, chitietnhapkho ct, sanpham sp, nhacungcap ncc
    where pnk.MaPhieuNhapKho = ct.MaPhieuNhapKho and
    ct.MaSanPham = sp.MaSanPham and 
    sp.MaNhaCungCap = ncc.MaNhaCungCap order by ".$name." ".$type;
    }
    else
    {
      if($dates == "" && $datee != "")
      $sql = "select pnk.MaPhieuNhapKho as maphieu, pnk.NgayNhapKho as ngaynhap, ct.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieunhapkho pnk, chitietnhapkho ct, sanpham sp, nhacungcap ncc
  where pnk.MaPhieuNhapKho = ct.MaPhieuNhapKho and
  ct.MaSanPham = sp.MaSanPham and pnk.NgayNhapKho <= '".$datee."' and
  sp.MaNhaCungCap = ncc.MaNhaCungCap and 
  (sp.TenSanPham like '%".$key."%' or pnk.MaPhieuNhapKho like '%".$key."%' or ncc.TenNhaCungCap like '%".$key."%') order by ".$name." ".$type;
        elseif($dates =! "" && $datee == "")
          $sql = "select pnk.MaPhieuNhapKho as maphieu, pnk.NgayNhapKho as ngaynhap, ct.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieunhapkho pnk, chitietnhapkho ct, sanpham sp, nhacungcap ncc
  where pnk.MaPhieuNhapKho = ct.MaPhieuNhapKho and
  ct.MaSanPham = sp.MaSanPham and 
  sp.MaNhaCungCap = ncc.MaNhaCungCap and pnk.NgayNhapKho >= '".$dates."' and
  (sp.TenSanPham like '%".$key."%' or pnk.MaPhieuNhapKho like '%".$key."%' or ncc.TenNhaCungCap like '%".$key."%') order by ".$name." ".$type;
          elseif($dates =! "" && $datee != "")
            $sql = "select pnk.MaPhieuNhapKho as maphieu, pnk.NgayNhapKho as ngaynhap, ct.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieunhapkho pnk, chitietnhapkho ct, sanpham sp, nhacungcap ncc
  where pnk.MaPhieuNhapKho = ct.MaPhieuNhapKho and
  ct.MaSanPham = sp.MaSanPham and pnk.NgayNhapKho >= '".$dates."'
  sp.MaNhaCungCap = ncc.MaNhaCungCap and pnk.NgayNhapKho <= '".$datee."'
  (sp.TenSanPham like '%".$key."%' or pnk.MaPhieuNhapKho like '%".$key."%' or ncc.TenNhaCungCap like '%".$key."%') order by ".$name." ".$type;
            else
              $sql = "select pnk.MaPhieuNhapKho as maphieu, pnk.NgayNhapKho as ngaynhap, ct.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, ct.SoLuong as sl, sp.DonVi as dv, ct.DonGia as dg from phieunhapkho pnk, chitietnhapkho ct, sanpham sp, nhacungcap ncc
  where pnk.MaPhieuNhapKho = ct.MaPhieuNhapKho and
  ct.MaSanPham = sp.MaSanPham and 
  sp.MaNhaCungCap = ncc.MaNhaCungCap and
  (sp.TenSanPham like '%".$key."%' or pnk.MaPhieuNhapKho like '%".$key."%' or ncc.TenNhaCungCap like '%".$key."%') order by ".$name." ".$type;
    }     
  return $this->cTableNhap($sql);
  }

  function cTableNhap($sql)
  {
    $kq = DB::select($sql);
    $stt =0;
    $tongtien = 0;
    $sl = 0;
    $string='<thead class="thead-inverse">
      <tr>  
        <th scope="col">STT</th>
        <th scope="col">Mã phiếu</th>
        <th scope="col">Ngày nhập</th>
        <th scope="col">Mã vật liệu</th>
        <th scope="col">Tên vật liệu</th>  
        <th scope="col">Nhà cung cấp</th>   
        <th scope="col">Số lượng</th>
        <th scope="col">Đơn vị</th> 
        <th scope="col">Đơn giá</th>  
      </tr>
    </thead>
    <tbody>';
    foreach($kq as $mang){   
      $tongtien += $mang->sl * $mang->dg;
      $sl += $mang->sl;
      $string.= '<tr>';   
      $string.= '<th scope="row">'. ++$stt  .'</th>';
      $string.= '<td>' . $mang->maphieu . '</td>';
      $string.= '<td>' . $mang->ngaynhap . '</td>';
      $string.= '<td>' . $mang->masp . '</td>';
      $string.= '<td>' . $mang->tensp . '</td>';
      $string.= '<td>' . $mang->tenncc . '</td>';
      $string.= '<td>' . $mang->sl . '</td>';
      $string.= '<td>' . $mang->dv . '</td>';
      $string.= '<td>' . $mang->dg . '</td>';
      $string .='</tr> </tbody>';
    }
    $string.= '<tfoot><tr class="text-right">
              <td colspan="7"><b>Tổng số lượng: '.$sl.'</td>';
    $string.= '<td colspan="2"><b>Tổng tiền: '.$tongtien.' VNĐ</b>';
    $string.= '</td></tr></tfoot>';
    return $string;
  }
  
}