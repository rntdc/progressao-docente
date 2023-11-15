@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Editar Variáveis</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.enviroments.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Variáveis</li>
        </ol>
  </button>

        <form action="{{ url(route('admin.enviroments.update', ['enviroment' => $item])) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <!-- Form fields and submit button -->
            @include('admin.enviroments._form', ['item' => $item])

        </form>

    </div>
</div>

@endsection
