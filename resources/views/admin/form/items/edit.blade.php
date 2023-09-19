@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Editar Item</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.items.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Cadastro</li>
        </ol>
  </button>

        <form action="{{ url(route('admin.items.update', ['item' => $item])) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <!-- Form fields and submit button -->
            @include('admin.form.items._formUpdate', ['item' => $item])

        </form>

    </div>
</div>

@endsection
