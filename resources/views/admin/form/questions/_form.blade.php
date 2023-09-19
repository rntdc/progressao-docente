<div class="row d-flex justify-content-center">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Geral - Questão para o índice {{ $item->name }}
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="subitem" value="{{ request()->query('subitem') }}">

                <div class="form-group row">
                    {!! Form::label('name', 'Título', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-10">
                        {!! Form::text('name', $question->name, ['class' => 'form-control', 'placeholder' => 'Título da Questão', 'required' => true]) !!}
                        @if($errors->has('name'))
                            @foreach($errors->get('name') as $error)
                                <span class="m-1 text-danger" style="font-size: 11px">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-3">
                    {!! Form::label('pontuation', 'Pontuação', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-10">
                        {!! Form::number('pontuation', $question->pontuation, ['class' => 'form-control', 'placeholder' => 'Fator de Pontuação', 'required' => true, 'step' => '.001']) !!}
                        @if($errors->has('pontuation'))
                            @foreach($errors->get('pontuation') as $error)
                                <span class="m-1 text-danger" style="font-size: 11px">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="general-toolbar d-flex justify-content-end p-2">
                    <button type="submit" class="btn btn-default"><i class="fas fa-save"></i> Salvar</button>
                </div>

            </div>
        </div>
    </div>
</div>
