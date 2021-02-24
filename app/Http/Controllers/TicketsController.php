<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Support\Facades\Validator;
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketOpenedNotification;
use App\Notifications\TicketResolvedNotification;
use App\Notifications\TicketResolverNotification;
use App\Notifications\AttendingNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Keygen;

class TicketsController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tickets = Ticket::latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'contactable' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $ticket = Ticket::create([
            'name'              => strip_tags($request->input('name')),
            'email'             => $request->input('email'),
            'contactable'       => $request->input('contactable'),
            'subject'           => $request->input('subject'),
            'description'       => $request->input('description'),
            'key'               => 'WTS'.Keygen::numeric(5)->generate()
        ]);
        $ticket->save();

        // try and catch
        if($ticket->save()){
            try{

                // notifying the user when a ticket is created
                $open = [
                    'greeting' => 'Good day '.$ticket->name,
                    'body' => 'Your issue has been submitted with reference no: '.$ticket->key.' , You will be notified once it is resolved',
                    'actionText' => 'Follow Up on Issue',
                    'actionUrl' => 'http://127.0.0.1:8000/ticket/follow',
                    'thanks' => 'Thank you for using Whelson Ticketing System'
                ];

                Notification::route('mail',$ticket->email)
                            ->notify(new TicketOpenedNotification($open));

                // notifying respective admins
                $users = User::all();
                
                foreach($users as $user){
                    if($user->isAdmin()){
                        $created = [
                            'greeting'=> 'Good day IT, '.$ticket->name.' has opened a ticket.',
                            'body'=>$ticket->name.' has opened ticket with reference no: '.$ticket->key,
                            'name'=>'Name: '.$ticket->name,
                            'email'=>'Email: '.$ticket->email,
                            'contact'=>'Contactable'.$ticket->contactable,
                            'subject'=>'Subject: '.$ticket->subject,
                            'description'=>'Description: '.$ticket->description,
                            'actionText'=>'View Details',
                            'actionUrl'=>'http://127.0.0.1:8000/tickets',
                            'thanks'=>'Thank you for using Whelson Ticketing System '

                        ];
                        $user->notify(new TicketCreatedNotification($created));
                    }
                }
                
            }catch(\Exception $except){
                echo 'Error - '.$except;
            }
        }

        if(Auth::check())
        {
            return redirect('tickets')->with('success','Your issue has been submitted and assigned a reference no: '.$ticket->key);
        }

        return redirect('/issue')->with('success','Your issue has been submitted and assigned a reference no: '.$ticket->key);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //showing the categories
        $categories = TicketCategory::all();
        $ticket = Ticket::findOrFail($id);

        if($ticket->resolved_status == 2){
            return back()->with('warning','The ticket has already been resolved');
        }
        elseif($ticket->resolved_status != 4){
            return back()->with('warning','Attend to issue first');
        }
        return view('tickets.resolve',compact('ticket','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $user = Auth::user();

        // check if the ticket is already resolved
        if($ticket->resolved_status === 2){
            return back()->with('message','The ticket has already been resolved !');
        }else{
            $validator = Validator::make($request->all(),[
                'category' => 'required',
                'resolved_how' => 'required'
            ]);

            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            if($ticket->resolved_status != 4){
                return back()->with('warning','You cannot resolve the issue .. First Attend to issue !!');
            }else{
                $ticket->resolved_how = $request->resolved_how;
                $ticket->resolved_by = $user->name;
                $ticket->category = $request->category;
                $ticket->resolved_status = 2;
                $ticket->user_id = $user->id;
                $ticket->save();

                // try catch for emails
                if($ticket->save()){
                    try{
                        // notifying the user when a ticket is resolved
                $resolved = [
                    'greeting' => 'Good day '.$ticket->name,
                    'subject' => 'Your issue has been resolved',
                    'body' => 'Your issue with reference no: '.$ticket->key.' has been resolved with the following comments',
                    'comment' =>'Comments: '.$ticket->resolved_how,
                    'actionText'=>'View Details',
                    'actionUrl' => 'http://127.0.0.1:8000/ticket/follow',
                    'thanks' => 'Thank you for using Whelson Ticketing System'
                ];

                Notification::route('mail',$ticket->email)
                                ->notify(new TicketResolvedNotification($resolved));

                // notifying respective admin when ticket is resolved
                $users = User::all();
                foreach($users as $user){
                    if($user->isAdmin()){
                        $resolver = [
                            'greeting' => 'Good day IT, ',
                            'body' => $ticket->resolved_by.' has attended to issue with reference no '.$ticket->key,
                            'explanation'=> 'Explanation: '.$ticket->resolved_how,
                            'actionText' => 'View Details',
                            'actionUrl' => 'http://127.0.0.1:8000/tickets',
                            'thanks' => 'Thank you for using Whelson Ticketing System'
                        ];

                        $user->notify(new TicketResolverNotification($resolver));
                    }
                }

                    }catch(\Exception $except){
                        echo 'Error - '.$except;
                    }
                }
            }
        }

        return redirect('tickets')->with('success','You have successfully resolved '.$ticket->key);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function acknowledge($id)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $ticket = Ticket::findOrFail($id);
        // check if ticket is resolved
        if($ticket->resolved_status === 2)
        {
            return back()->with('warning','Ticket has already been Resolved!');
        }
        elseif($ticket->resolved_status === 1)
        {
            return back()->with('warning','ticket has already been Acknowledged!');
        }
        elseif($ticket->resolved_status === 4){
            return back()->with('warning','You cannot acknowledge a ticket that is being resolved !');
        }
        else{
            $ticket->resolved_by = $user->name;
            $ticket->resolved_status = 1;
            $ticket->user_id = $user_id;
            $ticket->save();

            return back()->with('info','You have acknowledged a ticket successfully');
        }
    }

    public function followIssueForm(){
        return view('tickets.follow');
    }

    public function followIssue(Request $request){
        
        $ticket_key = $_POST['key'];
        $tickets = Ticket::where('key',$ticket_key)
            ->orWhere('email',$ticket_key)
            ->get();
        return view('tickets.follow',compact('tickets'));

    }

    public function escalate($id)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $ticket = Ticket::findOrFail($id);
        // check if ticket is resolved
        if($ticket->resolved_status === 2)
        {
            return back()->with('warning','Ticket has already been Resolved!');
        }elseif($ticket->resolved_status === 4){
            return back()->with('warning','Ticket is being resolved');
        }
        elseif($ticket->resolved_status === 3)
        {
            return back()->with('warning','Ticket has already been Escalated!');
        }
        elseif($ticket->resolved_status === 4){
            return back()->with('warning','The ticket session is in progress');
        }
        else{
            $ticket->resolved_by = $user->name;
            $ticket->resolved_status = 3;
            $ticket->user_id = $user_id;
            $ticket->save();

            return back()->with('success','You have escalated a ticket.');
        }
    }

    public function attend($id){
        $user_logged = Auth::user()->name;
        $user_id = Auth::id();
        $ticket = Ticket::findOrFail($id);
        $users = User::all();

        if($ticket->resolved_status === 2){
            return back()->with('warning','Ticket has already been Resolved!');
        }
        elseif($ticket->resolved_status === 3){

            if($user_id != $ticket->user_id){
                $ticket->resolved_by = $user_logged->name;
                $ticket->resolved_status = 4;
                $ticket->user_id = $user_id;
                $ticket->save();

                // try catch
                if($ticket->save()){
                    try{

                        foreach($users as $user){
                            if($user->isAdmin()){
                                $attending = [
                                    'greeting' => 'Good day IT, ',
                                    'body' => $ticket->resolved_by.' is attending to ticket no: '.$ticket->key,
                                    'thanks' => 'Thank you for using Whelson Ticketing system'
                                ];
        
                                $user->notify(new AttendingNotification($attending));
                            }
                        }

                    }catch(\Exception $except){
                        echo 'Error - '.$except;
                    }
                }

                return back()->with('success','Your ticket session is now in progress');

            }
            else{
                return back()->with('warning', 'You are unable to resolve the ticket !!');
            }
        }
        elseif($ticket->resolved_status === 4){

            return back()->with('warning','The ticket is being resolved ');
        }
        else{
            $ticket->resolved_by = $user_logged;
            $ticket->resolved_status = 4;
            $ticket->user_id = $user_id;
            $ticket->save();

            // try catch
            if($ticket->save()){
                try{

                    foreach($users as $user){
                        if($user->isAdmin()){
                            $attending = [
                                'greeting' => 'Good day IT, ',
                                'body' => $ticket->resolved_by.' is attending ticket no: '.$ticket->key,
                                'thanks' => 'Thank you for using Whelson Ticketing system'
                            ];
        
                            $user->notify(new AttendingNotification($attending));
                        }
                    }

                }catch(\Exception $except){
                    echo 'Error - '.$except;
                }
            }

            return back()->with('success','Ticket session is now in progress');
        }
    }
}
