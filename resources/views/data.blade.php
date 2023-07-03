@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Horas de Aula') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Semestre</th>
                            <th>Horas de Aula</th>
                        </tr>
                        @foreach($sumHours as $semester => $totalHours)
                            <tr>
                                <td>{{ $semester }}</td>
                                <td class="align-middle">{{ $totalHours }} horas</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
