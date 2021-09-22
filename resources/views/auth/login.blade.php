@extends('layouts.app')

@section('content')

<!-- Show errors -->
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required value="anders@tolvtemann.no">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required value="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
