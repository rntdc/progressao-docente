<div class="row justify-content-center mt-3">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">{{ __('Informações') }}</div>

            <div class="card-body">
                {{ __('Verifique as informações.') }}
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                    <div class="col-md-6">
                        <input id="name" value="{{ $name }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                    <div class="col-md-6">
                        <input id="email" value="{{ $email }}" type="text" class="form-control @error('email') is-invalid @enderror" name="email" required>

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
