<x-layout-guest titulo="Recuperar senha">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-5">
                <!-- logo -->
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>
                <!-- Recuperação de senha -->
                <div class="card p-5">
                    @if(!session('status'))
                        <p>Para recuperar a sua senha, por favor indique o seu email. Irá receber um email com um link para recuperar a senha.</p>
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                    <div class="alert alert-danger text-center">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('login') }}">Já sei a minha senha?</a>
                                <button type="submit" class="btn btn-primary px-4">Enviar email</button>
                            </div>
                        </form>
                    @else(session('status'))
                        <div class="text-center mb-5">
                            {{ session('status') }}
                        </div>
                        <p class="text-center"><a class="btn btn-primary" href="{{ route('login') }}">Ir para a página de login</a></p>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-layout-guest>
