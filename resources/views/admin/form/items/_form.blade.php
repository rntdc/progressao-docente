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
                        {!! Form::text('name', $item->name, ['class' => 'form-control', 'placeholder' => 'Nome do Item', 'required' => true]) !!}
                        @if($errors->has('name'))
                            @foreach($errors->get('name') as $error)
                                <span class="m-1 text-danger" style="font-size: 11px">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2 mt-3">
                        <div class="form-check form-switch">
                            <div class="custom-control custom-switch custom-switch-off-light custom-switch-on-success">
                                <input type="checkbox" role="switch" class="form-check-input" id="has_subitem" name="has_subitem" value="1" {{ $item->has_subitem == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="has_subitem">Possui SubItem</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="general-toolbar d-flex justify-content-end p-2">
                    <button type="submit" class="btn btn-default"><i class="fas fa-save"></i> Salvar</button>
                </div>

            </div>
        </div>
    </div>
</div>
