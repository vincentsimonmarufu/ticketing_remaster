<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('visitor.index');
    }

    public function issue(){
        return view('visitor.create');
    }

    public function follow(){
        return view('visitor.follow');
    }

    public function followIssue(Request $request){

        $ticket_key = $_POST['key'];
        
        $tickets = Ticket::where('key',$ticket_key)
            ->orWhere('email',$ticket_key)
            ->get();
            
        return view('visitor.follow',compact('tickets'));

    }
}
