<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\Waiter;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class MainController extends Controller
{
    private function responseJson($status, $mes, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $mes,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function checkAvailability(Request $request)
    {

        $table = Table::find($request->table_id);

        if($table->reservations()->exists()){
        $res = $table->reservations()->whereBetween('from_time', [$request->from_time, $request->to_time])
        ->orWhereBetween('to_time', [$request->from_time, $request->to_time])
        ->exists();

        }else{
            return $this->responseJson('1','يمكنك حجز الطاولة في هذا اليوم');
        }

        if( $res ){

            return $this->responseJson('1','هذه الطاولة محجوزة في هذا التوقيت');


        }else{
            return $this->responseJson('1','يمكنك حجز الطاولة في هذا اليوم');

        }

    }

    public function reserveTable(Request $request)
    {
            //validation
        $validator = validator()->make($request->all(), [

            'table_id'             =>'required',
            'customer_id'          =>'required',
            'from_time'            =>'required',
            'to_time'              =>'required',

        ]);

        if($validator->fails())
        {
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $table = Table::find($request->table_id);


// dd($request->has('guests'));
        if($request->has('guests')){
            if($table->where('id', '=', $request->table_id)->where('capacity', '>=', $request->guests)->exists()){

                    if($table->reservations()->exists()){

                        $res = $table->reservations()->whereBetween('from_time', [$request->from_time, $request->to_time])
                        ->orWhereBetween('to_time', [$request->from_time, $request->to_time])
                        ->exists();

                    }else{

                        $data = Reservation::create($request->all());

                        return $this->responseJson('1','تمت العملية بنجاح', $data);

                    }

                    if( $res ){

                        return $this->responseJson('1','هذه الطاولة محجوزة في هذا التوقيت');

                    }else{

                        $data = Reservation::create($request->all());

                        return $this->responseJson('1','تمت العملية بنجاح', $data);
                    }
            }else{


                return $this->responseJson('1','هذه الطاولة لا تسع الضيوف');
            }

        }
        if($table->reservations()->exists()){
            $res = $table->reservations()->whereBetween('from_time', [$request->from_time, $request->to_time])
            ->orWhereBetween('to_time', [$request->from_time, $request->to_time])
            ->exists();

            }else{
                $data = Reservation::create($request->all());
                return $this->responseJson('1','تمت العملية بنجاح', $data);
            }

            if( $res ){

                return $this->responseJson('1','هذه الطاولة محجوزة في هذا التوقيت');

            }else{

                $data = Reservation::create($request->all());

                return $this->responseJson('1','تمت العملية بنجاح', $data);
            }



    }


    public function listAllItemsInMenu()
    {
        $meals = Meal::all();

        return $this->responseJson('1','success', $meals);


    }

    public function order(Request $request)
    {
        $validator = validator()->make($request->all(), [

            'reservation_id'       =>'required',
            'meal_id'              =>'required|array',
            'waiter_id'            =>'required',

        ]);

        if($validator->fails())
        {
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $res = Reservation::find($request->reservation_id);
        $res->customer->id;
        $res->table->id;
        $request->waiter_id;
        $meals = Meal::whereIn('id', $request->meal_id)->get();

        $total = $meals->map(function($record) {
            return ($record->price - ($record->price * $record->discount / 100)) ;
        })->sum();

        $order = Order::create([
            'customer_id' => $res->customer->id,
            'table_id' => $res->table->id,
            'waiter_id' => $request->waiter_id,
            'reservation_id' => $request->reservation_id,
            'total' =>$total,
            'paid' => $request->paid ? $request->paid : 'unpaid',
            'date' => now()
        ]);

        foreach($meals as $meal){
            $meal->quantity_available - 1 ;
            $order->details()->create([
                'meal_id' => $meal->id,
                'amount_to_pay' => ($meal->price - ($meal->price * $meal->discount / 100)),
             ]);
        }

        return $this->responseJson('1','success', $order->load('details'));


    }

    public function orderInvoice(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'order_id'       =>'required',
        ]);

        if($validator->fails())
        {
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $order = Order::findOrFail($request->order_id);
        $res = Reservation::find($order->reservation_id);
        $res->customer->name;
        $res->id;
        $res->table->id;
        $waiter = Waiter::find($order->waiter_id);
        $waiter->name;
        $order_d = $order->details()->get();

        $test = $order_d->map(function($record) {

            $r = Meal::where('id', $record->meal_id)->first();

            return [
                 'meal' => $r->description,
                 'price' => $r->price,
                 'discount' => $r->discount.'%'
             ];
        });



        return $this->responseJson('1','success',
         [
               'custoumer' => $res->customer->name,
               'waiter' => $waiter->name,
               'table' => $res->table->id,
               'reservation_number' => $res->id,
               'order_details' => $test,
               'total_payment' => $order->total,
         ]);


    }
}



















