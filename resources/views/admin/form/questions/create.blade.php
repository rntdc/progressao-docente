@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Adicionar Questão</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.items.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Cadastro</li>
        </ol>
  </button>

        <form action="{{ route('admin.questions.store', ['item' => $item, 'question' => $question]) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <!-- Form fields and submit button -->
            @include('admin.form.questions._form', ['question' => $question])

        </form>

    </div>
</div>

@endsection
