@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-5">

        <form action="" method="post" id="myForm">
        @csrf
            <!-- first step -->
            <div class="step" data-step="4">
                <h4 class="card-header">
                Formulário do Servidor
                </h4>

                <div class="card-body">
                    <div class="fields-body container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group row mt-3 align-items-center">
                                    <label for="situation" class="col-sm-4 col-form-label">Situação Atual</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="situation" name="situation" placeholder="Situação Atual">
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="titulation" class="col-sm-4 col-form-label">Maior Titulação</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="titulation" name="titulation">
                                            <option value="" disabled selected>Selecione um valor</option>
                                            <option value="especialista">Especialista</option>
                                            <option value="mestre">Mestre</option>
                                            <option value="doutor">Doutor</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="rsc" class="col-sm-4 col-form-label">RSC</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="rsc" name="rsc">
                                            <option value="" disabled selected>Selecione um valor</option>
                                            <option value="no">SEM RSC</option>
                                            <option value="rsci">RSC I</option>
                                            <option value="rscii">RSC III</option>
                                            <option value="rsciii">RSC III</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="doc-body">
                        <div class="doc-title">
                            <h4>Processo de Solicitação de Progressão e Promoção Funcional Docente</h4>
                        </div>

                        <div class="doc-info-item">
                            <span>SIAPE: </span> <span class="response" id="siape"> {{ $user->siape }} </span>
                        </div>

                        <div class="doc-info-item">
                            <span>Nome do Docente: </span><span class="response" id="name"> {{ $user->name }} </span>
                        </div>

                        <div class="doc-info-item">
                            <span>Situação Atual: </span><span class="response" id="situation"> </span>
                        </div>

                        <div class="doc-info-item">
                            <span>Data da última progressão ou do início do Efetivo Exercício (para Primeira Progressão): </span><span class="response" id="last-progression-date"> </span>
                        </div>

                        <div class="doc-info-item">
                            <span>Maior Titulação (Antes da Solicitação): &nbsp; </span>
                            <div id="titulation">
                                <span id="especialista">[&nbsp;&nbsp;] Especialista</span> <span id="mestre">&nbsp; [&nbsp;&nbsp;] Mestre</span> &nbsp; <span id="doutor">[&nbsp;&nbsp;] Doutor</span>
                            </div>
                        </div>

                        <div class="doc-info-item">
                            <span>RSC: &nbsp; </span>
                            <div id="rsc">
                                <span id="no">[&nbsp;&nbsp;] Sem RSC &nbsp;</span>
                                <span id="rsci"> [&nbsp;&nbsp;] RSC I &nbsp;</span>
                                <span id="rscii">[&nbsp;&nbsp;] RSC II &nbsp;</span>
                                <span id="rsciii">[&nbsp;&nbsp;] RSC III</span>
                            </div>
                        </div>

                        <div class="doc-info-item">
                            <span>Tipo de Solicitação: &nbsp; </span>
                            <div>
                                <span>( X ) Progressão por Desempenho &nbsp;</span>
                                <span>(&nbsp;&nbsp;) Retribuição por Titulação</span></span>
                            </div>
                        </div>

                        <div class="doc-info-item">
                            <span>(&nbsp;&nbsp;) Aceleração da Promoção &nbsp; </span>
                            <span> Data do Diploma ou Equivalente: </span> <span class="response">____/____/____ </span>
                        </div>

                        <div class="doc-info-item">
                            <span>Data do Início da Estabilidade (Um dia após do Encerramento do Estágio Probatório): </span><span class="response">____/____/____ </span>
                        </div>

                        <div class="doc-info-item mt-5">
                            <span>Declaro, que no interstício ao que se refere a presente solicitação, tenho desempenhado minhas atividades docentes com a qualidade, assiduidade e responsabilidade inerentes ao cargo de acordo com a Portaria nº 554, de 20 de junho de 2013, republicada em 30 de julho de 2013.</span>
                        </div>

                        <div class="doc-info-signature mt-3">
                            <span class="signature" id="signature-result">_____________________________________________</span>
                            <span>Assinatura do servidor</span>
                        </div>
                    </div>


                </div>
            </div>

            <!-- second step -->
            <div class="step" data-step="2">
                <h4 class="card-header">
                Documento 3
                </h4>

                <div class="card-body">
                    <div class="fields-body container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group row mt-3 align-items-center">
                                    <label for="reitor_name" class="col-sm-3 col-form-label">Nome do Reitor</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="reitor_name" name="reitor_name" placeholder="Situação Atual">
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="campus_name" class="col-sm-3 col-form-label">Nome do Campus</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="campus_name" name="campus_name" placeholder="Campus">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="current_level" class="col-sm-2 col-form-label">Nivel atual</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="current_level" name="current_level" placeholder="Nivel">
                                    </div>

                                    <label for="current_class" class="col-sm-2 col-form-label">Classe Atual</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="current_class" name="current_class" placeholder="Classe">
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="next_level" class="col-sm-2 col-form-label">Próximo Nivel</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="next_level" name="next_level" placeholder="Nivel">
                                    </div>

                                    <label for="next_class" class="col-sm-2 col-form-label">Próxima Classe</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="next_class" name="next_class" placeholder="Classe">
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="efetivity_date" class="col-sm-4 col-form-label">Data da Efetividade da Progressão</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="efetivity_date" name="efetivity_date">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="city_name" class="col-sm-3 col-form-label">Nome da Cidade</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="city_name" name="city_name" placeholder="Cidade">
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="day" name="day" placeholder="Dia">
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="month" name="month" placeholder="Mes">
                                    </div>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="year" name="year" placeholder="Ano">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="doc-body">
                        <div class="doc-title">
                            <h4>Anexo 3</h4>
                            <h4>Requerimento de Progressão/Promoção Funcional</h4>
                        </div>

                        <div class="doc-info-item">
                            <span>Magnífico(a) Reitor(a). <span class="response" id="reitor_name">__________</span> do Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul, </span>
                        </div>

                        <div class="doc-info-item mt-5">
                            <span><span class="response" id="name">{{$user->name}}</span>, professor(a) do Ensino Básico, Técnico e Tecnológico, para a área de (de acordo com o Edital do Concurso),
                            atualmente em exercício no Campus <span class="response" id="campus_name">__________</span> do IFRS,
                            solicito progressão/promoção funcional do nível <span class="response" id="current_level">__________</span> da classe <span class="response" id="current_class">__________</span> para o nível <span class="response" id="next_level">__________</span> da classe <span class="response" id="next_class">__________</span>,
                            a partir de <span class="response" id="efetivity_date">____/____/____ </span>, em conformidade com a avaliação de desempenho realizada pela Comissão Permanente de Pessoal Docente (CPPD).
                            Declaro, que tenho desempenhado minhas atividades com a qualidade, assiduidade e responsabilidade inerentes ao cargo de acordo com Portaria Nº 554, de 20 de junho de 2013, republicada em 30 de julho de 2013. </span>
                        </div>

                        <div class="doc-info-item">
                            <span><span class="response" id="city_name">__________</span>, <span class="response" id="day">__________</span> de <span class="response" id="month">__________</span> de <span class="response" id="year">__________</span></span>
                        </div>

                        <div class="doc-info-item">
                            <span>Nestes termos,<br>pede deferimento.</span>
                        </div>

                        <div class="doc-info-signature mt-3">
                            <span class="signature" id="signature-result">_____________________________________________</span>
                            <span>Assinatura do servidor</span>
                        </div>
                    </div>


                </div>
            </div>

            <!-- third step -->
            <div class="step" data-step="3">
                <h4 class="card-header">
                Documento 4
                </h4>

                <div class="card-body">
                    <div class="fields-body container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group row mt-3 align-items-center">
                                    <label for="cppd_president" class="col-sm-3 col-form-label">Pesidente CPPD</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="cppd_president" name="cppd_president" placeholder="Presidente">
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="area" class="col-sm-3 col-form-label">Area</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="area" name="area" placeholder="Area">
                                    </div>
                                </div>

                                <hr>

                                <!--
                                <div class="form-group row mt-3 align-items-center">
                                    <label for="current_level" class="col-sm-2 col-form-label">Nivel atual</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="current_level" name="current_level" placeholder="Nivel">
                                    </div>

                                    <label for="current_class" class="col-sm-2 col-form-label">Classe Atual</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="current_class" name="current_class" placeholder="Classe">
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="next_level" class="col-sm-2 col-form-label">Próximo Nivel</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="next_level" name="next_level" placeholder="Nivel">
                                    </div>

                                    <label for="next_class" class="col-sm-2 col-form-label">Próxima Classe</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="next_class" name="next_class" placeholder="Classe">
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="efetivity_date" class="col-sm-4 col-form-label">Data da Efetividade da Progressão</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="efetivity_date" name="efetivity_date">
                                    </div>
                                </div>

                                <hr>
                                -->

                                <div class="form-group row mt-3 align-items-center">
                                    <label for="start_period" class="col-sm-2 col-form-label">Início do Período</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" id="start_period" name="start_period">
                                    </div>

                                    <label for="final_period" class="col-sm-2 col-form-label">Fim do Período</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" id="final_period" name="final_period">
                                    </div>
                                </div>


                                <!--
                                <div class="form-group row mt-3 align-items-center">
                                    <label for="city_name" class="col-sm-3 col-form-label">Nome da Cidade</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="city_name" name="city_name" placeholder="Cidade">
                                    </div>
                                </div>

                                <div class="form-group row mt-3 align-items-center">
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="day" name="day" placeholder="Dia">
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="month" name="month" placeholder="Mes">
                                    </div>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="year" name="year" placeholder="Ano">
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>

                    <div class="doc-body">
                        <div class="doc-title">
                            <h4>Anexo 4</h4>
                            <h4>Solicitação de Avaliação de Desempenho e Memorial Descritivo</h4>
                        </div>

                        <div class="doc-info-item">
                            <span>Professor <span class="response" id="cppd_president">__________</span></span>
                        </div>

                        <div class="doc-info-item">
                            <span>Presidente da Representação da CPPD do IFRS no Campus <span class="response" id="campus_name">__________</span></span>
                        </div>

                        <div class="doc-info-item mt-5">
                            <span>
                                <span class="response" id="name">{{ $user->name }}</span>, professor(a) do Ensino Básico, Técnico e Tecnológico, para a área de <span class="response" id="area">__________</span>, atualmente em exercício no Campus <span id="campus_name">__________</span> do IFRS,
                                solicito sua avaliação de desempenho para fins de progressão funcional progressão funcional do nível
                                <span class="response" id="current_level">__________</span> da classe <span class="response" id="current_class">__________</span> para o nível <span class="response" id="next_level">__________</span> da classe <span class="response" id="next_class">__________</span>, a partir de <span class="response" id="efetivity_date">____/____/____ </span>.
                                Desta forma, encaminho neste processo o memorial descritivo das atividades docentes desempenhadas neste interstício, acompanhado dos respectivos documentos comprobatórios,
                                referentes ao período de <span class="response" id="start_period">____/____/____ </span> a <span class="response" id="final_period">____/____/____ </span>.
                            </span>
                        </div>

                        <div class="doc-info-item">
                            <span><span class="response" id="city_name">__________</span>, <span class="response" id="day">__________</span> de <span class="response" id="month">__________</span> de <span id="year">__________</span></span>
                        </div>

                        <div class="doc-info-signature mt-5">
                            <span class="signature" id="signature-result">_____________________________________________</span>
                            <span>Nome</span>
                        </div>

                        <div class="doc-info-signature mt-3">
                            <span class="signature" id="signature-result">_____________________________________________</span>
                            <span>Assinatura do servidor</span>
                        </div>
                    </div>


                </div>
            </div>

            <!-- fourth step -->
            <div class="step" data-step="1">
                <h4 class="card-header">
                    Documento 4
                </h4>

                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Questão</th>
                            <th>Valor</th>
                            <th>Pontuação</th>
                            <th>Documento</th>
                            <th>Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $k => $question)
                        <tr>
                            <td>{{$question->name}}</td>
                            <td>
                                <div class="custom-file-upload">
                                    <input type="number" name="document_{{$k}}" id="file-value" name="value" />
                                </div>
                            </td>
                            <td>{{$question->pontuation}}</td>
                            <td>
                                <div class="custom-file-upload">
                                    <label for="file-upload"><i class="bi bi-file-earmark-arrow-up"></i></label>
                                    <input type="file" name="document_{{$k}}" id="file-upload" />
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </form>

          <div class="card-footer">
            <div class="text-center">
                <button class="btn btn-primary prev-btn disabled" type="button">Anterior</button>
                <button class="btn btn-primary next-btn" type="button">Próximo</button>
                <button class="btn btn-success submit-btn" disabled type="submit">Enviar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
