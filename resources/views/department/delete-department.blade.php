<x-layout-app titulo="Confirmação de remoção de departamento">
    <div class="w-25 p-4">
        <h3>Remover departamento</h3>
        <hr>
        <p>Tem certeza que deseja remover o departamento?</p>
        <div class="text-center">
            <h3 class="my-5">{{ $departamento->name }}</h3>
            <a href="{{ route('departamento.listar') }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route('departamento.remover', ['id' => encrypt($departamento->id)]) }}" class="btn btn-danger px-5">Sim</a>
        </div>

    </div>
</x-layout-app>
