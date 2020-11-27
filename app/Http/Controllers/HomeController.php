<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$users = User::where('id', '!=', Auth::id())->get(); atau
        $users = User::whereNotIn('id', [Auth::id()])->get();
        // dd($users);
        return view('home', compact('users'));
    }

    public function getMessage($user_id)
    {
        //var_dump($user_id); 
         //return $user_id;
        
        $my_id = Auth::id();

        //dd($my_id);

        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })
        ->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })
        ->get();
         //dd($messages);

        return view('messages.index', compact('messages'));
        
    }

    public function sendMessage (Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; //ini tu
        $data->save(); 

        //pusher
        $options = array (
            'cluster' => 'ap2',
            'useTLS' => true 
          );

        $pusher = new Pusher (
          env('PUSHER_APP_KEY'),
          env('PUSHER_APP_SECRET'),
          env('PUSHER_APP_ID'),
          $options
        );

        $data = ['from' => $from, 'to' => $to]; //sending from and to user id when pressed enter
        $pusher->trigger('my-channel','my-event', $data);
        
    }


        
}

