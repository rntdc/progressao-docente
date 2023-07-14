<div class="row d-flex justify-content-center">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Geral
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    {!! Form::label('semester', 'Semestre', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-4">
                        {!! Form::text('semester', $item->semester, ['class' => 'form-control', 'placeholder' => '2010/2', 'required' => true]) !!}
                        @if($errors->has('semester'))
                            @foreach($errors->get('semester') as $error)
                                <span class="m-1 text-danger" style="font-size: 11px">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-3">
                    {!! Form::label('start_date', 'Data Inicial', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-4">
                        {!! Form::date('start_date', $item->start_date, ['class' => 'form-control', 'placeholder' => 'Data', 'required' => true]) !!}
                        @if($errors->has('start_date'))
                            @foreach($errors->get('start_date') as $error)
                                <span class="m-1 text-danger" style="font-size: 11px">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    {!! Form::label('end_date', 'Data Final', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-4">
                        {!! Form::date('end_date', $item->end_date, ['class' => 'form-control', 'placeholder' => 'Data', 'required' => true]) !!}
                        @if($errors->has('end_date'))
                            @foreach($errors->get('end_date') as $error)
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
