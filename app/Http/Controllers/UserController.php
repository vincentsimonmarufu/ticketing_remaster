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

            $tickets = Ticket::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

            return view('pages.admin.home', compact('tickets','categories'));
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
}
