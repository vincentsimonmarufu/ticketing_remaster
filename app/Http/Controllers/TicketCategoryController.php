<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = TicketCategory::latest()->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:ticket_categories',  
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        TicketCategory::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name'],'-')
        ]);
        return back();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = TicketCategory::findOrFail($id);
        
        return view('categories.update',compact(['category']));
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:ticket_categories',  
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        
        $category = TicketCategory::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug,'-');
        $category->save();

        return redirect('categories');
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
        $category = TicketCategory::findOrFail($id);
        $category->delete();

        return redirect('categories');
    }
}
