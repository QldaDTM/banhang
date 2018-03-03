@extends('theme.default')
@section('content')
<div class='titilecon col-md-12 text-center text-danger'>
  <h2>Kiểm tra Tồn kho</h2>
</div>
<input type="hidden" id="TenNhanVien" value="{{ Auth::user()->name }}"/>
<div class="row">
	<div class="col-md-3">
		<label for="filter" class="control-label">Lọc theo...</label>		
		<select name="filter" id="filter" class="form-control">
			<option value="sp">Tên vật liệu</option>
			<option value="ncc">Tên nhà cung cấp</option>
			<option value="sl">Số lượng</option>
			<option value="dg">Đơn giá</option>
		</select>
	</div>
	<div class="col-md-2">
		<label for="type" class="control-label">Kiểu lọc...</label>		<br>
		<button type="button" class="btn btn-outline-secondary" id="type" name="type" value="asc">
			<i class="fa fa-arrow-up" aria-hidden="true" style="color:blue;" value="asc" id="mui" name="mui"></i>
		</button>
	</div>
	<div class="col-sm-3">
      <label for="search" class="control-label">Tìm kiếm...</label>  
      <input id="search" type="text" name="search" class="form-control" placeholder="Nhập từ khoá..." />
   </div>
	 <div class="col-sm-3">
        <label for="loaithongke" class="control-label"> In Thống kê...</label>   
        <input type='button' onclick='inthongke()' name="inthongke" id="inthongke"  value='in thống kê' class="form-control col-md-12">
      </div> 



	</div>
</br>
<table class="table table-striped table-success table-hover table-bordered" id="dtable">
	<thead class="thead-inverse">
    <tr>
    <th scope="col">STT</th>
    <th scope="col">Tên vật liệu</th>
    <th scope="col">Mã vật liệu</th>
    <th scope="col">Nhà cung cấp</th>
    <th scope="col">Mã khu</th>
    <th scope="col">Tên khu</th>
    <th scope="col">Số lượng đang có</th>
    <th scope="col">Đơn vị</th>
    </tr>
    </thead>
    <tbody id='contentTable'>   	
				{!! $tonkho !!}
		</tbody>
</table>

<script>
function inthongke(){
	let r= $('#TenNhanVien').val();
	var mywindow = window.open('', 'PRINT', 'height=1200,width=600');
	mywindow.document.write('<html><head><title></title>');
  mywindow.document.write('</head><body >');
  mywindow.document.write('<h1>Công Ty Trách Nhiệm Hữu Hạn LTTS</h1>');
  mywindow.document.write('<h1><center>Phiếu Thống kê tồn kho</center></h1>');
  mywindow.document.write('<h3>Nhân viên xuất kho: '+r+'</h3>');
  mywindow.document.write('<h3>Ngày xuất kho: '+new Date().toLocaleString()+'</h3><table border="1">');

  mywindow.document.write($('#dtable').html());
  mywindow.document.write('</table><br><br><br><div style="margin-left:75px;"> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp Nhân viên ký tên  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Người nhận ký tên</div>'); 
  mywindow.document.write('</body></html>');

  mywindow.document.close(); 
  mywindow.focus(); 
	mywindow.print();





}
function filter()
{
	$.ajax({
		type:'GET',
    url:"{{url('kiemtratonkho-loc')}}",
		data: {name:$("#filter").val(), type:$("#type").val(), keys:$("#search").val()},
		async: true,
		success: function(data){
			$("#contentTable").html(data);
			}
	});	
}

$(document).ready(function() {	
	$("#filter").change(function(){
		filter();
  });
});

$(document).ready(function() {	
	$("#search").keyup(function(){
		filter();
  });
});

$(document).ready(function() {	
	$("#type").click(function(){	
		var s = $("#type").val();
    if (s == 'asc')
    {
    	$("#type").val('desc');
    	$("#type").html('<i class="fa fa-arrow-down" aria-hidden="true" style="color:blue;"></i>');
    }
    else
    {
    	$("#type").val('asc');
    	$("#type").html('<i class="fa fa-arrow-up" aria-hidden="true" style="color:blue;"></i>');
    }
    filter();
	});
});
</script>
@endsection