@extends('layouts.invitation')

@section('head')

@endsection

@section('content')

<h1 class="display-6">Hei {{ $guest->name }}</h1>
<div>
{!! $event->invitation_text !!}
</div>
<div class="row p-2 border rounded-3 mx-5 mt-5">
    <a href="{{ route('invitation.accept', $guest->invitation_token) }}" class="btn btn-success mb-2">Jeg er med.</a>
    <a href="{{ route('invitation.decline', $guest->invitation_token) }}" class="btn btn-danger">Nei, det passer dessverre ikke.</a>
</div>

@endsection
