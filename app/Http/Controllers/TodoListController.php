<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Todolist;

class TodoListController extends Controller
{
    public function index(){
        
        return view('todo');
    }

    public function get(){
        $todolists = Todolist::all();
        return response()->json($todolists);
    }

    public function store(Request $req){
        TodoList::create([
            'name' => $req->name
        ]);
        
        return response()->json([
            'message' => 'success'
        ]);
    }

    public function destroy(Request $req){
        foreach($req->checked as $value){
            TodoList::find($value)->delete();
        }
        return response()->json([
            'message' => 'success'
        ]);
    }
}
