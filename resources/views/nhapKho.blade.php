@extends('theme.default')
@section('content')
<div class='row'>
  <div class='titilecon col-md-12 text-center text-danger'>
    <h2>Lập phiếu nhập kho</h2>
  </div>
</div>
<div class="row clearfix">
<div class="col-md-12 column">
<div id='in' style='display:none'></div>			
	<form method="post" onsubmit="return onsubmitnhapkho() ">
  {{ csrf_field() }}
		<table class="table table-striped table-success table-hover table-bordered text-center" id="tab_logic">
			<thead class="thead-inverse">
				<col width="50">
 			 	<col width="250">
				<col width="150">
				<col width="150">
				<tr >
					<th class="text-center">
						Checked
					</th>
					<th class="text-center">
						Mã sản phẩm
					</th>
					<th class="text-center">
						Số lượng 
					</th>
					<th class="text-center">
						Đơn giá
					</th>
					<th class="text-center">
						Vị trí kho
					</th>
					<th class="text-center">
						<a id="add_row" class="btn btn-primary">Add Row</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr id='addr0'>
					<td>
						<input disabled type='checkbox' name='checknk[]' value='0' id='checknk0'  class="checknk form-control"/>
					</td>
					<td >
						<select onchange='changemsnk(0)' name="mspnk0" id='mspnk0' class='mspnk form-control' >
							<?php 
							//echo $nhapkho->xulymasp();
							?>
						</select>
					</td>
					<td>
						<input type='number' name='slnk0' min=0 id='slnk0'  required onchange='onchangevtk(0)' placeholder='Số lượng' class="form-control"/>
					</td>
					<td>
						<input type='number' name='dgnk0' min=0 id='dgnk0' required placeholder='Đơn giá' class="form-control"/>
					</td>
					<td>
						<select onchange='onchangevtk(0)' multiple required name='vtknk0[]' id='vtknk0' class="vtknk form-control" ></select>
					</td>
					<td>
						<button class='delete_row btn btn-danger' onclick='xoacot(0)'>Xoá cột</button>
					</td>
					
				</tr>
				<tr id='addr1'></tr>
			</tbody>
			<tr>
				<td colspan='3' ><input type="hidden" id='MaHoaDonXuat' name='MaHoaDonXuat' value=''/></td>
				<td colspan='3' ><button type='submit' id='nhapkhosubmit' value='nhapkhosubmit' name='nhapkhosubmit'class='btn btn-success'>Thực hiện</button></td>
				
			</tr>
		</table>
	</form>
	
</div>
</div>
<script>
  var mywindow = window.open('', 'PRINT', 'height=1200,width=600');
  $(document).ready(function(){
    let i =1;
    let sp;
    let mang= [];
    $.ajax({
    type: "POST",
    url: 'http://localhost/quanlykho/Controller/search.php',
    data: {getidnk:'getidnk'},
    success: function(success){
      $('#MaHoaDonXuat').val(success);
    },
    dataType:'text'
    });
    $( "#mspnk0" ).ready( function(){
      let maspdau= $( "#mspnk0" ).val();
     
      $.ajax({
        type: "POST",
        url: 'http://localhost/quanlykho/Controller/search.php',
        data: {selectkhonk:maspdau},
        success: function(success){
          setnoidungkho(0,success);
        },
        dataType:'json'
      });
    } );
    //
    $("#add_row").click(function(){    
      $.ajax({
      type: "POST",
      url: 'http://localhost/quanlykho/Controller/search.php',
      data: {gspnk:'gspnk'},
      success: function(success){    
      $('.mspnk').each(function(){
       
        let m = $('#'+this.id).val();
        success = $(success).filter((e,item) => item.MaSanPham !== m); 
      });
      if(success.length>0){
        ghi(i,success);
        i++; 

      }
      },
      dataType:'json'
    }); 
  });
});

function onsubmitnhapkho() {
  let bool= true;
  if($('.checknk').length===0)  bool= false;
  $('.checknk').each(function(){
    
    if($('#'+this.id).is(":checked")==false){
      bool=false;
    }
  });
  if(bool==true){
    $('.checknk').each(function(){
      $('#'+this.id).removeAttr("disabled");
    });
  }
  return inphieu(bool);
};

function setnoidungkho(id,mang){
  let option=''
  $(mang).map((key,m)=>{
    option += '<option data-slton='+(m.SoLuongChuaToiDa - m.SoLuongDangChua) +'  value="'+ m.MaKhu+'">'+m.TenKhu+' | SL Còn: '+ (m.SoLuongChuaToiDa - m.SoLuongDangChua) +'</option>'
  });
  $('#vtknk'+id).html(option);
}

function onchangevtk(id){
  let tong=0;
  $('#vtknk' +id+' option:selected').each(function(){
    var $value =$(this).data('slton');
    tong+=$value;
    
});

  if($('#slnk' +id).val()!==''){
    
    if (tong>=$('#slnk' +id).val() ){
      $('#checknk' +id).attr('checked','checked');
    }
    else  $('#checknk' +id).removeAttr('checked');
  }
  else  $('#checknk' +id).removeAttr('checked');
};

