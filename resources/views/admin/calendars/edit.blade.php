@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Editar Data</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.calendars.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edição</li>
        </ol>
  </button>

        <form action="{{ url(route('admin.calendars.update', ['manager' => $item])) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <!-- Form fields and submit button -->
            @include('admin.calendars._form', ['item' => $item])

        </form>

    </div>
</div>

@endsection
