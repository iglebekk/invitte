@extends('layouts.app')

@section('head')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

@endsection

@section('content')
<div class="justify-content-start d-flex mb-3">
    <a href="{{ route('event', $event) }}" class="btn btn-plain btn-lg text-light"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
        <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
    </svg> Tilbake</a>
</div>
@include('components.error')
@include('components.status')

<div class="row align-items-md-stretch">

    <div class="col-xl-6 mb-4">
        <div class="p-5 bg-light text-dark rounded-3 h-100">
            <h1>SMS</h1>
            <p>Dette er meldingen som blir sendt ut til alle. Lenke til selve invitasjonen blir autmatisk inkludert. Her kan du forandre avsender og innholde hvis du ønsker.</p>
            <h4>Navn på avsender</h4>
            <form class="form" action="{{ route('event.settings', $event) }}" method="POST">
                @csrf
                <input type="text" name="sms_sender_name" id="sms_sender_name" class="form-control" value="{{ $event->sms_sender_name }}" />

                <div class="justify-content-end d-flex">
                    <button type="submit" class="btn btn-primary mt-3">Lagre</button>

                </div>
            </form>
            <h4>Innhold i melding</h4>
            <form class="form" action="{{ route('event.settings', $event) }}" method="POST">
                @csrf
                <textarea name="sms_text" id="sms_text" class="form-control" cols="30" rows="5">{{ $event->sms_text }}</textarea>
                <div class="justify-content-end d-flex">
                    <button type="submit" class="btn btn-primary mt-3">Lagre</button>

                </div>
            </form>
        </div>
    </div>
    <div class="col-xl-6 mb-4">
        <div class="p-5 bg-light text-dark rounded-3 h-100">
            <h4>Forhåndsvisning</h1>
                <div class="p-4 bg-dark text-light rounded-3">
                    <h5>Fra: {{ $event->sms_sender_name }}</h5>
                    {{ $event->sms_text }}<br />
                    Følg lenken for å se invitasjonen: <a href="#">http:// {{ config('app.url') }}/invitasjon/s3h38fjk3</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row align-items-md-stretch">

        <div class="col-xl-6 mb-4">
            <div class="p-5 bg-light text-dark rounded-3 h-100">

                <h1>Tekst i invitasjonen</h1>
                <p>Dette er invitasjonen gjesten kommer til når h*n klikker på lenken. Her bør alt av nødvendig informasjon være med. Eksempelvis tid og sted.</p>
                <form class="form" action="{{ route('event.settings', $event) }}" method="POST">
                    @csrf
                    <textarea name="invitation_text" id="summernote" class="form-control textarea invitation_text" cols="30" rows="10" style="min-height: 30vh;">{{ $event->invitation_text }}</textarea>
                    <div class="justify-content-end d-flex">
                        <button type="submit" class="btn btn-primary mt-3">Lagre</button>

                    </div>
                </form>

            </div>
        </div>
        <div class="col-xl-6 mb-4">

            <div class="p-5 bg-light text-dark rounded-3 h-100">
                <h4>Forhåndsvisning</h4>
                <div class="p-4 bg-dark text-light rounded-3">
                    <h1 class="display-6">Hei Kari Nordmann</h1>
                    <div style="min-height: 10vh;">
                        {!! $event->invitation_text !!}
                    </div>
                    <div class="row p-2 border rounded-3 mx-5 mt-5">
                        <a href="#" class="btn btn-success mb-2">Jeg er med.</a>
                        <a href="#" class="btn btn-danger">Nei, det passer dessverre ikke.</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('bottom')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']],
                ['insert', ['picture', 'link']],
                ['misc', ['codeview']],
                ]
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>

    @endsection
