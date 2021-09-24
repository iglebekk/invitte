@extends('layouts.app')

@section('head')
<style>
    svg {
        max-width: 32px;
        max-height: 32px;
    }
</style>
@endsection

@section('content')
@include('components.status')
<div class="justify-content-start d-flex mb-3">
    <a href="{{ route('dashboard') }}" class="btn btn-plain btn-lg text-light"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
        <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
    </svg> Tilbake</a>

</div>
<div class="row align-items-md-stretch">
    @include('components.error')
    <div class="col-xl-4 mb-4">
        <div class="p-5 bg-secondary rounded-3 h-100">
            <div class="display-5 mb-5">
                {{ $event->name }}
            </div>
            <div class="container border rounded-3 py-3">
                <div class="row my-2">
                    <div class="col-10">Gjester:</div>
                    <div class="col-2">{{ $event->guests()->count() }}</div>
                </div>
                <div class="row my-2">
                    <div class="col-10">Invitasjoner sendt ut:</div>
                    <div class="col-2">{{ $event->guests()->where('sms_invitation', 1)->count() }}</div>
                </div>
                <div class="row my-2">
                    <div class="col-10">Kommer:</div>
                    <div class="col-2">{{ $event->guests()->where('attending', 1)->count() }}</div>
                </div>
                <div class="row my-2">
                    <div class="col-10">Har sett, men ikke svart:</div>
                    <div class="col-2">{{ $event->guests()->where('attending', 0)->where('viewed', 1)->count() }}</div>
                </div>
            </div>
            <div class="py-5 d-grid gap-2">
                <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#newGuestModal">Legg til en gjest</button>
                <a href="" class="btn btn-light">Legg til flere gjester</a>
            </div>


        </div>
    </div>
    <div class="col-xl-8 mb-4">
        <div class="p-5 bg-light text-dark rounded-3 h-100">
            <div class="container">
                <form action="">
                <div class="row border-bottom mb-2">
                    {{-- <div class="col-1 mb-9">
                        #
                    </div> --}}
                    <div class="col-4 h5 mb-1">
                        Navn
                    </div>
                    <div class="col-4 h5 mb-1">
                        Telefon
                    </div>
                    <div class="col-2 h5 mb-1">
                        Status
                    </div>
                    <div class="col-1 h5 mb-1">
                        #
                    </div>
                </div>
                @forelse ($guests as $guest)
                <div class="row mb-1 align-items-center">
                    {{-- <div class="col-1">
                        <input type="checkbox" id="guest-{{ $guest->id }}" name="guest-{{ $guest->id }}" value="{{ $guest->id }}">
                    </div> --}}
                    <div class="col-4">
                        {{ $guest->name }}
                    </div>
                    <div class="col-4">
                        @php
                            $phone = $guest->phone;
                            echo (strlen($phone) == 8) ? $phone : '+' . substr($phone, 0, 2) . ' ' . substr($phone, 2, 8);
                        @endphp
                    </div>
                    <div class="col-2">
                        Venter
                    </div>
                    <div class="col-1">
                        <button class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                              </svg>
                        </button>
                    </div>
                </div>
                @empty
                Ingen gjester funnet.
                @endforelse

                <div class="d-flex justify-content-center mt-5">
                    {!! $guests->links() !!}
                </div>
            </form>
            </div>
        </div>

    </div>


    @endsection
    @section('bottom')
    <div class="modal fade text-dark" id="newGuestModal" tabindex="-1" aria-labelledby="newGuestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newGuestModal">Legg til en gjest</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guests', $event) }}" method="POST">
                    @csrf
                    <div class="modal-body ">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Navn" name="name" required value="{{ old('name') }}">
                            <label for="name">Navn <span class="text-muted small">Kari Nordmann</span></label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="phone" placeholder="40040400" name="phone" value="{{ old('phone') }}" required>
                            <label for="phone">Telefon <span class="text-muted small">40040400</span></label>
                            <span class="text-muted small">Hvis det er utenlandsnummer, legg til tosiftret landkode før telefonnummeret. Eks: <b>48</b>40040040</span>
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
