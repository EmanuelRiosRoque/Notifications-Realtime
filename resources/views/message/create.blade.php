@extends('layouts.app')


@section('content')
<div class="container">
    <div class="navbar-brand">
        <div class="">
            <div class="card">
                <h1 class="card-header">{{ __('Mensajes') }}</h1>

                <div class="card-body p-5">

                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="titleMessage" class="form-label">Asunto</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror"  name="subject" value="{{old('subject')}}">
                            @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="contentBody">Mensaje</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" id="contentBody" rows="3" name="body">{{old('body')}}</textarea>
                            @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="destinatario" >Example select</label>
                            <select class="form-control @error('recipient_id') is-invalid @enderror" id="destinatario" name="recipient_id">
                                <option value="" selected>--Seleccione--</option>
                                @foreach ($users as $user)
                                    <option @selected(old("recipient_id") == $user->id) value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @error('recipient_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-5 ms-auto d-block">Enviar Mensaje</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
