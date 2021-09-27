@extends('layouts.auth')

@section('content')

@include('components.error')

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">E-postadresse</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Passord</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Logg inn</button>
  </form>
@endsection
