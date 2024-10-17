@extends('layouts.main_layouts')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">

            {{-- top bar --}}
         @include('layouts.top_bar')

         @if ($notes == NULL)
            <!-- no notes available -->
            <div class="row mt-5">
                <div class="col text-center">
                    <p class="display-6 mb-5 text-secondary opacity-50">You have no notes available!</p>
                    {{-- new notes --}}
                    <a href="{{ route('new_note') }}" class="btn btn-secondary btn-lg p-3 px-5">
                        <i class="fa-regular fa-pen-to-square me-3"></i>Create Your First Note
                    </a>
                </div>
            </div>
         @endif

            <!-- notes are available -->

            {{-- botão new note --}}
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('new_note') }}" class="btn btn-secondary px-3">
                        <i class="fa-regular fa-pen-to-square me-2"></i>New Note
                    </a>
                </div>

            @foreach ($notes as $note)
                <div class="row">
                    <div class="col">
                        <div class="card p-4">
                            <div class="row">
                                <div class="col">
                                    <h4 class="text-info"> {{ $note['title'] }} </h4>
                                    <small class="text-secondary"><span class="opacity-75 me-2">Created at:</span><strong> {{ date('d-m-Y H:i:s', strtotime($note['created_at'])) }} </strong></small>
                                </div>
                                <div class="col text-end">
                                    <a href="edit/{{Crypt::encrypt($note['id'])}}" class="btn btn-outline-secondary btn-sm mx-1"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="delete/{{Crypt::encrypt($note['id'])}}" class="btn btn-outline-danger btn-sm mx-1"><i class="fa-regular fa-trash-can"></i></a>
                                </div>
                            </div>
                            <hr>
                            <p class="text-secondary"> {{ $note['text'] }} </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
