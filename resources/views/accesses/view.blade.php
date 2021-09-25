@extends('layouts.app')

@section('head')

@endsection

@section('content')
<div class="justify-content-start d-flex mb-3">
    <a href="{{ route('event', $event->id) }}" class="btn btn-plain btn-lg text-light"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
        <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
    </svg> Tilbake</a>
</div>
<div class="row align-items-md-stretch justify-content-center">
    @include('components.error')
    @include('components.status')
    <div class="col-xl-6 mb-4">
        <div class="p-5 bg-light text-dark rounded-3 h-100">
            <div class="row border-bottom pb-2 h6">
                <div class="col-5">Navn</div>
                <div class="col-5">E-post</div>
                <div class="col-2"><center></center></div>
            </div>
            @forelse ($users as $user)
            <div class="row border-bottom pb-2 h6 align-items-center">
                <div class="col-5">{{ $user->name }}</div>
                <div class="col-5">{{ $user->email }}</div>
                <div class="col-2">
                    <center>
                        <button class="btn btn-link btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </center>
                </div>
            </div>
            @empty
            Ingen brukere har tilgang... -hvorfor er du her da?
            @endforelse
            <div class="row mt-5">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUser">
                    Legg til
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('bottom')
<!-- Modal -->
<div class="modal fade text-dark" id="newUser" tabindex="-1" aria-labelledby="newUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserLabel">Legg til ny tilgang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('accesses', $event->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" required>
                        <label for="email">E-postadresse</label>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lukk</button>
                    <button type="submit" class="btn btn-primary">Lagre</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
