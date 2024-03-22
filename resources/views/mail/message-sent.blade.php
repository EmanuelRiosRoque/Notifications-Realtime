<x-mail::message>
# Hola, {{$sender->name}} te ha enviado un mensaje

Mensaje:

<x-mail::panel>
{{$body}}
</x-mail::panel>

<x-mail::button :url="url('/home')">
Ver Mensaje
</x-mail::button>


Un Saludo,<br>
De todo el equipo de: PJCDMX TI
</x-mail::message>
