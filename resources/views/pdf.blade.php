@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Formulario') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('extract') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group">
                            <input type="file" class="form-control" name="pdf" aria-label="Upload">
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger mt-2">
                                {{ session('error') }}
                            </div>
                        @endif

                        <button type="submit" class="mt-1 btn btn-primary">Enviar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
