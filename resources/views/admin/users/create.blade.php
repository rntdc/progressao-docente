@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Adicionar Professor</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Cadastro</li>
        </ol>
  </button>

        <form action="{{ route('admin.professors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <!-- Form fields and submit button -->
            @include('admin.users._form', ['item' => $item])

        </form>

    </div>
</div>

@endsection
