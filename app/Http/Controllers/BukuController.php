<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = buku::all()->sortBy('id');
        return view('layouts.buku', ['buku' => $buku]);
    }

    public function getBook(){
        $buku = buku::all();
        return json_encode($buku);
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
        $validator = Validator::make($request->all(),[
            "title" => 'required',
            "description" => "required"
        ]);

        if($validator->fails()){
            $data['validate'] = false;
            $data['error'] = $validator->errors();
        }else {
            $buku = new buku();
            $buku->title = $request->title;
            $buku->description = $request->description;
            if($buku->save()){
                return json_encode(buku::all()->sortBy('id'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "id" => 'required',
            "title" => 'required',
            "description" => "required"
        ]);

        if($validator->fails()){
            $data['validate'] = false;
            $data['error'] = $validator->errors();
        }else {
            $buku = buku::find($request->id);
            $buku->title = $request->title;
            $buku->description = $request->description;
            if($buku->save()){
                return json_encode(buku::all()->sortBy('id'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $buku = buku::find($request->id);
        if($buku->delete()){
            return json_encode(buku::all()->sortBy('id'));
        }
    }
}
