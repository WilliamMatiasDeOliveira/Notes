@extends('layouts.main_layouts')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5">

                    <div class="text-center">
                        <h3 style='color:#436e99'>Create account</h3>
                    </div>

                    {{-- show create_error --}}
                    @if (session('create_error'))
                        <div class="alert alert-secondary text-center">
                            {{ session('create_error') }}
                        </div>
                    @endif

                    <!-- form -->
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">
                            <form action="{{ route('check_account') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="create_username" class="form-label">Username</label>
                                    <input type="text" class="form-control bg-dark text-info" name="create_username"
                                    value="{{old('create_username')}}">
                                    {{-- show message --}}
                                    @error('create_username')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="create_password" class="form-label">Password</label>
                                    <input type="password" class="form-control bg-dark text-info" name="create_password"
                                    value="{{old('create_password')}}">
                                    {{-- show message --}}
                                    @error('create_password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm password</label>
                                    <input type="password" class="form-control bg-dark text-info"name="confirm_password">
                                    {{-- show message --}}
                                    @error('confirm_password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-danger w-100">CREATE ACCOUNT</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- copy -->
                    <div class="text-center text-secondary mt-3">
                        <small>&copy; <?= date('Y') ?> Notes</small>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
