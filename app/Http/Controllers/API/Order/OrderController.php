<?php

namespace App\Http\Controllers\API\Order;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        DB::beginTransaction();

        try {
            $data = Order::select(
                'orders.id', 'orders.customer_id', 'customer.name as customer_name', 'customer.address as customer_address',
                'orders.tarif', 'orders.power', 'orders.class', 'orders.substation', 'orders.bill', 'orders.billing_status', 'orders.status'
            )
                ->join('customers AS customer', 'orders.customer_id', 'customer.id')
                ->where('orders.user_id', $user->id)
                ->where('orders.status', 'Open')
                ->whereMonth('orders.created_at', date('m'))
                ->get();

            Order::where('user_id', $user->id)
                ->where('status', 'Open')
                ->whereMonth('created_at', date('m'))
                ->update([
                    'status' => 'On Progress',
                ]);

            DB::commit();
        } catch (\Throwable$th) {
            DB::rollBack();
            throw $th;
        }

        return Helper::ResponseWriter('Successfully get orders', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'billing_status' => 'required|in:Paid,Debt,Unpaid',
            'due_date' => 'required_if:billing_status,Debt',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        try {
            $photos = "";

            if ($request->hasFile('photo_1')) {
                $photo_1 = $request->file('photo_1');

                if (is_array($photo_1) || is_object($photo_1)) {
                    $extension = $photo_1->getClientOriginalExtension();
                    $filename = Str::random(40) . '.' . $extension;

                    $img = Image::make($photo_1->getRealPath());
                    $img->save(public_path('images/upload/' . $filename));
                    $img->resize(255, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $photos .= $filename;
                }
            }

            if ($request->hasFile('photo_2')) {
                $photo_2 = $request->file('photo_2');

                if (is_array($photo_2) || is_object($photo_2)) {
                    $extension = $photo_2->getClientOriginalExtension();
                    $filename = Str::random(40) . '.' . $extension;

                    $img = Image::make($photo_2->getRealPath());
                    $img->save(public_path('images/upload/' . $filename));
                    $img->resize(255, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $photos .= ",$filename";
                }
            }

            Order::find($request->order_id)
                ->update([
                    'status' => 'Done',
                    'photos' => $photos,
                    'due_date' => $request->due_date,
                    'phone_number' => $request->phone_number,
                    'billing_status' => $request->billing_status,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'updated_by' => Auth::user()->id,
                ]);

            $data = [
                'order_id' => $request->order_id,
            ];

            return Helper::ResponseWriter("Successfully upload order", $data, 201);
        } catch (\Throwable$th) {
            throw $th;
        }
    }
}
