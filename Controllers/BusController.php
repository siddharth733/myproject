<?php

namespace App\Http\Controllers;

use App\Models\bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function view(){
        $bus = bus::all();
        $data = compact('bus');
        return view('home')->with($data);
    }
    public function store($request){
        $Bus =  new bus();
        $Bus->name = $request['name'];
        $Bus->save();
        return redirect('/home');
    }
}
