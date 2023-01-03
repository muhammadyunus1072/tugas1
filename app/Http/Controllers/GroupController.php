<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Group;
use App\Models\Group_Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;

class GroupController extends Controller
{
    public function editGroup(Request $request){
        // return $request->all();
        $validator = Validator::make($request->all(),[
            "id" => 'required',
            "title" => 'required',
            "description" => "required",
            "paritra" => "required",
        ]);

        if($validator->fails()){
            $data['validate'] = false;
            $data['error'] = $validator->errors();
        }else {
            $data['validate'] = true;
            $group = Group::find($request->id);
            $group->title = $request->title;
            $group->description = $request->description;
            if($group->save()){
                // return "oke";
                if(DB::table('group__books')->where('group_id', '=', $request->id)->delete()){
                    return "ok";
                }
                for($a = 0; $a < count($request->paritra); $a ++){
                    $Group_Book = new Group_Books();
                    $Group_Book->group_id = $group->id;
                    $Group_Book->book_id = $request->paritra[$a];
                    if($Group_Book->save()){
                        $data['status'] = "Success";
                    }
                }
                
            }
        }
        return json_encode($data);
    }
    public function coba(){
        $groups = Group_Books::with('GroupBook')->get();
        return json_encode($groups);
    }
    public function getGroupBook(Request $request){
        // $groups = Group_Books::where('group_id', '=', $request->id)->with('GroupBook','Group')->groupBy('group_id')->get();
        $data['group'] = DB::table('group__books')
        ->join('groups', 'group__books.group_id', '=', 'groups.id')
        ->join('books', 'group__books.book_id', '=', 'books.id')
        ->select('books.*', 'groups.*')
        ->where('group_id', '=', $request->id)
        ->get();
        $data['book'] = DB::table('group__books')
        ->join('groups', 'group__books.group_id', '=', 'groups.id')
        ->join('books', 'group__books.book_id', '=', 'books.id')
        ->select('group__books.*', 'books.*')
        ->where('group_id', '=', $request->id)
        ->get();
        return json_encode($data);
    }
    public function getGroups(Request $request){
        $data = Group::all();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = ' 
                <button type="button" class="btn btn-warning btnShowModalEdit" data-id="'.$row->id.'">edit</button>
           ';
                return $btn;
        // $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">'.$row->title.'</a>';
        //             return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function viewGroup(){
        $groups = Group_Books::with('GroupBook');
        return view('layouts.editGroup', ['groups' => $groups]);
    }
    
    public function index()
    {
        $book = Book::all()->sortBy('id');
        return view('layouts.group', ['book' => $book]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "title" => 'required',
            "description" => "required",
        ]);

        if($validator->fails()){
            $data['validate'] = false;
            $data['error'] = $validator->errors();
        }else {
            $data['validate'] = true;
            $group = new group();
            $group->title = $request->title;
            $group->description = $request->description;
            if($group->save()){
                for($a = 0; $a < count($request->paritra); $a ++){
                    $Group_Book = new Group_Books();
                    $Group_Book->group_id = $group->id;
                    $Group_Book->book_id = $request->paritra[$a];
                    if($Group_Book->save()){
                        $data['status'] = "Success";
                    }
                }
            }
        }
        return json_encode($data);
    }
}
