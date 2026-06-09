<?php

namespace App\Http\Controllers;

use App\Models\SeatSold;
use App\Models\Buyer;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class SeatSoldController extends Controller
{

    public function sellSeat(Request $request){
        $set_sold = new SeatSold();
        $buyer = new Buyer();
        $seat = Seat::find($request->seat_id);

        try {
            $buyer->buyer_email = $request->buyer_email;
            $buyer->buyer_name = $request->buyer_name;
            $buyer->buyer_phone = $request->buyer_phone;
            $buyer->buyer_address = $request->buyer_address;
            $buyer->save();
            $max_buyer = DB::select('select max(id) as id from buyer');

        } catch (\Throwable $th) {
            return response('Error in database with buyer table (sellSeat)',500);
        }

        try {
            $set_sold->buyer_id = $max_buyer[0]->id;
            $set_sold->seat_number = $request->seat_id;
            $set_sold->payment_method =  $request->payment_method;
            $set_sold->save();
        } catch (\Throwable $th) {
            return response('Error in database with buyer table (sellSeat)',500);
        }


        try {
            $seat->sold = '1';
            $seat->save();
        } catch (\Throwable $th) {
            return response($th,500);
        }



        $seat = DB::select('select * from seats where seat_number = ?', [$request->seat_id]);
        $this->sendTicketToCustomer($seat[0]->seat_number);
        return back()->with('success','Item successfully sold')->with('email',$request->buyer_name);
    }

    public function massiveSellSeat(Request $request){
        if (empty($request->massive_sale)) {
            return back()->with('error','Select at least one seat')->withInput();
        }
        $this->createBuyer($request);

        if($request->has('online')){
            $this->sellSeatsOnline($request);
        }else{
            $this->sellSeats($request);
        }


        $this->updateSeatsSoldsStatus($request);
        return back()->with('success','Item successfully sold')->with('email',$request->buyer_name);
    }


    function createBuyer($request){
        $buyer = new Buyer();
        try {
            $buyer->buyer_email = $request->buyer_email;
            $buyer->buyer_name = $request->buyer_name;
            $buyer->buyer_phone = $request->buyer_phone;
            $buyer->buyer_address = $request->buyer_address;
            $buyer->save();


        } catch (\Throwable $th) {
            return response('Error in database with buyer table (sellSeat)',500);
        }
    }

    function sellSeats($request){
        $max_buyer = DB::select('select max(id) as id from buyer');
        try {
            foreach ($request->massive_sale as $item) {
                $set_sold = new SeatSold();
                $set_sold->buyer_id = $max_buyer[0]->id;
                $set_sold->seat_number = $item;
                $set_sold->payment_method =  $request->payment_method;
                $set_sold->id_seller =  session('userId');
                $set_sold->save();
            }
        } catch (\Throwable $th) {
            return response('Error in database with seat sold table (sellSeat)'.$th,500);
        }
    }

    function sellSeatsOnline($request){
        $max_buyer = DB::select('select max(id) as id from buyer');
        try {
            foreach ($request->massive_sale as $item) {
                $set_sold = new SeatSold();
                $set_sold->buyer_id = $max_buyer[0]->id;
                $set_sold->seat_number = $item;
                $set_sold->payment_method =  $request->payment_method;
                $set_sold->save();
            }

            $this->sendMassiveSellSeat($request);

        } catch (\Throwable $th) {
            return response('Error in database with seat sold table (sellSeat)'.$th,500);
        }
    }

    function updateSeatsSoldsStatus($request){
        try {
            foreach ($request->massive_sale as $item) {
                $seat = Seat::find($item);
                $seat->sold = '1';
                $seat->save();
            }
        } catch (\Throwable $th) {
            return response($th,500);
        }
    }

    function sendMassiveSellSeat($request){
        $pdf = PDF::loadView('frontend.pdf.ticket',compact('request'));
        Mail::raw('Download the pdf to print your tickets', function ($m) use ($request,$pdf) {
            $m->to($request->buyer_email)
            ->subject('Dear '.$request->buyer_name.' Your tickets are here!')
            ->attachData($pdf->output(), "Tickets.pdf");
        });
    }
}
