<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false" v-pre>
        Notificaciones
        @if (auth()->user()->unreadNotifications->count() > 0)
        <span class="badge bg-danger">{{auth()->user()->unreadNotifications->count()}}</span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="max-height: 198px; overflow-y: auto;">
        @if ($this->notifications->count())
            @foreach ($this->notifications as $notification)
                <button class="{{ !$notification->read_at ? 'dropdown-item-1 border-bottom bg-gray-300' : 'dropdown-item-1 border-bottom' }}"
                        wire:click="readNotification('{{ $notification->id }}')">
                    <a class="dropdown-item-1" href="{{ $notification->data['url'] }}">
                        Haz recibido un nuevo mensaje de: {{ $notification->data['message'] }} <br>
                        <span class="fw-bold small">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                </button>
            @endforeach
        @else
            <a class="dropdown-item">No tienes notificaciones</a>
        @endif
    </div>


</li>
