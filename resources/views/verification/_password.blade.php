<div class="row justify-content-center mt-3">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">{{ __('Senha') }}</div>

            <div class="card-body">
                {{ __('Crie uma senha de acesso.') }}
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Senha') }}</label>

                    <div class="col-md-6">
                        <input id="repassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required>

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9 mt-4">
        <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Salvar</button>
    </div>
</div>
