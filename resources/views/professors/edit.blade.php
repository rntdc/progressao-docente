@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Editar Dados</h1>
        <a href="{{ url(route('profile')) }}">Voltar</a>
        <form action="{{ url(route('profile.update')) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
            <!-- Form fields and submit button -->
            <div class="row justify-content-center mt-3">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">{{ __('Informações') }}</div>

                        <div class="card-body">
                            <div class="row mb-3 align-items-center">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    {{ $data->name }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" value="{{ $data->email }}" type="text" class="form-control @error('email') is-invalid @enderror" name="email" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center mt-3">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">{{ __('Dados') }}</div>

                        <div class="card-body">
                            <div class="row col-12 mt-2">
                                <div class="col-6 row align-items-center">
                                    <label for="level" class="col-md-4 col-form-label text-md-end">{{ __('Nível') }}</label>

                                    <div class="col-md-8">
                                        {{ $data->level }}
                                    </div>
                                </div>

                                <div class="col-6 row align-items-center">
                                    <label for="class" class="col-md-4 col-form-label text-md-end">{{ __('Classe') }}</label>

                                    <div class="col-md-8">
                                        {{ $data->class }}
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12 mt-2">
                                <div class="col-6 row">
                                    <label for="siape" class="col-md-4 col-form-label text-md-end">{{ __('SIAPE') }}</label>

                                    <div class="col-md-8">
                                        <input id="siape" value="{{ $data->siape }}" type="text" class="form-control @error('siape') is-invalid @enderror" name="siape" required>

                                        @error('siape')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6 row">
                                    <label for="entry_date" class="col-md-4 col-form-label text-md-end">{{ __('Ingresso') }}</label>

                                    <div class="col-md-8">
                                    @php
                                        $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $data->entry_date)->format('Y-m-d');
                                    @endphp

                                    <input id="entry_date" value="{{ $formattedDate }}" type="date" class="form-control @error('entry_date') is-invalid @enderror" name="entry_date" required>

                                        @error('entry_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-9 mt-4">
                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </div>

        </form>

    </div>
</div>

@endsection
