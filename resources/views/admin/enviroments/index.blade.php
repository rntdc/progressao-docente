@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Variáveis</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.professors.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Variáveis</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                Variáveis de documentos de Progressão
            </div>
        </div>
  </button>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-sm-8">
                        <i class="fas fa-table me-1"></i>
                        Variáveis
                    </div>
                    <div class="col-sm-4 d-flex justify-content-sm-end justify-content-center mt-2 mt-sm-0">
                        <a href="{{ url(route('admin.enviroments.edit')) }}"><button class="btn btn-outline-secondary"><i class="bi bi-plus"></i> Editar Variáveis</button></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <h5>Nome do Reitor: <span>{{ $enviroment->reitor_name }}</span></h5>
                </div>

                <div class="row mt-3">
                    <h5>Presidente CPPD: <span>{{ $enviroment->cppd_president }}</span></h5>
                </div>

                <div class="row mt-3">
                    <h5>Secretário CPPD: <span>{{ $enviroment->cppd_secretary }}</span></h5>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
