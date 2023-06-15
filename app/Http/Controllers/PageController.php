<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use  Illuminate\Support\Facades\Session;
use App\Models\comments;
use App\Models\products;
use App\Models\Product;
use App\Models\Product_type;
use App\Models\slide;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Source;
use App\Models\bill_detail;
class PageController extends Controller
{
    // public function getIndex(){			
    // 	return view('page.trangchu');		
    // }
//     public function getLoaiSP(){			
//     	return view('page.loai_sanpham');		
//     }
//     public function getChitiet(){			
//         return view('page.chitiet_sanpham');			
//         }			
                    
//     public function marter(){			
//             return view('master');			
//             }	
//     public function if(){			
//                 return view('if');			
//                 }	
//     public function for(){			
//             return view('vonglapfor');			
//     }				
//     public function lienhe(){			
//         return view('page.lienhe');			
// }    
//     public function about(){			
//     return view('page.about');			
//     }      
    public function getIndex(){							
    	$slide =slide::all();						
    	// return view('page.trangchu',['slide'=>$slide]);						
        $new_product = products::where('new',1)->paginate(8);
        $sanpham_khuyenmai = products::where('promotion_price','<>',0)->paginate(4);							
        return view('page.trangchu',compact('new_product','sanpham_khuyenmai'));					
    					
    }							
    						
    public function getDetail(Request $request){							
    	$sanpham = products:: where('id',$request->id)->first();
        $splienquan = products::where('id','<>',$sanpham->id,'and','id_type','=',$sanpham->id_type)->paginate(3);						
        $comments =	comments::where('id_product',$request->id)->get();					
    	return view('page.chitiet_sanpham',compact('sanpham','splienquan','comments'));						
    }	
    // public function getLoaiSp($type)	
    // {
    //     $type_product=Product_type::all();
    //     $sp_theoloai=products::where('id_type',$type)->get();
    //     $sp_khac=products::where('id_type','<>',$type)->get()->paginate(3);
    //     return view('page.loai_sanpham',compact('sp_theoloai','type_product','sp_khac'));


    // }  
    public function getLoaiSp($type)	
    {
        $type_product=Product_type::all();
        $sp_theoloai=products::where('id_type',$type)->get();
        $sp_khac=products::where('id_type','<>',$type)->paginate(3);

        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','type_product'));


    }  


    // CRUD---------------------------------------------------------------------------------------------------
    public function getIndexAdmin()														
	{
	    $products = products::all();														
	 return view('pageadmin.admin')->with(['products' => $products, 'sumSold' => count(bill_detail::all())]);														
	 }	
     
     
    public function getAdminAdd(){
        return view('pageadmin.formAdd');
    }


    public function postAdminAdd(Request $request)							
 {							
    $product = new products();							
    if ($request->hasFile('inputImage')) {							
    $file = $request->file('inputImage');							
    $fileName = $file->getClientOriginalName('inputImage');							
    $file->move('source/image/product', $fileName);							
    }							
    $file_name = null;							
    if ($request->file('inputImage') != null) {							
    $file_name = $request->file('inputImage')->getClientOriginalName();							
    }							
                                
    $product->name = $request->inputName;							
    $product->image = $file_name;							
    $product->description = $request->inputDescription;							
    $product->unit_price = $request->inputPrice;							
    $product->promotion_price = $request->inputPromotionPrice;							
    $product->unit = $request->inputUnit;							
    $product->new = $request->inputNew;							
    $product->id_type = $request->inputType;							
    $product->save();							
    return $this->getIndexAdmin();							
    }							
         
    // ---------------------------------------------------
    public function getAdminEdit($id)												
	{												
	 $product = products::find($id);												
	 return view('pageadmin.formEdit')->with('product', $product);												
	}	
    public function postAdminEdit(Request $request)	
    {
        $id=$request->editIt;
        $product=new products();
        if($request->hasFile('editImage')){
            $file=$request->file('editImage');
            $fileName=$file->getClientOriginalName('editImage');
            $file->move('source/image/products',$fileName);

        }
        if($request->file('editImage')!=null){
            $product->image=$fileName;
        }

        $product->name=$request->editName;
        $product->description=$request->editDescription;
        $product->unit_price=$request->editPrice;
        $product->promotion_price=$request->editPromotion;
        $product->unit=$request->editUnit;
        $product->new=$request->editNew;
        $product->id_type=$request->editType;
        $product->save();
        return $this->getIndexAdmin();
    }										
    public function postAdminDelete($id){
        $product=products::find($id);
        $product->delete();
        return $this->getIndexAdmin();
    }
 				
    	// --------------- CART -----------																					
         public function getAddToCart(Request $req, $id)																					
        {																					
         if (Session::has('user')) {																					
         if (Product::find($id)) {																					
         $product = Product::find($id);																					
        $oldCart = Session('cart') ? Session::get('cart') : null;																					
       $cart = new Cart($oldCart);																					
         $cart->add($product, $id);																					
       $req->session()->put('cart', $cart);																					
        return redirect()->back();																					
        } else {																					
     return '<script>alert("Không tìm thấy sản phẩm này.");window.location.assign("/");</script>';																					
        }																					
        } else {																					
        return '<script>alert("Vui lòng đăng nhập để sử dụng chức năng này.");window.location.assign("/login");</script>';																					
        }																					
        }																					
                                                                                            
    

    
}
