@extends('theme.default')
@section('content')
<div class='row'>
  <div class='titilecon col-md-12 text-center text-danger'>
    <h2>Thống kê nhập/xuất hàng</h2>
  </div>
</div>
<div class="form-group">
      <label for="loaithongke" class="control-label">Thống kê...</label>   
      <select name="loaithongke" id="loaithongke" class="form-control col-sm-2">
        <option value="xuatkho">Xuất kho</option>
        <option value="nhapkho">Nhập kho</option>
      </select> 
</div>
<div class="row">
    <div class="col-sm-2">
      <label for="filter" class="control-label">Sắp xếp theo...</label>   
      <select name="filter" id="filter" class="form-control">
        <option value="mp">Mã phiếu</option>
        <option value="nx">Ngày xuất</option>
        <option value="tensp">Tên vật liệu</option>
      </select>
    </div>
    <div class="col-sm-1">
      <label for="type" class="control-label">Kiểu lọc...</label>   
      <button type="button" class="btn btn-outline-secondary" id="type" name="type" value="asc">
        <i class="fa fa-arrow-up" aria-hidden="true" style="color:blue;" value="asc" id="mui" name="mui"></i>
      </button>
    </div>
    <div class="col-sm-3">
      <label for="searchp" class="control-label">Tìm kiếm...</label>  
      <input id="searchp" type="text" name="searchp" class="form-control" placeholder="Nhập từ khoá..." />
    </div>
    <div class="col-sm-2" ></div>
    <div class="col-sm-2">
      <label for="datestart" class="control-label">Từ ngày...</label>   
      <input id="datestart" type="date" name="datestart" class="form-control"/>
    </div>
     <div class="col-sm-2">
      <label for="dateend" class="control-label">Đến ngày...</label>   
      <input id="dateend" type="date" name="dateend" class="form-control"/>
    </div>
</div>
</br>
<table class="table table-striped table-success table-hover table-bordered" id="dtalble">
<?php
 echo $details;
?>
</table>

<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
function filterx()
{
	if ($("#loaithongke").val() == 'xuatkho')
	{
		$.ajax({
		type:'POST',
    url:'{{ url("thong-ke-NX-ajax")}}',
		data: {name:$("#filter").val(), type:$("#type").val(), keys:$("#searchp").val(), dates:$("#datestart").val(), datee:$("#dateend").val()},
		async: true,
		success: function(data){
			$("#dtalble").html(data);
			}
		});	
	}
	else
	{
		$.ajax({
		type:'POST',
    url:'{{ url("thong-ke-NX-ajax")}}',
		data: {namen:$("#filter").val(), typen:$("#type").val(), keys:$("#searchp").val(), dates:$("#datestart").val(), datee:$("#dateend").val()},
		async: true,
		success: function(data){
			$("#dtalble").html(data);
			}
		});	
	}
}

$(document).ready(function() {	
	$("#filter").change(function(){
		 filterx();
	});
});

$(document).ready(function() {	
	$("#loaithongke").change(function(){
		$("#searchp").val('');
    $.ajax({
		type:'POST',
    url: '{{ url("thong-ke-NX-ajax")}}',
		data: {loai:$("#loaithongke").val()},
		async: true,
		success: function(data){
			$("#dtalble").html(data);
			filterx();
			}
		});
	});
});

$(document).ready(function() {	
	$("#type").click(function(){	
    if ($("#type").val() == 'asc')
    {
    	$("#type").val('desc');
    	$("#type").html('<i class="fa fa-arrow-down" aria-hidden="true" style="color:blue;"></i>');
    }
    else
    {
    	$("#type").val('asc');
    	$("#type").html('<i class="fa fa-arrow-up" aria-hidden="true" style="color:blue;"></i>');
    }
    filterx();
	});
});

$( document ).ready(function() {
  $("#searchp").keyup(function() {
    filterx();
  });
});

$(document).ready(function() {	
	$("#datestart").change(function(){
		 filterx();
	});
});

$(document).ready(function() {	
	$("#dateend").change(function(){
		 filterx();
	});
});
</script>
@endsection