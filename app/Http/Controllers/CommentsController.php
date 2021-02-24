<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function __construct(){
        return $this->middleware('auth')->except('store');
    }
    public function index(){
        $comments = Comment::latest()->get();
        return view('comments.index',compact('comments'));
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $comment = Comment::create([
            'name'              => strip_tags($request->input('name')),
            'email'             => $request->input('email'),
            'message'       => $request->input('message'),
        ]);
        $comment->save();

        return redirect('/')->with('comment','Your comment has been send successfully. ');
    }
}
