<x-layout-guest titulo="Definir senha">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <!-- logo -->
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>
                <!-- Formulário de login -->
                <div class="card p-5">
                    <form action="{{ route('confirmar-conta-db') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value={{ $token }}>
                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation">Confirmação da senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary px-4">Cadastrar senha</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout-guest>
