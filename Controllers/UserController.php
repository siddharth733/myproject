<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\busstudent;

class UserController extends Controller
{
    
    function show()
    {
        $data= DB::select('select * from busstudent');
        // paginate(1);
        return view('home',['members'=>$data]);
    }
    public function view(){
        $tb_data = DB::select('select * from busattendance');
        return view('table',['tb_members'=>$tb_data]);
    }
    function register(Request $request)
    {
        $id=$request->id;
        $name=$request->name;
        $checkbox=$request->checkbox;
            for($i=0;$i<count($id);$i++)
            {
                $datasave = [
                    'name'=>$name[$i],
                    'meta_value'=>$checkbox[$i]
                ];
                // return dd($datasave);   
                if($checkbox[$i]!=0)
                {
                    DB::table('busattendance')->insert($datasave);
                }
            }
        return redirect()->back();
            
    }
}
