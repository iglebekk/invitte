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
    </svg> Alle arrangementer</a>

</div>
<div class="row align-items-md-stretch">
    @include('components.error')
    <div class="col-xl-4 mb-4">
        <div class="p-5 bg-secondary rounded-3 h-100">
            <div class="display-5 mb-5">
                {{ $event->name }}
            </div>
            <div class="container border rounded-3 py-3 mb-5">
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
            <div class="py-3 d-grid gap-2">
                <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#newGuestModal">Legg til gjest</button>
                <button class="btn btn-light"  data-bs-toggle="modal" data-bs-target="#newGuestsModal">Legg til flere gjester</button>
            </div>
            <div class="p-3 d-grid gap-2 border rounded-3">
                <button class="btn btn-warning"
                @if ($event->guests()->where('sms_invitation', 0)->count() < 1)
                    disabled
                @endif
                data-bs-toggle="modal" data-bs-target="#confirmInvitation">Send SMS ({{ $event->guests()->where('sms_invitation', 0)->where('responded', 0)->count() }})</button>
                <button class="btn btn-danger"
                @if ($event->guests()->where('sms_invitation', 1)->where('sms_reminder', 0)->where('responded', 0)->count() < 1)
                disabled
                @endif
                data-bs-toggle="modal" data-bs-target="#confirmReminder">Send påminnelse ({{ $event->guests()->where('sms_invitation', 1)->where('sms_reminder', 0)->where('responded', 0)->count() }})</button>
            </div>
            <div class="py-3 d-grid gap-2">
                <a href="{{ route('accesses', $event) }}" class="btn btn-dark">Tilgangskontroll</a>
                <a href="{{ route('event.settings', $event) }}" class="btn btn-success">Innstillinger</a>

            </div>


        </div>
    </div>
    <div class="col-xl-8 mb-4">
        <div class="p-5 bg-light text-dark rounded-3 h-100">
            <div class="container">
                <form action="">
                    <div class="row border-bottom mb-2">

                        <div class="col-4 h5 mb-1">
                            Navn
                        </div>
                        <div class="col-3 h5 mb-1">
                            Telefon
                        </div>
                        <div class="col-3 h5 mb-1">
                            Status
                        </div>
                        <div class="col-1 h5 mb-1">

                        </div>
                    </div>
                    @forelse ($guests as $guest)
                    <div class="row mb-1 align-items-center">

                        <div class="col-4">
                            {{ $guest->name }}
                        </div>
                        <div class="col-3">
                            @php
                            $phone = $guest->phone;
                            echo (strlen($phone) == 12) ? substr($phone, 0, 4) . ' ' . substr($phone, 4, 12) : '00' . substr($phone, 0, 2) . ' ' . substr($phone, 2, 8);
                            @endphp
                        </div>
                        <div class="col-3">
                            @php
                            $status = "Venter.";
                            if ($guest->sms_invitation) $status = "SMS sendt.";
                            if ($guest->sms_reminder) $status = "Påminnelse sendt.";
                            if ($guest->viewed) $status = "Har sett invitasjonen.";
                            if ($guest->responded) $status = "Deltar ikke.";
                            if ($guest->attending) $status = "Deltar.";
                            echo $status;
                            @endphp

                        </div>
                        <div class="col-1">
                            <div class="dropdown">
                            <button class="btn btn-link btn-sm" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuButton1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('guest.remove', [$event, $guest]) }}">Fjern gjest</a></li>
                              </ul>
                            </div>
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
                    <h5 class="modal-title" id="newGuestModal">Legg til gjest</h5>
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
                            <span class="text-muted small">Hvis det er utenlandsk nummer, legg til firesiftret landkode før telefonnummeret. Eks: <b>0048</b>40040040</span>
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
    <div class="modal fade text-dark" id="newGuestsModal" tabindex="-1" aria-labelledby="newGuestsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newGuestsModal">Legg til en gjest</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guests.mass', $event) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <textarea type="text" class="form-control mb-2" id="data" name="data" required value="{{ old('data') }}" rows="20" cols="40" style="height: 20vh;"></textarea>
                            <p>Legg inn liste med navn og telefonnummer. Skill navn og telefonnummer med komma, og hver person med linjeskift.</p>
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
    <div class="modal fade text-dark" id="confirmInvitation" tabindex="-1" aria-labelledby="confirmInvitationLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmInvitationModal">Er du sikker?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    {{-- <div class="modal-body">
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lukk</button>
                        <a href="{{ route('sendInvitation', $event) }}" class="btn btn-primary">Send</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade text-dark" id="confirmReminder" tabindex="-1" aria-labelledby="confirmReminderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmReminderModal">Er du sikker?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    {{-- <div class="modal-body">
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lukk</button>
                        <a href="{{ route('sendReminder', $event) }}" class="btn btn-primary">Send</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
