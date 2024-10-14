@extends('layouts.main_layouts')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5">

                    <!-- logo -->
                    <div class="text-center p-3">
                        <img src="assets/images/logo.png" alt="Notes logo">
                    </div>

                    {{-- show message success --}}
                    @if (session('success'))
                        <div class="alert alert-success text-center text-black">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- form -->
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">
                            <form action="{{ route('login_submit') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="text_username" class="form-label">Username</label>
                                    <input type="text" class="form-control bg-dark text-info" name="text_username">
                                    {{-- show message --}}
                                    @error('text_username')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="text_password" class="form-label">Password</label>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password">
                                    {{-- show message --}}
                                    @error('text_password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary w-100 mb-3">LOGIN</button>
                                </div>
                            </form>
                            <a href="{{ route('create_account') }}">Ainda não tem uma conta ?</a>
                        </div>
                    </div>
                    {{-- show login error --}}
                    @if (session('login_error'))
                        <div class="alert alert-danger text-center">
                            {{ session('login_error') }}
                        </div>
                    @endif

                    <!-- copy -->
                    <div class="text-center text-secondary mt-3">
                        <small>&copy; <?= date('Y') ?> Notes</small>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
