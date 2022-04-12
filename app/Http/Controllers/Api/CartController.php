<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\StatusOrder;
use Illuminate\Http\Request;

class CartController extends Controller
{


    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orderProducts = OrderProduct::all();
        $carts = [];
        foreach ($orderProducts as $item) {
            if ($item->order->status_shipping != StatusOrder::COMPLETE) {
                unset($item->order);
                array_push($carts, $item);
            }
        }

        return $this->respondWithSuccess([
            'message' =>  "Sucess",
            'carts' =>  $carts,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        try {
            $validatedData =  $this->validate($request, [
                'product_id' => ['required', 'numeric'],
                'qty' => ['required', 'numeric'],
            ]);

            // checking latest order
            $order = Order::where('status_shipping', '!=', StatusOrder::COMPLETE)->first();
            if (!isset($order)) {
                // Store data to order
                $order = Order::create([
                    'user_id' => auth()->user()->id,
                    'trx_code' => "TRX-" .  $this->generateRandomString(10)
                ]);
            }

            $existProduct = OrderProduct::where('trx_code_order', $order->trx_code)->where('product_id', $validatedData['product_id'])->first();
            $price = Product::find($validatedData['product_id'])->price;

            if (!isset($existProduct)) {
                // Store new
                OrderProduct::create([
                    'trx_code_order' =>  $order->trx_code,
                    'product_id' => $validatedData['product_id'],
                    'qty' => $validatedData['qty'],
                    'sub_total' => $validatedData['qty'] * $price
                ]);
            } else {
                // Update data
                $validatedData['trx_code_order'] = $order->trx_code;
                $validatedData['qty'] =  $existProduct->qty +  ($validatedData['qty'] ?? 1);
                $validatedData['sub_total'] = $validatedData['qty'] * $price;
                $existProduct->update($validatedData);
            }
            $order->order_products = $order->orderProducts;


            return $this->respondWithSuccess([
                'message' =>  "Sucess menambahkan",
                'carts' =>    $order->order_products,
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try {
            $validatedData =  $this->validate($request, [
                'cart_id' => ['required', 'numeric'],
                'qty' => ['required', 'numeric'],
            ]);


            $existProduct = OrderProduct::find($validatedData['cart_id']);
            $price = $existProduct->product->price;

            // Update data
            $qty =  ($existProduct->qty - $validatedData['qty']) < 1 ? 1 : ($existProduct->qty - $validatedData['qty']);
            $validatedData['qty'] =   $qty;
            $validatedData['sub_total'] =  $qty * $price;
            $existProduct->update($validatedData);
            unset($existProduct->product);

            return $this->respondWithSuccess([
                'message' =>  "Sucess update",
                'cart' =>   OrderProduct::all(),
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try {
            $validatedData =  $this->validate($request, [
                'cart_id' => ['required', 'numeric'],
            ]);

            OrderProduct::find($validatedData['cart_id'])->delete();

            return $this->respondWithSuccess([
                'message' =>  "Sucess menghapus item",
                'carts' => OrderProduct::all(),
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }
}
