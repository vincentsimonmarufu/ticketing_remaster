<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index(){
        $user_id = Auth::id();
        $user_notifications = User::find($user_id);

        return view('notifications.index',compact('user_notifications'));
    }
}
