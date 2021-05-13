@extends('layouts.mainBootstrap')
@section('title', 'Login')
@section('container')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 3em">
            <div style="width: 20em">
                <form method="post" action="{{route('login')}}">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-floating">
                        <label for="phone">Phone Number</label>
                        <input type="text" minlength="10" required name="phone" value="{{ old('phone') }}" class="form-control" id="floatingInput" placeholder="enter your phone number">
                    </div>
                    <div class="form-floating">
                        <label for="password">Password</label>
                        <input type="password" name="password" minlength="8" required class="form-control" id="floatingPassword" placeholder="password">
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit" style="margin-top: 1em">Sign in</button>
                </form>
            </div>
        </div>
    </div>

@endsection