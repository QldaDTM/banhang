@extends('theme.default')
@section('content')
<div class='row'>
  <div class='titilecon col-md-12 text-center text-danger'>
    <h2>Thống kê tổn thất</h2>
  </div>
</div>
<div class="form-group">
      <label for="loaithongke" class="control-label">Trạng thái...</label>   
      <select name="loaithongke" id="loaithongke" class="form-control col-md-3">
        <option value="0">Chưa xử lý</option>
        <option value="1">Đã xử lý</option>
      </select> 
</div>
<div class="row">
    <div class="col-sm-2">
      <label for="filter" class="control-label">Sắp xếp theo...</label>   
      <select name="filter" id="filter" class="form-control">
        <option value="mp">Mã phiếu</option>
        <option value="nx">Ngày xuất</option>
        <option value="tensp">Tên vật liệu</option>
        <option value="sl">Số lượng</option>
      </select>
    </div>
    <div class="col-sm-1">
      <label for="type" class="control-label">Hiển thị...</label>   
      <button type="button" class="btn btn-outline-secondary" id="type" name="type" value="asc">
        <i class="fa fa-arrow-up" aria-hidden="true" style="color:blue;" value="asc" id="mui" name="mui"></i>
      </button>
    </div>
    <div class="col-sm-3">
      <label for="search" class="control-label">Tìm kiếm...</label>  
      <input id="search" type="text" name="search" class="form-control" placeholder="Nhập từ khoá..." />
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
	$.ajax({
	type:'POST',
  url: '{{ url("thong-ke-TT-ajax") }}',
	data: {name:$("#filter").val(), type:$("#type").val(), keys:$("#search").val(), dates:$("#datestart").val(), datee:$("#dateend").val(), tinhtrang:$('#loaithongke').val()},
	async: true,
	success: function(data){
		$("#dtalble").html(data);
		}
	});	
}

$(document).ready(function() {	
	$("#filter").change(function(){
		 filterx();
	});
});

$(document).ready(function() {	
	$("#loaithongke").change(function(){
		$("#search").val('');
    $.ajax({
		type:'POST',
    url: '{{ url("thong-ke-TT-ajax") }}',
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
  $("#search").keyup(function() {
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