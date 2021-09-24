@extends('layouts.app')

@section('head')

@endsection

@section('content')
@include('components.status')
<div class="row align-items-md-stretch">

    <div class="col-xl-4 mb-4">
        <div class="h-100 p-5 bg-primary rounded-3 h2">
            <button type="button" data-bs-toggle="modal" data-bs-target="#newEvent" class="btn btn-plain">
                <h3 class="text-white">Legg til nytt arrangement</h3>
            </button>
        </div>
    </div>


    @forelse ($events as $event)
    <div class="col-xl-4 mb-4">
        <div class="h-100 p-5 text-dark bg-light rounded-3">
            <h2>{{ $event->name }}</h2>
            <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
            <p>Gjester: {{ $event->guests_count }}
            </p>
            <a class="btn btn-outline-dark" href="{{ route('event', $event->id) }}">Se arrangementet</a>
        </div>
    </div>
    @empty

    @endforelse

</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="newEvent" tabindex="-1" aria-labelledby="newEventLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="newEventLabel">Nytt arrangement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('events') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @include('components.error')
                    <div class="form-floating mb-3 text-dark">
                        <input type="text" class="form-control" id="name" placeholder="Navn" name="name" required>
                        <label for="name">Navn på arrangementet</label>
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
