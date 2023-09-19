@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Verificação de Conta</h1>
        <form action="{{ url(route('verification.store')) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
            <!-- Form fields and submit button -->
            @include('verification._informations', ['name' => $name, 'email' => $email])

            @if($type == 'App\Models\Professor')
                @include('verification._professorForm')
            @endif

            @include('verification._password')

        </form>

    </div>
</div>

@endsection
