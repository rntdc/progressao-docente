@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Calendário</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.calendars.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                Cadastros de calendário.
            </div>
        </div>
  </button>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-sm-8">
                        <i class="fas fa-table me-1"></i>
                        Datas
                    </div>
                    <div class="col-sm-4 d-flex justify-content-sm-end justify-content-center mt-2 mt-sm-0">
                        <a href="{{ url(route('admin.calendars.create')) }}"><button class="btn btn-outline-secondary"><i class="bi bi-plus"></i> Adicionar Data</button></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th>Semestre</th>
                            <th>Inicio</th>
                            <th>Fim</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calendars as $item)
                        <tr>
                            <td class="align-middle">{{ $item->semester }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</td>
                            <td class="align-middle">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ url(route('admin.calendars.edit', $item)) }}" class="btn btn-outline-secondary" data-toggle="tooltip" title="Editar">
                                        <i class="bi bi-pen"></i> Editar
                                    </a>
                                    <a
                                        data-url="{{ route('admin.calendars.destroy', $item) }}"
                                        data-message="Deseja deletar o Semestre {{ $item->semester }}?"
                                        data-item="{{ $item->id }}"
                                        class="js-delete btn btn-outline-danger"
                                    >
                                        <i class="bi bi-trash"></i> Deletar
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
