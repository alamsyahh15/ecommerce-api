<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Role;
use App\Models\StatusOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function checkout(Request $request)
    {

        try {
            $validatedData =  $this->validate($request, [
                'address_id' => ['required', 'numeric'],
            ]);
            $order = Order::where('status_shipping', '!=', StatusOrder::COMPLETE)->first();
            $order->update([
                'status_shipping' => StatusOrder::PROGRESS,
                'status' => StatusOrder::PAID,
                'address_id' => $validatedData['address_id'],
            ]);
            return $this->respondWithSuccess([
                'message' =>  "Checkout Berhasil",
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }


    public function confirm(Request $request)
    {

        try {
            if (auth()->user()->role_id == Role::IS_MERCHANT) {
                $validatedData =  $this->validate($request, [
                    'checkout_id' => ['required', 'numeric'],
                ]);
                $order = Order::find($validatedData['checkout_id']);
                $order->update([
                    'status_shipping' => StatusOrder::COMPLETE,
                ]);
                return $this->respondWithSuccess([
                    'message' =>  "Pesanan telah dikonfirmasi",

                ]);
            } else {
                return $this->respondError("Unauthenticated");
            }
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }
}
