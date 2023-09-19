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
                    {!! Form::label('name', 'Nome', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-10">
                        {!! Form::text('name', $item->name, ['class' => 'form-control', 'placeholder' => 'Nome', 'required' => true]) !!}
                        @if($errors->has('name'))
                            @foreach($errors->get('name') as $error)
                                <span class="m-1 text-danger" style="font-size: 11px">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-2">
                    {!! Form::label('email', 'Email', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-10">
                        {!! Form::text('email', $item->email, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => true]) !!}
                        @if($errors->has('email'))
                            @foreach($errors->get('email') as $error)
                                <span class="m-1 text-danger" style="font-size: 11px">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-2">
                    {!! Form::label('date_of_birth', 'Nascimento', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-10">
                        {!! Form::date('date_of_birth', $item->date_of_birth, ['class' => 'form-control', 'required' => true]) !!}
                        @if($errors->has('date_of_birth'))
                            @foreach($errors->get('date_of_birth') as $error)
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
