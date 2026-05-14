<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
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
                    'cost_price' => $product->cost_price,
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
        $product = Product::find($productId);
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
                Session::flash('success', 'Jumlah Product ' . $product->name . ' berhasil diperbaharui');

                return response()->json([
                    'success' => true
                ]);
            }
    }

    public function removeCart(Request $request)
    {
        $productId = $request->input('id');
        $product = Product::find($productId);

        $cart = Session::get('cart');

        if(isset($cart[$productId]))
            {
                unset($cart[$productId]);
                Session::put('cart', $cart);
                Session::flash('success', 'Product ' . $product->name . ' Berhasil dikeluarkan dari keranjang atau dihapus');

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

    // Checkout
    public function checkout()
    {
        $cart = Session::get('cart');

        if(empty($cart))
            {
                return redirect()->route('cart')->with('error', 'Keranjang Masih Kosong');
            }

        $user = Auth::user();

        return view('customer.checkout', compact('cart','user'));
    }

    // Checkout
    public function storeOrder(Request $request)
    {
        $cart = Session::get('cart');
        // $user = Session::get('user');

        if(empty($cart))
            {
                return redirect()->route('cart')->with('error', 'Keranjang Masih Kosong');
            }

        $totalProfit = 0;
        $totalAmount = 0;
        foreach($cart as $product)
            {
                $totalAmount += $product['selling_price'] * $product['qty'];
                $totalProfit += ($product['selling_price']-$product['cost_price']) * $product['qty'];

                $productDetails[] = [
                    'id' => $product['id'],
                    'cost_price' => (int) $product['cost_price'],
                    'selling_price' => (int) $product['selling_price'],
                    'quantity' => $product['qty'],
                    'name' => substr($product['name'], 0, 50)
                ];
            }

        $user = Auth::user();

        $order = Order::create([
            'order_code' => 'ORD -'. time(),
            'user_id' => Auth()->id(),
            'total' => $totalAmount,
            'profit' => $totalProfit,
            'status_pembayaran' => 'pending',
            'payment_method' => $request->payment_method,
            'note' => $request->note
        ]);

        foreach($cart as $productId => $product)
            {
                $dbProduct = Product::find($product['id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['qty'],
                    'total_price' => $product['selling_price'] * $product['qty']
                ]);


                if($dbProduct)
                {
                    $dbProduct->stock -= $product['qty'];
                    $dbProduct->save();
                }

            }

        Session::forget('cart');

        return redirect()->route('product')->with('success', 'Transaksi Berhasil disimpan');

        // if($request->payment_method == 'tunai')
        //     {
        //         return redirect()->route('checkout.success', ['orderId' => $order->order_code])->with('success', 'Pesanan Berhasil dibuat');
        //     }
            // {
            //     \Midtrans\Config::$serverKey = config('midtrans.server_key');
            //     \Midtrans\Config::$isProduction = config('midtrans.is_production');
            //     \Midtrans\Config::$isSanitized = true;
            //     \Midtrans\Config::$is3ds = true;

            //     $parans =
            //         [
            //             'transaction_details' => [
            //                 'order_id' => $order->order_code,
            //                 'gross_amount' => (int) $order->grand_total
            //             ],
            //             'item_details' => $itemDetails,
            //             'customer_details' => [
            //                 'first_name' => $user->fullname ?? 'Guest',
            //                 'phone' => $user->phone
            //             ],
            //             'payment_type' => ['qris'],
            //         ];

            //         try
            //             {
            //                 $snapToken = \Midtrans\Snap::getSnapToken($parans);
            //                 return response()->json([
            //                     'success' => 'success',
            //                     'snap_token' => $snapToken,
            //                     'order_code' => $order->order_code
            //                 ]);

            //             } catch (\Exception $e)
            //             {
            //                 return response()->json([
            //                     'success' => 'error',
            //                     'message' => 'Gagal Memproses Pembayaran: ' . $e->getMessage() .  ' Silahkan Coba lagi'
            //                 ]);
            //             }
            // }
    }


}

