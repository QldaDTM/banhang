@extends('theme.default')
@section('content')
<div class='row'>
  <div class='titilecon col-md-12 text-center text-danger'>
    <h2>Thông tin Khách Hàng</h2>
  </div>
</div>
<div class='row'>
<!-- Thêm kh modal-->
  <div class="modal fade" id="themkh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form method="post" action="{{url('/ql-khachhang-them') }}">
          {{ csrf_field() }}

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm Khách Hàng</h5>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Mã Khách Hàng</label>
              <input type="number" class="form-control" name="themmakh" />
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Tên Khách Hàng</label>
              <input class="form-control" name="themtenkh"></input>
            </div>

           <div class="form-group">
              <label for="message-text" class="form-control-label">SDT</label>
              <input type='number' class="form-control" name="themsdtkh"></input>
            </div>

            <div class="form-group">
              <label for="message-text" class="form-control-label">Địa chỉ</label>
              <input class="form-control" name="themdckh"></input>
            </div>


          </div>
          <div class="modal-footer">
            <input type="hidden" name='qlkho' value='kh' />
            <button type="submit" class="btn btn-success">Thêm tài khoản</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button> 
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- sửa kh modal-->
   <div class="modal fade" id="suakh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form method="post" action="{{url('/ql-khachhang-sua') }}">
          {{ csrf_field() }}

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sửa Khách Hàng</h5>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Mã Khách Hàng</label>
              <input type="number" class="form-control" name="suamakh" id="suamakh" />
            </div>
            
            <div class="form-group">
              <label for="message-text" class="form-control-label">Tên Khách Hàng</label>
              <input class="form-control" name="suatenkh" id="suatenkh"/>
            </div>

           <div class="form-group">
              <label for="message-text" class="form-control-label">SDT</label>
              <input type='number' class="form-control" name="suasdtkh" id="suasdtkh" />
            </div>

            <div class="form-group">
              <label for="message-text" class="form-control-label">Địa chỉ</label>
              <input class="form-control" name="suadckh" id="suadckh" />
            </div>


          </div>
          <div class="modal-footer">
            <input type="hidden" name='qlkho' value='kh' />
            <button type="submit" class="btn btn-success">Sửa tài khoản</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button> 
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- Xoá kh modal--> 
  <div class="modal fade" id="xoakh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn xoá Khách Hàng này</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <form method="post" action="{{url('/ql-khachhang-xoa') }}">
            {{ csrf_field() }}
            <input type='hidden' name='qlkho' value='kh' />
            <button type="submit" id="btncoxoakh" class="btn btn-success" name="xoakh" value="">Có</button>
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
          <th>Mã Khách Hàng</th>
          <th>Tên Khách Hàng</th>
          <th>SDT </th>
          <th>Địa Chỉ</th>
          <th>
            <button class="btn btn-warning"  data-toggle="modal" data-target="#themkh">
              <i class="fa fa-plus" aria-hidden="true"></i> Thêm
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($khachhang as $kh)       
          <tr class="text-center">   
            <th scope="row">{{ $kh->MaKhachHang }}</th>
            <td>{{ $kh->TenKhachHang }}</td>
            <td>{{ $kh->SDT}}</td>
            <td>{{ $kh->DiaChi}}</td>
            <td>
              <button data-toggle="modal" onclick="suakh( '{{$kh->MaKhachHang}}' ,'{{$kh->TenKhachHang}}', '{{ $kh->SDT }}','{{ $kh->DiaChi }}')" value="{{$kh->MaKhachHang}}" data-target="#suakh" class="btn btn-primary" type="button" >
                Sửa
              </button>
              <button data-toggle="modal" onclick="xoakh('{{$kh->MaKhachHang}}')" data-target="#xoakh" class="btn btn-danger" type="button" >
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
  function suakh(makh,tenkh,sdt,diachi){
    
    $('#suamakh').val(makh);
    $('#suatenkh').val(tenkh);
    $('#suasdtkh').val(sdt);
    $('#suadckh').val(diachi);
  }
  function xoakh(makh){
    $('#btncoxoakh').val(makh);
  }
</script>
@endsection