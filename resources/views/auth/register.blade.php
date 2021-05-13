@extends('layouts.mainBootstrap')
@section('title', 'Register')
@section('container')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 3em">
            <div style="width: 20em">
                <form method="post" action="{{route('register')}}">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

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
                        <label for="name">Name</label>
                        <input type="text" required name="name" class="form-control" id="floatingInput" placeholder="mahdi" value="{{ old('name') }}">
                    </div>
                    <div class="form-floating">name
                        <label for="email">Email</label>
                        <input type="email" required name="email" class="form-control" id="floatingInput" placeholder="info@test.com" value="{{ old('email') }}">
                    </div>
                    <div class="form-floating">
                        <label for="phone">Phone Number</label>
                        <input type="text" minlength="10" required name="phone" class="form-control" id="floatingInput" placeholder="09123456789" value="{{ old('phone') }}">
                    </div>
                    <div class="form-floating">
                        <label for="password">Password</label>
                        <input type="password" minlength="8" required name="password" class="form-control" id="floatingPassword" placeholder="password">
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit" style="margin-top: 1em">Sign up</button>
                </form>
            </div>
        </div>
    </div>

@endsection