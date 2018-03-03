@extends('theme.default')
@section('content')
<div class='row'>
  <div class='titilecon col-md-12 text-center text-danger'>
    <h2>Lập phiếu xuất kho</h2>
  </div>
</div>
<form class="container" method="post" action="">
{{ csrf_field() }}
<table class="table table-striped table-success table-hover table-bordered">
  <thead class="thead-inverse">
    <tr>  
      <th scope="col">STT</th>
      <th scope="col">Mã vật liệu</th>
      <th scope="col">Tên vật liệu</th>
      <th scope="col">Nhà cung cấp</th>
      <th scope="col">Vị trí kho</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Đơn vị</th>
      <th scope="col">Đơn giá</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $stt = 0;
      ?>
      @foreach($details as $row)
      <tr>
        <th scope="row">{{++$stt}}</th>
        <td>{{ $row->masp }}</td>
        <td>{{ $row->tensp }}</td>
        <td>{{ $row->tenncc }}</td>
        <td>
          <select class="form-control" name="{{$stt}}vt[]" multiple>
            @foreach($kho as $value)
              @if($value->MaSanPham == $row->masp)
                <option value="{{$value->MaKhu}}">
                  {{$value->MaKhu}} | Hiện có: {{ $value->SoLuongDangChua }}    
                </option>
              @endif
            @endforeach
          </select>         
        </td>
        <td>
          <div id = "s{{$row->masp}}">
          <input type="number" name="{{$stt}}sl" 
          class="form-control" value="" min="1" 
          max="{{ $row->sl }}" placeholder="Max: {{ $row->sl }}">
          </div>
        </td>
        <td>{{ $row->dv }}</td>
        <td>{{ $row->dongia }}</td>
        <input type="hidden" name="{{$stt}}" value="{{$row->masp}}" />
      </tr>
      @endforeach 
  </tbody>
</table>
<div class="text-right">
  <button type="submit" class="btn btn-primary" name="dongy">Đồng ý </button>
</div>
</form>
<?php
use App\xuatKho;

