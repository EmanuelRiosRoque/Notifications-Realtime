<?php

namespace App\Notifications;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue; // Este apartado eh implementarolo nos ayuda a poner el cola los correo eso debemos ir al env quer conect

class MakeMessage extends Notification implements ShouldQueue
{
    use Queueable;
    public $message;
    /**
     * Create a new notification instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $sender = User::find($this->message->sender_id);
        // error es para mostrar un boton de error ->error()
        // lineIf es cuando quiere mostrar o no mostrar algo ->lineIf(false, "Mensaje de prueba")

        return (new MailMessage)
                    ->subject("Nuevo Mensaje")
                    ->from("no-replay@devEma", 'Developer')
                    ->markdown('mail.message-sent', [
                        'sender' => $sender,
                        'body' => $this->message->body

                    ]);
                    // ->greeting("Prueba de notificacion")
                    // ->line("{$sender->name} te ha enviado un mensaje.")
                    // ->line($this->data['body'])
                    // ->action("Ver Mensaje", url('/home'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDataBase(object $notifiable): array
    {
        $sender = User::find($this->message->sender_id);

        return[
            'url' => route('message.show', $this->message),
            'message' => "Haz recibido un nuevo mensaje de: " . $sender->name
        ];
    }
}
