<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qlNhaCungCap;

class qlNhaCungCapController extends Controller
{
  public function qlNhaCungCap() {
    $nhacungcap = qlNhaCungCap::all();
    return view('qlNhaCungCap',["nhacungcap"=>$nhacungcap]);
  }
	public function insert(Request $request){
    	$nhacungcap = new qlNhaCungCap;
    	$nhacungcap->MaNhaCungCap = $request->themmancc;
    	$nhacungcap->TenNhaCungCap = $request->themtenncc;
    	$nhacungcap->DiaChi = $request->themdcncc;
    	$nhacungcap->SDT = $request->themsdtncc;
    	$nhacungcap->Email = $request->thememailncc;
    	$nhacungcap->MaSoThue= $request->themmstncc;
    	$nhacungcap->save();
    	return redirect()->back();
  }
  public function update(Request $request){
  	$nhacungcap = qlNhaCungCap::where(
  		'MaNhaCungCap',$request->suamancc)
  		->update(
  			['TenNhaCungCap' => $request->suatenncc,
  			'DiaChi' => $request->suadcncc,
  			'SDT' => $request->suasdtncc,
  			'Email' => $request->suaemailncc,
  			'MaSoThue' => $request->suamstncc ]);
  	return redirect()->back();
  }
  public function delete(Request $request){
  	$nhacungcap = qlNhaCungCap::where('MaNhaCungCap',$request->xoancc)->delete();
  	return redirect()->back();
  }
}
?>
<script>
  function suancc(mancc,tenncc,diachi,sdt,email,mst){
    
    $('#suamancc').val(mancc);
    $('#suatenncc').val(tenncc);
    $('#suadcncc').val(diachi);
    $('#suasdtncc').val(sdt);
    $('#suaemailncc').val(email);
    $('#suamstncc').val(mst);
  }
  function xoancc(mancc){
    $('#btncoxoancc').val(mancc);
  }
</script>