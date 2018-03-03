@extends('theme.default')
@section('content')


<div class='row'>
  <div class='titilecon col-md-12 text-center text-danger'>
    <h2>Thông tin Phiếu Vật liệu hỏng</h2>
  </div>
</div>
<div class='row'>
<!-- sửa ncc modal-->
  <div class="modal fade" id="suancc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="post" action="{{ url('ql-hanghu-sua')}}">
        	{{ csrf_field() }}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cập nhật phiếu nhập hàng hỏng</h5>
          </div>
          
          <div class="modal-body">
            <div class="form-group">
          
              <label class="form-control-label">Mã Phiếu Hỏng  </label>
              <input type="hidden" class="form-control" name="suamasp" id="suamasp" />
              <input type="text" class="form-control" name="suamancc" id="suamancc" readonly />
            </div>
            <div class="form-group">
              <label class="form-control-label">Tên Sản phẩm hỏng</label>
              <input class="form-control" name="suatenncc" id="suatenncc" readonly></input>
            </div>
            <div class="form-group">
              <label class="form-control-label">Mã Kho</label>
              <input class="form-control" name="suadcncc" id="suadcncc" readonly></input>
            </div>
            <div class="form-group">
              <label class="form-control-label">Số lượng</label>
              <input type='number' class="form-control" name="suasdtncc" id="suasdtncc" readonly></input>
            </div>
            <div class="form-group">
              <label class="form-control-label">Tình trạng</label>
              <select type='email' class="form-control" name="suaemailncc"  id="suaemailncc">
              <option value="0" >Chưa xử lý</option>
              <option value="1">Đã xử lý</option>
              </select>
            </div>
          
          </div>
          <div class="modal-footer">
            <input type="hidden" name='qlkho' value='ncc' />
            <button type="submit" class="btn btn-success" name='suancc'>cập nhật</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button> 
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- Xoá ncc modal--> 
  <div class="modal fade" id="xoancc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn xoá nhà cung cấp này</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <form method="post"  action="{{ url('ql-hanghu-xoa')}}">
          		{{ csrf_field() }}
            <input type='hidden' name='qlkho' value='ncc'  />
            <button type="submit" id="btncoxoancc" class="btn btn-success" name="xoancc" value="">Có</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
          </form>
        </div>
      </div>
    </div>
  </div> 
</div>

<div class='row'>
  <div class='col-md-12'>


		<input class='text-center' type="text" id='Maphieuxuatkho' placeholder="Mã phiếu xuất kho"  />
		<button onclick='kiemtrama()' class='btn btn-primary'>Nhập mã</button>
		<button onclick='dongbang()' class='btn btn-danger'>Đóng</button>
    <input type="hidden" id="TenNhanVien" value="{{ Auth::user()->name }}"/>
		<div class="row clearfix">
		<div class="col-md-12 column">
		<div id='in' style='display:none'></div>			
			<form method="post" action="{{url('ql-hanghu-them')}}" onsubmit="return onsubmitnhapkho()">
        {{ csrf_field() }}
				<table  style="display:none" class= " table table-striped table-success table-hover table-bordered text-center" id="tab_logic">
					<thead class="thead-inverse">
						<col width="100">
		 			 	<col width="250">
						<col width="150">
						<col width="300">
						<tr >
							<th class="text-center">
								Checked
							</th>
							<th class="text-center">
								Mã vật liệu
							</th>
							<th class="text-center">
								Số lượng 
							</th>
							<th class="text-center">
								Vị trí kho
							</th>
							<th class="text-center">
								<a id="add_row" class="btn btn-primary">Add Row</a>
							</th>
						</tr>
					</thead>
					<tbody >
					<tr class='addr' id="addr0"></tr>
					</tbody>
					<tr>
						<td colspan='3'  ><input type="hidden" id='MaHoaDonXuat' name='MaHoaDonXuat' value=''/></td>
						<td colspan='2' ><button type='submit' id='nhapkhosubmit' value='nhapkhosubmit' name='nhapkhosubmit'class='btn btn-success'>Thực hiện</button></td>
						
					</tr>
				</table>
			</form>
			
		</div>
		</div>


    <table class="table table-striped table-success table-hover table-bordered text-center">
      <thead class="thead-inverse">
        <tr class='text-center' >
          <th>Mã phiếu nhập kho hỏng</th>
          <th>Tên Vật liệu</th>
          <th>Mã khu hỏng</th>
          <th>Số lượng </th>
          <th>Tình trạng </th>
          <th>
          </th>
        </tr>
      </thead>
      <tbody>
       {!! $hanghu !!}
        
      </tbody>
    </table>
  </div>
