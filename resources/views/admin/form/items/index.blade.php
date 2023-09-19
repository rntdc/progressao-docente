@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Itens</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.items.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                Cadastros dos índices das solicitações.
            </div>
        </div>
        <div class="card mb-4 ">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-sm-8">
                        <i class="fas fa-table me-1"></i>
                        Itens
                    </div>
                    <div class="col-sm-4 d-flex justify-content-sm-end justify-content-center mt-2 mt-sm-0">
                        <a href="{{ url(route('admin.items.create')) }}"><button class="btn btn-outline-secondary"><i class="bi bi-plus"></i> Adicionar Item</button></a>
                    </div>
                </div>
            </div>

            <div class="card-body card-body-items-index">
                @foreach($items as $item)
                    <a href="{{ route('admin.items.show', $item) }}" style="text-decoration: none; color: black;">
                        <div class="teste m-4 row">
                            <div class="col-10 d-flex align-items-center">
                                <h4>{{ $item->name }}</h4>
                            </div>
                            <div class="col-2 d-flex align-items-center">
                                <i class="bi bi-arrow-bar-right"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
