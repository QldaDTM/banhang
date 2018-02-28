@extends('theme.default')
@section('content')
<div class='row'>
  <div class='titilecon col-md-12 text-center text-danger'>
    <h2>Thông tin nhà cung cấp</h2>
  </div>
</div>
<div class='row'>
<!-- Thêm ncc modal-->
  <div class="modal fade" id="themncc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm Nhà Cung Cấp</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Mã NCC</label>
              <input type="text" class="form-control" name="themmancc">
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Tên NCC</label>
              <input class="form-control" name="themtenncc"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Địa chỉ</label>
              <input class="form-control" name="themdcncc"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">SDT</label>
              <input type='number' class="form-control" name="themsdtncc"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Email</label>
              <input type='email' class="form-control" name="thememailncc"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Mã số thuế</label>
              <input class="form-control" name="themmstncc"></input>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name='qlkho' value='ncc' />
            <button type="submit" class="btn btn-success" name='themncc'>Thêm tài khoản</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button> 
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- sửa ncc modal-->
  <div class="modal fade" id="suancc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sửa Nhà Cung Cấp</h5>
          </div>
          
          <div class="modal-body">
            <div class="form-group">
              <label class="form-control-label">Mã NCC</label>
              <input type="text" class="form-control" name="suamancc" id="suamancc" readonly />
            </div>
            <div class="form-group">
              <label class="form-control-label">Tên NCC</label>
              <input class="form-control" name="suatenncc" id="suatenncc"></input>
            </div>
            <div class="form-group">
              <label class="form-control-label">Địa chỉ</label>
              <input class="form-control" name="suadcncc" id="suadcncc"></input>
            </div>
            <div class="form-group">
              <label class="form-control-label">SDT</label>
              <input type='number' class="form-control" name="suasdtncc" id="suasdtncc"></input>
            </div>
            <div class="form-group">
              <label class="form-control-label">Email</label>
              <input type='email' class="form-control" name="suaemailncc"  id="suaemailncc"></input>
            </div>
            <div class="form-group">
              <label class="form-control-label">Mã số thuế</label>
              <input class="form-control" name="suamstncc" id="suamstncc"></input>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name='qlkho' value='ncc' />
            <button type="submit" class="btn btn-success" name='suancc'>Sửa tài khoản</button>
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
          <form method="post">
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
    <table class="table table-striped table-success table-hover table-bordered text-center">
      <thead class="thead-inverse">
        <tr class='text-center' >
          <th>Mã NCC</th>
          <th>Tên NCC</th>
          <th>Địa Chỉ</th>
          <th>SDT </th>
          <th>Email </th>
          <th>Mã số thuế </th>
          <th>
            <button class="btn btn-warning"  data-toggle="modal" data-target="#themncc">
              <i class="fa fa-plus" aria-hidden="true"></i> Thêm
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($nhacungcap as $ncc)       
          <tr class="text-center">   
            <th scope="row">{{ $ncc->MaNhaCungCap }}</th>
            <td>{{ $ncc->TenNhaCungCap }}</td>
            <td>{{ $ncc->DiaChi}}</td>
            <td>{{ $ncc->SDT}}</td>
            <td>{{ $ncc->Email }}</td>
            <td>{{ $ncc->MaSoThue }} </td>
            <td>
              <button 
                data-toggle="modal" 
                onclick="suancc({{$ncc->MaNhaCungCap}},{{$ncc->TenNhaCungCap}},{{$ncc->DiaChi}},{{$ncc->SDT}},{{$ncc->Email}},{{$ncc->MaSoThue}})" 
                value="{{$ncc->MaNhaCungCap}}" data-target="#suancc" class="btn btn-primary" type="button" >Sửa</button>
                    <button data-toggle="modal" onclick="xoancc(' . "'" .{{$ncc->MaNhaCungCap}} ."'" . ')" data-target="#xoancc" class="btn btn-danger" type="button" >Xoá</button>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection