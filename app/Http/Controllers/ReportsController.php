<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class ReportsController extends Controller
{
    public function index(){
        $tickets = Ticket::select('resolved_status')->distinct()->get();

        return view('reports.index',compact('tickets'));
    }

    public function getReports(Request $request){
        
        $tickets = Ticket::select('resolved_status')->distinct()->get();
        $status = $request->status;
        $start = $request->start_date;
        $end = $request->end_date;

        $rep = Ticket::where('resolved_status',$status)
                        ->whereBetween('created_at',[$start,$end])
                        ->get();
        return view('reports.index',compact('rep','tickets'));
    }
}
