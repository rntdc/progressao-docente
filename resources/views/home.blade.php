@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid px-4">
        <div class="row justify-content-center mt-4">
            <h1>{{ $user->name }}</h1>

            <div class="col-md-9 mt-5">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body" style="text-align: center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($user->last_progression_date)
                            <p>Data da última progressão: {{ $user->last_progression_date }}</p>

                            <hr>
                            <!-- Caso tenha uma progressão em andamento -->
                            <p>Requerimento atual: código do Requerimento</p>
                            <p>Data de solicitação: data do Requerimento</p>
                            <p> Status do requerimento: em análise</p>

                        @endif

                        <!-- Caso última progressão já tenha passado de dois anos -->
                        @if ($user->last_progression_date)
                            <hr>

                            <h4 class="btn-primary">Você está apto para progredir!</h4>
                            <a href="/formulario" type="button" class="btn btn-primary">Solicitar a progressão</a>
                        @endif

                    </div>
                </div>
            </div>

            <div class="number-two col-sm-12 col-md-6 row">
                <div class="col-12">
                    <div class="card-body card-body-items-index">
                        <a href="" style="text-decoration: none; color: black;">
                            <div class="index-instructions m-4 row">
                                <div>
                                    <h4><i class="bi bi-book icon-system"></i> Sistema</h4>
                                </div>
                                <div class="col-12 ">
                                    <p>Uma maneira de simplificação do fluxo para fornecer suporte aos docentes do IFRS durante o processo de solicitação de progressão, com o intuito de minimizar erros de preenchimento e agilizar a avaliação de desempenho.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
