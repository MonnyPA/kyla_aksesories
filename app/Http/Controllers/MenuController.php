<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
        {
            $userId = auth()->id();

            Session::put('user_id', $userId);

            $products = Product::where('is_active', 1)
                ->orderBy('name', 'asc')
                ->get();

            return view('customer.menu', compact('products', 'userId'));
        }

    //Keranjang
    public function cart()
    {
        $cart = Session::get('cart');
        return view('customer.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());
        $productId = $request->input('id');
        $product = Product::find($productId);

        // dd($menu);

        if(!$product)
            {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Product tidak ditemukan'
                    ]);
            }

        $cart = Session::get('cart');

        // dd($cart);

        if(isset($cart[$productId]))
            {
                $cart[$productId]['qty'] += 1;
            } else
            {
                $cart[$productId] =
                [
                    'id' => $product->id,
                    'name' => $product->name,
                    'selling_price' => $product->selling_price,
                    'img' => $product->img,
                    'qty' => 1
                ];
            }

        Session::put('cart', $cart);

        return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Product ' . $product->name . ' Berhasil ditambahkan ke Keranjang',
                        'cart' => $cart
                    ]);
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('id');
        $newQty = $request->input('qty');

        if($newQty <= 0)
            {
                return response()->json([
                    'success' => false
                ]);
            }

        $cart = Session::get('cart');
        if(isset($cart[$productId]))
            {
                $cart[$productId]['qty'] = $newQty;
                Session::put('cart', $cart);
                Session::flash('success', 'Jumlah Item berhasil diperbaharui');

                return response()->json([
                    'success' => true
                ]);
            }
    }

    public function removeCart(Request $request)
    {
        $productId = $request->input('id');

        $cart = Session::get('cart');

        if(isset($cart[$productId]))
            {
                unset($cart[$productId]);
                Session::put('cart', $cart);
                Session::flash('success', 'Item Berhasil dikeluarkan dari keranjang atau dihapus');

                return response()->json([
                    'success' => true
                ]);
            }
    }

    public function clearCart()
    {
        Session::forget('cart');
        return redirect()->route('cart')->with('success', 'Keranjang Berhasil dikosongkan');
    }
}

