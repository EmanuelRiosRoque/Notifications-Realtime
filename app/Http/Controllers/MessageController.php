<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Notifications\MakeMessage;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{



    public function create()
    {
        $users = User::where('id', "!=", auth()->id())->get();

        // dd($user);
        return view('message.create', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required',
            'body' => 'required',
            'recipient_id' => 'required|exists:users,id',
        ]);

        $data["sender_id"] = auth()->id();

        $message = Message::create($data);

        // Enviar correo electronico al usuario "Recipiente"
        $recipient = User::find($data["recipient_id"]);

        // Generar delay al enviar correo
        // $delay = now()->addSeconds(10);

        // Este para enviar correo a un usuario en especifico
        // $recipient->notify((new MakeMessage())->delay($delay));

        // Retado para ciertos canale
        // $recipient->notify((new MakeMessage())->delay([
        //     "mail" => $delay,
        //     "database" => $delay,
        //     "broadcast" => $delay,
        //     "sms" => $delay,
        // ]));

        $recipient->notify(new MakeMessage($message));

        //Facade
        // Este para enviar correo a un o mas usuarios
        // Notification::send($recipient, new MakeMessage($data));



        return redirect()->route('message.create')->with('success', 'Se ah enviado correctamente');
    }


    public function show($message)
    {
        return $message;
    }
}
