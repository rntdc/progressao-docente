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
                    {!! Form::label('reitor_name', 'Nome do Reitor', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-10">
                        {!! Form::text('reitor_name', $item->reitor_name, ['class' => 'form-control', 'placeholder' => 'Nome', 'required' => true]) !!}
                        @if($errors->has('reitor_name'))
                            @foreach($errors->get('reitor_name') as $error)
                                <span class="m-1 text-danger" style="font-size: 11px">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-3">
                    {!! Form::label('cppd_president', 'Presidente CPPD', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-10">
                        {!! Form::text('cppd_president', $item->cppd_president, ['class' => 'form-control', 'placeholder' => 'Presidente', 'required' => true]) !!}
                        @if($errors->has('cppd_president'))
                            @foreach($errors->get('cppd_president') as $error)
                                <span class="m-1 text-danger" style="font-size: 11px">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-3">
                    {!! Form::label('cppd_secretary', 'Secretário CPPD', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-10">
                        {!! Form::text('cppd_secretary', $item->cppd_secretary, ['class' => 'form-control', 'placeholder' => 'Secretário', 'required' => true]) !!}
                        @if($errors->has('cppd_secretary'))
                            @foreach($errors->get('cppd_secretary') as $error)
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
