<div class="row justify-content-center mt-3">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">{{ __('Informações') }}</div>

            <div class="card-body">
                {{ __('Professor - Informações Básicas.') }}

                <div class="row col-12 mt-2">
                    <div class="col-6 row">
                        <label for="level" class="col-md-4 col-form-label text-md-end">{{ __('Nível') }}</label>

                        <div class="col-md-8">
                            <input id="level" value="" type="text" class="form-control @error('level') is-invalid @enderror" name="level" required>

                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 row">
                        <label for="class" class="col-md-4 col-form-label text-md-end">{{ __('Classe') }}</label>

                        <div class="col-md-8">
                            <input id="class" value="" type="text" class="form-control @error('class') is-invalid @enderror" name="class" required>

                            @error('class')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row col-12 mt-2">
                    <div class="col-6 row">
                        <label for="siape" class="col-md-4 col-form-label text-md-end">{{ __('SIAPE') }}</label>

                        <div class="col-md-8">
                            <input id="siape" value="" type="text" class="form-control @error('siape') is-invalid @enderror" name="siape" required>

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
                            <input id="entry_date" value="" type="date" class="form-control @error('entry_date') is-invalid @enderror" name="entry_date" required>

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
</div>
