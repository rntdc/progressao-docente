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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Verificado</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calendars as $item)
                        <tr>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">{{ $item->email }}</td>
                            <td class="align-middle">
                                @if($item->is_active)
                                <span class="badge badge-success">Ativo</span>
                                @else
                                <span class="badge badge-danger">Desativado</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ url(route('admin.calendars.edit', $item)) }}" class="btn btn-outline-secondary" data-toggle="tooltip" title="Editar">
                                        <i class="bi bi-pen"></i> Editar
                                    </a>
                                    <a href="{{ route('admin.calendars.destroy', $item) }}" data-method="DELETE" class="btn btn-outline-danger" data-confirm-delete="true">
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
