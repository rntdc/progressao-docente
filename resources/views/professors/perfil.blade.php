@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dados</h1>
            <div class="row justify-content-center mt-3">
                <div class="col-md-9">
                    <div class="card mt-5">
                        <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Perfil') }}
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary" data-toggle="tooltip" title="Editar">
                            <i class="bi bi-pen"></i> Editar
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-row align-items-center">
                            <div>
                                <h4 class="card-title">{{ $data->name }}</h4>
                                <p class="card-text">Email: {{ $data->email }}</p>
                                <p class="card-text">Classe: {{ $data->class }} - Nivel: {{ $data->level }}</p>
                                <p class="card-text">Siape: {{ $data->siape }}</p>
                                <p class="card-text">Data de Ingresso: {{ $data->entry_date }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-lg-9">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-8">
                                <i class="fas fa-table me-1"></i>
                                Solicitações
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="myTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Verificado</th>
                                    <th width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">Teste</td>
                                    <td class="align-middle">Teste</td>
                                    <td class="align-middle">
                                        <span class="badge rounded-pill text-bg-primary">Verificado</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="" class="btn btn-outline-secondary" data-toggle="tooltip" title="Editar">
                                                <i class="bi bi-envelope-open"></i> Ver
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
