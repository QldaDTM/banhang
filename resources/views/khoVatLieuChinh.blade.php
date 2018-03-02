@extends('theme.default')
@section('content')

<div class='row'>
  <div class='titilecon col-md-12 text-center text-danger'>
    <h2>Thông tin kho vật liệu</h2>
  </div>
</div>
<div class='row'>
<!-- Thêm ncc modal-->
  <div class="modal fade" id="themksp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form method="post" action="{{url('/khovatlieuchinh-them') }}">
        {{ csrf_field() }}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm kho vật liệu</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Mã kho</label>
              <input type="text" class="form-control" name="themmaksp">
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Tên kho</label>
              <input class="form-control" name="themtenksp"></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Mã vật liệu</label>
              <select class="form-control" name="themmspksp">
                @foreach($sanpham as $sp)
                  <option value="{{ $sp->MaSanPham }}">{{ $sp->TenSanPham }}</option>';
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Số lượng chứa tối đa</label>
              <input type='number' min=1 class="form-control" name="themsltdksp"></input>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name='qlkho' value='ksp' />
            <button type="submit" class="btn btn-success" name='themksp'>Thêm kho</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button> 
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- sửa ncc modal-->
  <div class="modal fade" id="suaksp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form method="post" action="{{url('/khovatlieuchinh-sua') }}"  onsubmit="myFunction()">
            {{ csrf_field() }}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sửa kho vật liệu</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="form-control-label">Mã kho</label>
              <input type="text" class="form-control" id="suamaksp" name="suamaksp" readonly>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Tên kho</label>
              <input class="form-control" id="suatenksp" name="suatenksp" ></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label" >Mã vật liệu</label>
              <select class="form-control" id="suamspksp" name="suamspksp" >
                 @foreach($sanpham as $sp)
                  <option value="{{ $sp->MaSanPham }}">{{ $sp->TenSanPham }}</option>';
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Số lượng chứa tối đa</label>
              <input type='number' min=1 class="form-control" value=0 id="suasltdksp" name="suasltdksp" ></input>
            </div>
            <div class="form-group">
              <label for="message-text" class="form-control-label">Số lượng chứa hiện tại</label>
              <input type='number' min=1 class="form-control" id="suaslhtksp" value=0 name="suaslhtksp"  readonly/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Sửa kho</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button> 
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- Xoá ncc modal--> 
  <div class="modal fade" id="xoaksp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn xoá nhà cung cấp này</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <form method="post" action="{{url('/khovatlieuchinh-xoa') }}">
            {{ csrf_field() }}
            <input type='hidden' name='qlkho' value='ksp'  />
            <button type="submit" id="btncoxoaksp" class="btn btn-success" name="xoaksp" value="">Có</button>
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
          <th>Mã khu</th>
          <th>Tên khu</th>
          <th>Vật liệu</th>
          <th>Số lượng chứa tối đa </th>
          <th>Số lượng đang chứa </th>
          <th>
            <button class="btn btn-warning"  data-toggle="modal" data-target="#themksp">
              <i class="fa fa-plus" aria-hidden="true"></i> Thêm
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($khoVatLieuChinh as $kvlc)       
          <tr class="text-center">   
          <th scope="row">{{$kvlc->MaKhu}}</th>
          <td> {{$kvlc->TenKhu}}</td>
          <td> {{$kvlc->sanpham->TenSanPham}} </td>
          <td> {{$kvlc->SoLuongChuaToiDa}}</td>
          <td> {{$kvlc->SoLuongDangChua}}</td>
          <td>
            <button 
              data-toggle="modal"
              onclick = "suaksp('{{$kvlc->MaKhu}}','{{$kvlc->TenKhu}}','{{$kvlc->MaSanPham}}','{{$kvlc->SoLuongChuaToiDa}}' ,'{{$kvlc->SoLuongDangChua}}')" value="{{$kvlc->MaKhu}}" 
              data-target="#suaksp" 
              class="btn btn-primary" 
              type="button" >
              Sửa
            </button>
            <button data-toggle="modal" onclick="xoaksp('{{$kvlc->MaKhu}}')" data-target="#xoaksp" class="btn btn-danger" type="button" >Xoá</button></td>
          </tr>
        @endforeach
        
      </tbody>
    </table>
  </div>
</div>
<script>
  function suaksp(maksp,tenksp,msp,sltd,slht,){
    $('#suamaksp').val(maksp);
    $('#suatenksp').val(tenksp);
    $('#suamspksp').val(msp);
    $('#suamspksp').removeAttr('disabled');
    if(slht >= 1) {
      $('#suamspksp').attr('disabled','disabled');
    }
    $('#suasltdksp').val(sltd);
    $('#suaslhtksp').val(slht);
  }
  function submitsuaksp(){
    maksp=$('#suamaksp').val();
    tenksp=$('#suatenksp').val();
    mspksp=$('#suamspksp').val();
    sltd=$('#suasltdksp').val();
    slht=$('#suaslhtksp').val();
    if((slht-sltd)>=0){
      alert("Số lượng kho chứa tối đa phải lớn hơn số lương sản phẩm đang chứa");
      return false;
    }
    else {
      return true;
    }

  }
  function xoaksp(makho){
    $('#btncoxoaksp').val(makho);
  }
</script>
@endsection