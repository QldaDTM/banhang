@extends('theme.default')
@section('content')


<div class='row'>
  <div class='titilecon col-md-12 text-center text-danger'>
    <h2>Thông tin kho vật liệu</h2>
    <h5 class='pull-right'>Tìm kiếm <input id='searchcsp' type="text"></h5>
  </div>
</div>
<div class='row'>
  <!-- Thêm ncc modal-->
  <div class="modal fade" id="themcsp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm vật liệu</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Mã vật liệu</label>
              <input type="text" class="form-control" name="themmacsp">
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Tên vật liệu</label>
              <input class="form-control" name="themtencsp"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Nhà cung cấp</label>
              <select class="form-control" name="themncccsp">
                @foreach($nhacungcap as $ncc)
                  <option value="{{ $ncc->MaNhaCungCap }}">{{ $ncc->TenNhaCungCap }}</option>';
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Số lượng tồn</label>
              <input type='number' min=0 class="form-control" name="themsltcsp"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Đơn giá</label>
              <input type='number' min=1 class="form-control" name="themdgcsp"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Đơn vị</label>
              <input type='text' min=1 class="form-control" name="themdvcsp"></input>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name='qlkho' value='csp' />
            <button type="submit" class="btn btn-success" name='themcsp'>Thêm vật liệu</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button> 
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- sửa ncc modal-->
  <div class="modal fade" id="suacsp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sửa Vật liệu</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Mã vật liệu</label>
              <input type="text" class="form-control" name="suamacsp"  id="suamacsp" readonly>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Tên vật liệu</label>
              <input class="form-control" name="suatencsp" id="suatencsp"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Nhà cung cấp</label>
              <select class="form-control" name="suancccsp" id="suancccsp">
              @foreach($nhacungcap as $ncc)
                <option value="{{ $ncc->MaNhaCungCap }}">{{ $ncc->TenNhaCungCap }}</option>
              @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Số lượng tồn</label>
              <input type='number' min=1 class="form-control" name="suasltcsp" id="suasltcsp"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Đơn giá</label>
              <input type='number' min=1 class="form-control" name="suadgcsp" id="suadgcsp"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Đơn vị</label>
              <input type='text' min=1 class="form-control" name="suadvcsp" id="suadvcsp"></input>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name='qlkho' value='csp' />
            <button type="submit" class="btn btn-success" name='suacsp'>Sửa vật liệu</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button> 
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Xoá ncc modal--> 
  <div class="modal fade" id="xoacsp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn xoá nhà cung cấp này</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <form method="post">
            <input type='hidden' name='qlkho' value='csp'  />
            <button type="submit" id="btncoxoacsp" class="btn btn-success" name="xoacsp" value="">Có</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
          </form>
        </div>
      </div>
    </div>
  </div> 
</div>

<div class='row'>
  <div class='col-md-12'>
    <table class="table table-striped table-success table-hover table-bordered text-center">
      <thead class="thead-inverse">
        <tr class='text-center' >
          <th>Mã vật liệu</th>
          <th>Tên vật liệu</th>
          <th>Nhà cung cấp</th>
          <th>Số lượng tồn </th>
          <th>Đơn giá </th>
          <th>Đơn vị </th>
          <th>
            <button class="btn btn-warning"  data-toggle="modal" data-target="#themcsp">
              <i class="fa fa-plus" aria-hidden="true"></i> Thêm
            </button>
          </th>
        </tr>
      </thead>
      <tbody id='csptbody'>
         @foreach($sanpham as $sp)       
          <tr class="text-center">   
            <th scope="row">{{ $sp->MaSanPham }}</th>
            <td>{{ $sp->TenSanPham }}</td>
            <td>{{ $sp->nhacungcap->TenNhaCungCap}}</td>
            <td>{{ $sp->SoLuongTon}}</td>
            <td>{{ $sp->DonGia }}</td>
            <td>{{ $sp->DonVi }} </td>
            <td>
              <button data-toggle="modal" onclick="suacsp( '{{$sp->MaSanPham}}' ,' {{$sp->TenSanPham}} ','{{ $sp->MaNhaCungCap }}', '{{ $sp->SoLuongTon }}', '{{$sp->DonGia}}',' {{$sp->DonVi}} ')" value="{{$sp->MaSanPham}}" data-target="#suacsp" class="btn btn-primary" type="button" >
                Sửa
              </button>
              <button data-toggle="modal" onclick="xoacsp('{{$sp->MaSanPham}}')" data-target="#xoacsp" class="btn btn-danger" type="button" >
                Xoá
              </button>
            </td>
          </tr>
          @endforeach
        
      </tbody>
    </table>
  </div>
</div>
<script>
$( document ).ready(function() {
  $("#searchcsp").keyup(function() {
    var r= $("#searchcsp").val();
    $.ajax({
      type: "POST",
      url: 'http://localhost/quanlykho/Controller/search.php',
      data: {searchcsp:r},
      success: function(success){
        $('#csptbody').html(success);
      },
      dataType:'text'
    });
  });
});
function suacsp(macsp,tencsp,ncc,slt,dg,dv){
  alert(ncc);
  $('#suamacsp').val(macsp);
  $('#suatencsp').val(tencsp);
  $('#suancccsp').val(ncc);
  $('#suasltcsp').val(slt);
  $('#suadgcsp').val(dg);
  $('#suadvcsp').val(dv);
}
function xoacsp(macsp){
  $('#btncoxoacsp').val(macsp);
}
</script>
@endsection