</div>
<script>
  function suancc(masp,maphieu,tensp,makho,soluong,tinhtrang){
    $('#suamasp').val(masp);
    $('#suamancc').val(maphieu);
    $('#suatenncc').val(tensp);
    $('#suadcncc').val(makho);
    $('#suasdtncc').val(soluong);
    $('#suaemailncc').val(tinhtrang);
  }
  function xoancc(mancc){
    $('#btncoxoancc').val(mancc);
  }
</script>

<script>
var i =0;
var maxk='';
$(document).ready(function(){
  let sp;
  let mang= [];
  $("#add_row").click(function(){
    let maspdau=  $('#Maphieuxuatkho').val();
    $.ajax({
      type: "GET",
      url: "{{url('ql-hanghu-tim')}}",
      data: {gspkh:maspdau},
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

function dongbang(){
  $('#tab_logic').css('display','none');
}

function kiemtrama(){
  $.ajax({
    type: "GET",
    url: "{{url('ql-hanghu-tim')}}",
    data: {getidkh:'getidkh'},
    success: function(success){
      $('#MaHoaDonXuat').val(success);

    },
    dataType:'text'
  });
  let maspdau=  $('#Maphieuxuatkho').val();
  maxk= maspdau;
   $('#nhapkhosubmit').val(maxk);
  
  $.ajax({
    type: "GET",
    url: "{{url('ql-hanghu-tim')}}",
    data: {ktgspkh:maspdau},
    success: function(success){
      if (success== 0){ 
        alert('Mã Xuất kho không tồn tại');
          }
      else{
        $('#tab_logic').css('display','block');
        $('.addr').remove();
        $('#tab_logic').append('<tr class="addr" id="addr0"></tr>');
        i=0;
        $("#add_row").trigger('click');
      }
      
    },
    dataType:'text'
  });
};


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
  let masp = $('#mspnk'+id).val();
  $.ajax({
    type: "GET",
    url: "{{url('ql-hanghu-tim')}}",
    data: {getsoluonghdxk:masp,getsoluonghdxk1:maxk},
    success: function(success){
      $('#slnk'+id).attr('max',parseInt(success));
      $('#slnk'+id).attr('placeholder','SL còn: '+parseInt(success));
    },
    dataType:'text'
  });
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

function ghi(i,mang)
{
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
      "<input name='slnk"+i+"' type='number' id='slnk"+i+"' min=0 required onchange='onchangevtk("+i+")' placeholder='Số lượng' class='form-control input-md slnk'  />"+
      " </td>"+
      "<td>"+
      "<select multiple onchange='onchangevtk("+i+")'    required name='vtknk"+i+"[]' id='vtknk"+i+"' class='form-control input-md vtknk'>"+
      "</select>"+
      "</td>"+
      "<td>"+
      "<button class='delete_row  btn btn-danger' onclick='xoacot("+i+")'>Xoá cột</button>"+
      "</td>");

      $('#tab_logic').append('<tr class="addr" id="addr'+(i+1)+'"></tr>');
     
    $('.mspnk').each(function(){
      let option1 = option2;
      option1 = '<option value="'+ $('#'+this.id).val()+'">'+ $('#'+this.id+' option:selected').text()+'</option>'+option1;
      $('#'+this.id).html(option1);       
    });

  let maspdau= $( "#mspnk"+i ).val();
     
    $.ajax({
      type: "GET",
      url: "{{url('ql-hanghu-tim')}}",
      data: {selectkh:maspdau},
      success: function(success){
        setnoidungkho(i,success);
      },
      dataType:'json'
    });

};
function changemsnk(id) 
{
  let maspdau= $( "#mspnk"+id ).val();
  
  $.ajax({
    type: "GET",
    url: "{{url('ql-hanghu-tim')}}",
    data: {selectkh:maspdau},
    success: function(success){
      setnoidungkho(id,success);
    },
    dataType:'json'
  });




  $.ajax({
    type: "GET",
    url: "{{url('ql-hanghu-tim')}}",
    data: {gspkh:maxk},
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

function sua(mang)
{
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

function xoacot(r)
{

	$("#addr"+r).html('');
  $.ajax({
    type: "GET",
    url: "{{url('ql-hanghu-tim')}}",
    data: {gspkh:maxk},
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
  var mywindow = window.open('', 'PRINT', 'height=1200,width=600');
  let r= $('#TenNhanVien').val();
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
    '</td>'+
    '</tr>'
  });

  

  iddein = $('#MaHoaDonXuat').val();
  mywindow.document.write('<html><head><title></title>');
  mywindow.document.write('</head><body >');
  mywindow.document.write('<h1>Công Ty Trách Nhiệm Hữu Hạn LTTS</h1>');
  mywindow.document.write('<h1><center>Phiếu Nhập Kho Hỏng</center></h1>');
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
  mywindow.print();
  //mywindow.close();
  
  $('#MaHoaDonXuat').val(maxk);
  return bool;
}

</script>

@endsection