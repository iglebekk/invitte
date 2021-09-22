@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-2 bg-light text-dark rounded">
            <div class="">
                <center>
                    <a href="{{ route('dashboard') }}" class="btn btn-plain bg-dark text-light p-1 m-3 rounded border d-block">Invitte</a>
                </center>
            </div>
            <ul>
                <li>
                    menu 1
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="bnt btn-link">Logout</a>
                </li>
            </ul>
        </div>
        <div class="col-xl-6 mx-5">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores odio sit quasi blanditiis, libero eos distinctio, harum iure a animi sed dolorum! Asperiores unde culpa sint nulla eius distinctio cumque.
        </div>
    </div>
</div>

@endsection
