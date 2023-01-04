<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class BookController extends Controller
{
    public function getBooks()
    {
        $data = Book::select('id', 'title', 'description')->orderBy('id')->get();
        return Datatables::of($data)->addIndexColumn()
            ->make(true);
    }
    public function getBook()
    {
        $book = Book::all();
        return json_encode($book);
    }
    public function index()
    {
        $book = Book::all()->sortBy('id');
        return view('layouts.book', ['book' => $book]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => 'required',
            "description" => "required"
        ]);

        if ($validator->fails()) {
            $data['validate'] = false;
            $data['error'] = $validator->errors();
        } else {
            $book = new Book();
            $book->title = $request->title;
            $book->description = $request->description;
            if ($book->save()) {
                return json_encode(Book::all()->sortBy('id'));
            }
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => 'required',
            "title" => 'required',
            "description" => "required"
        ]);

        if ($validator->fails()) {
            $data['validate'] = false;
            $data['error'] = $validator->errors();
        } else {
            $book = Book::find($request->id);
            $book->title = $request->title;
            $book->description = $request->description;
            if ($book->save()) {
                return json_encode(Book::all()->sortBy('id'));
            }
        }
    }
    public function destroy(Request $request)
    {
        $book = Book::find($request->id);
        if ($book->delete()) {
            return json_encode(Book::all()->sortBy('id'));
        }
    }
}
