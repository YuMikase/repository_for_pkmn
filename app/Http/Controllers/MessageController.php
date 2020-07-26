<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function send(Request $request)
    {
        

        echo 'run';

        $pusher = new Pusher\Pusher("7b5150d331d136146d67", "c9cb8943619845c2f930", "1045036", array('cluster' => 'ap3'));
        $pusher->trigger('my-channel', 'my-event', array('message' => 'hello world'));


        $json1 = $request->input('bangou');
        //echo 'a: '.$json1;
        $json2 = $request->input('name');
        //echo 'b: '.$json2;
        
//         $data1 = ['code' => '001', 'name' => 'eigyou'];
//         return $data1;

        return response()->json([
            'code' => '1',
            'name' => 'eigyou'
         ]);
    }
}
