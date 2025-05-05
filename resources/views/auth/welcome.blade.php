<x-layout-guest titulo="Bem-vindo">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" with="200px">
                </div>
                <div class="card p-5 text-center">
                    <p>Bem-vindo, <strong>{{ $user->toArray()[0]['name'] }}</strong>!</p>
                    <p>Sua conta foi criada com sucesso!</p>
                    <p>Agora você pode <a href="{{ route('login') }}">logar</a> na sua conta</p>
                </div>
            </div>
        </div>
    </div>
</x-layout-guest>
