<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\products;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class APIController extends Controller
{
    public function getProducts(){
        $products=products::all();
        return response()->json($products);

    }
    public function getOneProduct($id)							
	{							
	$product = products::find($id);							
	return response()->json($product);							
	}							
	public function addProduct(Request $request)							
	{							
	$product = new products();							
	$product->name = $request->input('name');							
	$product->image = $request->input('image');							
	$product->description = $request->input('description');							
	$product->unit_price = intval($request->input('unit_price'));							
	$product->promotion_price = intval($request->input('promotion_price'));							
	$product->unit = $request->input('unit');							
	$product->new = intval($request->input('new'));							
	$product->id_type = intval($request->input('id_type'));							
	$product->save();							
	return $product;							
	}							
	public function deleteProduct($id)							
	{							
	$product = products::find($id);							
	$fileName = 'source/image/product/' . $product->image;							
	if (File::exists($fileName)) {							
	File::delete($fileName);							
	}							
	$product->delete();							
	return ['status' => 'ok', 'msg' => 'Delete successed'];							
	}							
	public function editProduct(Request $request, $id)							
	{							
	$product = products::find($id);							
								
	$product->name = $request->input('name');							
	$product->image = $request->input('image');							
	$product->description = $request->input('description');							
	$product->unit_price = intval($request->input('unit_price'));							
	$product->promotion_price = intval($request->input('promotion_price'));							
	$product->unit = $request->input('unit');							
	$product->new = intval($request->input('new'));							
	$product->id_type = intval($request->input('id_type'));							
								
	$product->save();							
	return response()->json(['status' => 'ok', 'msg' => 'Edit successed']);							
	}							
								
	public function uploadImage(Request $request)							
	{							
	// process image							
	if ($request->hasFile('uploadImage')) {							
	$file = $request->file('uploadImage');							
	$fileName = $file->getClientOriginalName();							
								
	$file->move('source/image/product', $fileName);							
								
	return response()->json(["message" => "ok"]);							
	} else return response()->json(["message" => "false"]);							
	}	
// -----------------------------------------------------------------------------------------

	public function getdataFromAPI(){
		$response = Http::get('https://645e542e8d08100293fcd90e.mockapi.io/sinhvien');
		if($response->successful()){
			$data = $response->json();
			return view('apicrud.data',compact('data'));
		}else{
			// 
		}return view('error');
	}	
	// -------------------------------------------
		
	// public function destroy($id){
	
	// 	$response = Http::delete('https://645e542e8d08100293fcd90e.mockapi.io/sinhvien' . $id);
	// 	if ($response->successful()) {
	// 		// Xóa thành công, thực hiện các hành động khác (nếu cần)
	// 		return $this->getdataFromAPI();
	// 	} else {
	// 		// Xử lý lỗi khi không thể xóa
	// 		return redirect()->back()->withErrors('Không thể xóa dữ liệu.');
	// 	}
    // // ...
	// }
	public function destroy(Request $request,$id)
{
    $response = Http::delete('https://645e542e8d08100293fcd90e.mockapi.io/sinhvien/' . $id);

    if ($response->successful()) {
        // Xóa thành công, thực hiện các hành động khác (nếu cần)
        // return response()->json(['message' => 'Xóa thành công'], 200);
		$request->session()->flash('delete_success', 'Xóa thành công');
		return $this->getdataFromAPI();
    } else {
        // Xử lý lỗi khi không thể xóa
        return response()->json(['message' => 'Không thể xóa dữ liệu'], $response->status());
    }
}
	
}
