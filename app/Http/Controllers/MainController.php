<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Messages;


class MainController extends Controller
{
    //
    

    public function write2(Request $request)
    {        
        $json1 = $request->input('user');
        $json2 = $request->input('message');


        $mess_table = new Messages;
        $mess_table->user_name = $json1;
        $mess_table->message = $json2;
        $mess_table->save();

        return response()->json([
            'json1' => $json1,
            'json2' => $json2
         ]);
    }
}
