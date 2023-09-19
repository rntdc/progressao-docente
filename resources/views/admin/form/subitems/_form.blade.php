<div class="row d-flex justify-content-center">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Geral - Subitem para o índice {{ $item->name }}
                </div>
            </div>
            <div class="card-body">

                <div class="form-group row">
                    {!! Form::label('name', 'Nome', ['class' => 'col-md-2 col-form-label text-sm-left']) !!}
                    <div class="col-md-10">
                        {!! Form::text('name', $subitem->name, ['class' => 'form-control', 'placeholder' => 'Nome do SubItem', 'required' => true]) !!}
                        @if($errors->has('name'))
                            @foreach($errors->get('name') as $error)
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
