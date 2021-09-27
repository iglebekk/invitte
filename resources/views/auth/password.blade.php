@extends('layouts.auth')

@section('content')

@include('components.error')

<form action="{{ route('password', $user->resetToken) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Navn</label>
        <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name" required value="{{ old('name') }}">
      </div>
    <div class="mb-3">
      <label for="email" class="form-label">E-postadresse</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{ $user->email }}" readonly>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required value="">
    </div>
    <button type="submit" class="btn btn-primary">Lagre</button>
  </form>
@endsection