$xk = new xuatKho();
  if(isset($_POST['dongy']))
  {
    $checkvt = 0;
    $checksl = false;
    foreach ($_POST as $key => $value)
    {
      if (isset($_POST[$key.'vt']))
      {
        $checkvt++;
      }
      if(is_numeric($key) && $_POST[$key.'sl'] > 0)
      {
        $ssl = 0;      
        $detail = $xk ->getDetailById($_POST[$key]);
        $ctkho = $xk->getKhobyId($_POST[$key.'vt'][0]);
        // kiem tra so luong đặt và số lượng trong kho vừa chọn
        foreach($_POST[$key.'vt'] as $kho)
        {
          $ctkho = $xk->getKhobyId($kho);
          $ssl += $ctkho[0]->SoLuongDangChua;											
        }
        if($ssl < $_POST[$key.'sl'])
        {
          $checksl = true;break;
        }
      }
      if (isset($_POST[$key.'vt']))
      {
        if($_POST[$key.'sl'] == ""){
          $checksl = true;
        }
      }
    }
    if (!$checksl && $checkvt > 0)
    {
      $stt = 0;
      $maphieuxuat = 'XK'.($xk->getMaxStt() + 1);
      $ngayxuat = date('Y-m-d h:m:s');
      $nameUser = Auth::user()->name;
      $idUser = Auth::user()->id;
      $tonggia=0;
      // Them phieuxuatkho
      if($xk->ThemPhieu($maphieuxuat, $ngayxuat, $idUser) == 1)	
      {
        $xk->alert('Thêm phiếu xuất kho thành công! Mã phiếu: '.$maphieuxuat);
        echo "<input type='hidden' name='maphieu' id='maphieu' value='".$maphieuxuat."'/>
        <input type='hidden' name='tenthanhvien' id='tenthanhvien' value='".$nameUser."'/>";
        //xử lý với mỗi mã sản phẩm
        foreach ($_POST as $key => $value) 
        {
          if(is_numeric($key) && $_POST[$key.'sl'] > 0 )
          {
            //echo $_POST[$key].$_POST[$key.'sl'];				
            $id = $_POST[$key];								
            $detail = $xk->getDetailById($id);
            $slUpdated = $detail[0]->sl - $_POST[$key.'sl'];
            // cap nhat lai so luong san pham
            if ($xk->updateTbSanPham($id, $slUpdated))
            {
              //them chi tiet xuat kho
              if($xk->ThemChiTietPhieu($maphieuxuat, $id, $_POST[$key.'sl'], $detail[0]->dongia) > 0)
              {
                $stt++;
                //$xk->alert('Thêm chi tiết phiếu xuất kho thành công!');
                echo "<input type='hidden' name='tensp".$stt."' id='tensp".$stt."' 
                value='".$detail[0]->tensp."'/>
                <input type='hidden' name='soluong".$stt."' id='soluong".$stt."' 
                value='".$_POST[$key.'sl']."'/>
                <input type='hidden' name='dongia".$stt."' id='dongia".$stt."' 
                value='".$detail[0]->dongia."'/>";
                $tonggia += $detail[0]->dongia * $_POST[$key.'sl'];
                // cập nhật lại số lượng trong kho
                $temp = $_POST[$key.'sl'];
                foreach($_POST[$key.'vt'] as $kho)
                {
                  if($temp == 0)
                    break;
                  $ctkho = $xk->getKhobyId($kho);
                  if ($temp <= $ctkho[0]->SoLuongDangChua)
                  {
                    if($xk->updateTbKho($kho, $ctkho[0]->SoLuongDangChua - $temp))
                      $temp = 0;					
                    else
                      $xk->alert('Cập nhật kho thất bại!');			
                  }
                  else
                  {
                    if($xk->updateTbKho($kho, 0))
                    {
                      $temp -= $ctkho[0]->SoLuongDangChua;
                    }									
                    else
                      $xk->alert('Cập nhật kho thất bại!');		
                  }
                }
              }
              else
                $xk->alert('Không thể thêm chi tiết phiếu! Lỗi!');
            }
            else $xk->alert('Cập nhật số lượng sản phẩm thất bại!');
          }
        }
        echo "<input type='hidden' name='tonggia' id='tonggia' 
                value='".$tonggia."'/>
              <input type='hidden' name='stt' id='stt' 
                value='".$stt."'/>";
    
        ?>
        <script>
          var stt = parseInt($('#stt').val());
          var string ="";
          for(var i=1; i<= stt; i++)
          {
            string += '<tr align="center">'+   
            '<td> '+ i +'   </td>'+
            '<td> '+ $('#tensp'+i).val()+'   </td>'+
            '<td> '+ $('#soluong'+i).val()+'   </td>'+
            '<td> '+ $('#dongia'+i).val()+'   </td>'+
            '</tr>'
          }
          var mywindow = window.open('', 'PRINT', 'height=1200,width=600');
          mywindow.document.write('<html><head><title></title>');
          mywindow.document.write('<style>table {width: 80%;border-collapse: collapse;}table, td, th {padding: 4px;border: 1px solid black;}</style>');
          mywindow.document.write('</head><body >');
          mywindow.document.write('<h1><center>Công Ty Trách Nhiệm Hữu Hạn LTTS</center></h1>');
          mywindow.document.write('<h1><center>Phiếu Xuất Kho</center></h1>');
          mywindow.document.write('<h3>Số phiếu xuất kho: '+$('#maphieu').val()+'</h3>');
          mywindow.document.write('<h3>Nhân viên xuất kho: '+$('#tenthanhvien').val()+'</h3>');
          mywindow.document.write('<h3>Ngày xuất kho: '+new Date().toLocaleString()+'</h3>');
          mywindow.document.write(
            '<center><table> '+
            '<tr>'+ '<th width="10%">STT</th>' +
            '<th width="50%">Tên vật liệu </th><th width="20%">Số lượng </th><th width="20%">Đơn giá</th>'+
            '</tr>'+  
            string+ '<tr><td colspan="4" align="right">Tổng tiền: '+ $('#tonggia').val() +'</td></tr>' +
            '<table>');
          mywindow.document.write('<br><br><br><div>Nhân viên ký tên  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Người nhận ký tên</div>'); 
          mywindow.document.write('</body></html></center>');
          mywindow.document.close(); 
          mywindow.focus(); 
          mywindow.print();
          window.location = "xuat-kho";
        </script>
        <?php
      }
      else
      {
        $xk->alert("Không thể thêm phiếu xuất kho! Lỗi!");
      }
    }
    elseif ($checksl)
    {
      $xk->alert("Số lượng nhập phải nhỏ hơn hoặc bằng số lượng trong kho đã chọn!");
      echo "<script>window.location = 'xuat-kho'</script>";
    }
    elseif ($checkvt == 0)
    {
      $xk->alert("Hãy chọn vật liệu cần xuất!"); echo "<script>window.location = 'xuat-kho'</script>";
    }
    else{
      $xk->alert("Lỗi!"); echo "<script>window.location = 'xuat-kho'</script>";
    }
  }
?>
@endsection