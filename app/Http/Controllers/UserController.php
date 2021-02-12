<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\TicketCategory;

use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $categories = TicketCategory::all();

        if ($user->isAdmin()) {

            $tickets_total = Ticket::all();
            $tickets_total_count = $tickets_total->count();

            $unattended_count = Ticket::where('resolved_status',0)->count();
            if($tickets_total_count != 0)
            {
                $unattended_percent = number_format(($unattended_count / $tickets_total_count ) * 100,2,'.','');
            }
            else{
                $unattended_percent = 0;
            }
            
            $pending_count = Ticket::where('resolved_status',1)->count();
            if($tickets_total_count != 0)
            {
                $pending_percent = number_format(($pending_count / $tickets_total_count ) * 100,2,'.','');
            }
            else{
                $pending_percent = 0;
            }
            

            $resolved_count = Ticket::where('resolved_status',2)->count();
            if($tickets_total_count != 0)
            {
                $resolved_percent = number_format(($resolved_count / $tickets_total_count ) * 100,2,'.','');
            }
            else{
                $resolved_percent = 0;
            }

            $escalated_count = Ticket::where('resolved_status',3)->count();
            if($tickets_total_count != 0)
            {
                $escalated_percent = number_format(($escalated_count / $tickets_total_count ) * 100,2,'.','');
            }
            else{
                $escalated_percent = 0;
            }

            $tickets = Ticket::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

            return view('pages.admin.home', compact(
                'tickets',
                'categories',
                'tickets_total_count',
                'unattended_count','unattended_percent',
                'pending_count','pending_percent',
                'resolved_count','resolved_percent',
                'escalated_count','escalated_percent'
            ));
        }

        return view('pages.user.home');
    }

    public function getCategory($id,$name){
        $category_id = $id;
        $category_name = $name;

        $tickets_by = Ticket::where('category',$category_id)
                    ->latest()
                    ->get();

        return view('categories.tickets.index',compact('category_name','tickets_by'));
    }

    public function getTicketStatus($id,$name){
        $ticket_status = $id;
        $ticket_status_name = $name;

        $tickets = Ticket::where('resolved_status',$ticket_status)->latest()->get();

        return view('tickets.ticket_by_status', compact('ticket_status','ticket_status_name','tickets'));
    }
}
