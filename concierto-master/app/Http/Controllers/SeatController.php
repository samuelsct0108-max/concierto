<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{

    public function downloadTicket($id){
        $pdf = PDF::loadView('frontend.pdf.ticket-alone',compact('id'));
        return $pdf->download('Ticket.pdf');
    }

    public function sendTicketToCustomer($id){
        $pdf = PDF::loadView('frontend.pdf.ticket-alone',compact('id'));
        $seat = DB::select('select * from seats where seat_number = ?', [$id]);
        $seat_sold = DB::select('select * from seat_sold where seat_number = ?',[$seat[0]->id]);
        $buyer = DB::select('select * from buyer where id = ?', [$seat_sold[0]->buyer_id]);
        Mail::raw('Download the pdf to print your tickets', function ($m) use ($buyer,$pdf) {
            $m->to($buyer[0]->buyer_email)
            ->subject('Dear '.$buyer[0]->buyer_name.' Your tickets are here!')
            ->attachData($pdf->output(), "Tickets.pdf");
        });
    }
}
