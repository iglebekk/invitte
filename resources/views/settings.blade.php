@extends('layouts.app')

@section('head')

@endsection

@section('content')
<div class="justify-content-start d-flex mb-3">
    <a href="{{ route('event', $event) }}" class="btn btn-plain btn-lg text-light"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
        <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
    </svg> Tilbake</a>
</div>
<div class="row align-items-md-stretch">
    @include('components.error')
    @include('components.status')
    <div class="col-xl-4 mb-4">
        <div class="p-5 bg-light text-dark rounded-3 h-100">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis soluta autem, consectetur vero explicabo nisi, animi quibusdam corrupti odit a corporis! Aspernatur nam unde quos architecto eum sunt sint enim!
        </div>
    </div>
</div>

@endsection

@section('bottom')

@endsection
