@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="div-centralizada row">
        <div class="form-index-div col-sm-12 col-md-6">
            <div class="m-3 title row">
                <h4>BEM VINDO A</h4>
                <h2>Progressão Docente</h2>
            </div>
            <div class="col-12 col-md-8">
                <form class="form-index-login" method="POST" action="{{ route('login') }}">
				@csrf

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input required name="email" type="email" class="form-control @if(Session::has('error')) is-invalid @endif" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                    </div>

                    <div class="form-group mt-3 mb-2">
                        <input required name="password" type="password" class="form-control @if(Session::has('error')) is-invalid @endif" id="formGroupExampleInput2" placeholder="Senha">
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary ">Entrar</button>
                    </div>

                    @if(Session::has('error'))
                    <div class="form-group mt-3">
                        <span class="mt-3 text-danger" style="font-size: 14px">{{ Session::get('error') }}</span>
                    </div>
                    @endif

                </form>
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

                <div class="card-body card-body-items-index">
                    <a href="" style="text-decoration: none; color: black;">
                        <div class="index-instructions m-4 row">
                            <div>
                                <h4><i class="bi bi-question-circle icon-system"></i> Acesso</h4>
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
@endsection