function ghi(i,mang){
  let option2 = '';
  let option= '';
  $(mang).map((key,m)=>
    {
      if (key===0){
        option += '<option value="'+m.MaSanPham+'">'+m.TenSanPham+'</option>';
      }
      else{
        option2 += '<option value="'+m.MaSanPham+'">'+m.TenSanPham+'</option>';
      }
    }
  );
  option +=option2;
  
  $('#addr'+i).html(
      "<td>"+
      "<input name='checknk[]' value='"+i+"' type='checkbox' id='checknk"+i+"' disabled class='form-control input-md checknk'  />"+
      " </td>"+
      "<td>"+ 
      "<select name='mspnk"+i+"' onchange='changemsnk("+i+")'  id='mspnk"+i+"' class='mspnk form-control' required>"+ option + 
      "</select>"+  
      "</td>"+
      "<td>"+
      "<input name='slnk"+i+"' type='number' id='slnk"+i+"'  required onchange='onchangevtk("+i+")' placeholder='Số lượng' class='form-control input-md slnk'  />"+
      " </td>"+
      "<td>"+
        "<input type='number' name='dgnk0' min=0 id='dgnk0'  required placeholder='Đơn giá' class='form-control'/>"+
			"</td>"+
      "<td>"+
      "<select multiple onchange='onchangevtk("+i+")'    required name='vtknk"+i+"[]' id='vtknk"+i+"' class='form-control input-md vtknk'>"+
      "</select>"+
      "</td>"+
      "<td>"+
      "<button class='delete_row  btn btn-danger' onclick='xoacot("+i+")'>Xoá cột</button>"+
      "</td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
     
  $('.mspnk').each(function(){
    let option1 = option2;
    option1 = '<option value="'+ $('#'+this.id).val()+'">'+ $('#'+this.id+' option:selected').text()+'</option>'+option1;
    $('#'+this.id).html(option1);       
  });

  let maspdau= $( "#mspnk"+i ).val();
    $.ajax({
      type: "POST",
      url: 'http://localhost/quanlykho/Controller/search.php',
      data: {selectkhonk:maspdau},
      success: function(success){
        setnoidungkho(i,success);
      },
      dataType:'json'
    });

}
function changemsnk(id) {
  let maspdau= $( "#mspnk"+id ).val();
  
  $.ajax({
    type: "POST",
    url: 'http://localhost/quanlykho/Controller/search.php',
    data: {selectkhonk:maspdau},
    success: function(success){
      setnoidungkho(id,success);
    },
    dataType:'json'
  });

  $.ajax({
    type: "POST",
    url: 'http://localhost/quanlykho/Controller/search.php',
    data: {gspnk:'gspnk'},
    success: function(success){
      
      $('.mspnk').each(function(){
        let m = $('#'+this.id).val();
        success = $(success).filter((e,item) => item.MaSanPham !== m);  
      });
      if(success.length>0){
        sua(success);
      }
    },
    dataType:'json'
  });
};

function sua(mang){
  let option= '';
  $(mang).map((key,m)=>
          {
            option += '<option value="'+m.MaSanPham+'">'+m.TenSanPham+'</option>';             
          }
        );
  $('.mspnk').each(function(){
    let option1 = option;
    option1 = '<option value="'+ $('#'+this.id).val()+'">'+ $('#'+this.id+' option:selected').text()+'</option>'+option1;
    $('#'+this.id).html(option1);       
  });      

}

function xoacot(r){
	$("#addr"+r).html('');
  $.ajax({
    type: "POST",
    url: 'http://localhost/quanlykho/Controller/search.php',
    data: {gspnk:'gspnk'},
    success: function(success){
      $('.mspnk').each(function(){
        let m = $('#'+this.id).val();
        success = $(success).filter((e,item) => item.MaSanPham !== m);  
      });
      if(success.length>0){
        sua(success);
      }
    },
    dataType:'json'
  });
};

function inphieu(bool)
{  
  let r= $('#TenNhanVien').html().substring(4);
  let string="";
  $('.checknk').each(function(){
    let mathutu= $('#'+this.id).val();
    let kho1='';
    let kho= $('#vtknk' +mathutu+' option:selected').each(function(){
            kho1+=$(this).val()+ ',';
            });
    kho1 =kho1.substring(0,kho1.length-1);
    string+= '<tr>'+
    
    '<td> '+ $('#mspnk'+mathutu).val()+'   </td>'+
    '<td> '+ $('#slnk'+mathutu).val()+'   </td>'+
    '<td> '+ kho1+
'   </td>'+
    '</tr>'
  });

  iddein = $('#MaHoaDonXuat').val();
  mywindow.document.write('<html><head><title></title>');
  mywindow.document.write('</head><body >');
  mywindow.document.write('<h1>Công Ty Trách Nhiệm Hữu Hạn LTTS</h1>');
  mywindow.document.write('<h1><center>Phiếu Nhập Kho</center></h1>');
  mywindow.document.write('<h3>Số phiếu nhập kho: '+iddein+'</h3>');
  mywindow.document.write('<h3>Nhân viên xuất kho: '+r+'</h3>');
  mywindow.document.write('<h3>Ngày xuất kho: '+new Date().toLocaleString()+'</h3>');
  mywindow.document.write(
    '<table style="margin-left:75px;" border="1" width="450"> '+
    '<tr>'+
    '<th width="33%" class="text-primary">Tên Sản phẩm </th><th width="33%"> Số lượng </th><th width="33%">Vị trí kho</th>'+
    '</tr>'+  
    string+
    '<table>');
  mywindow.document.write('<br><br><br><div style="margin-left:75px;"> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp Nhân viên ký tên  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Người nhận ký tên</div>'); 
  mywindow.document.write('</body></html>');

  mywindow.document.close(); 
  mywindow.focus(); 
  //mywindow.print();
  //mywindow.close();
  return bool;
}
function hienthiphieuin(){
  mywindow.print();
}

</script>
@endsection