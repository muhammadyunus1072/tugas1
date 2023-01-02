<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\kelompok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = buku::all()->sortBy('id');
        return view('layouts.kelompok', ['buku' => $buku]);
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
            "description" => "required",
            "paritra" => "required"
        ]);

        if($validator->fails()){
            $data['validate'] = false;
            $data['error'] = $validator->errors();
        }else {
            $data['validate'] = true;
            $kelompok = new kelompok();
            $kelompok->title = $request->title;
            $kelompok->description = $request->description;
            $kelompok->paritra = $request->paritra;
            if($kelompok->save()){
                $data['sattus'] = "Success";
                return json_encode($data);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function show(kelompok $kelompok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function edit(kelompok $kelompok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kelompok $kelompok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function destroy(kelompok $kelompok)
    {
        //
    }
}
