<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product_type;		
use App\Models\products;				
use App\Models\Cart;
use  Illuminate\Support\Facades\Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         view()->composer('header', function ($view) {												
            $loai_sp = Product_type::all();												
            $view->with('loai_sp', $loai_sp);												
            });												
            view()->composer('page.product_type', function ($view) {												
            $product_new = products::where('new',1)->orderBy('id','DESC')->skip(1)->take(8)->get();												
            $view->with('product_new', $product_new);												
            });	
            
            

            view()->composer('header', function ($view) {										
              if (Session('cart')) {										
              $oldCart = Session::get('cart');										
           $cart = new cart($oldCart);										
           $view->with(['cart' => Session::get('cart'), 										
           'product_cart' => $cart->items, 										
         'totalPrice' => $cart->totalPrice, 										
                'totalQty' => $cart->totalQty										
             ]);										
               }										
       });										
                
            
    }
}
