<x-layout-app titulo="Remover colaborador">
    <div class="w-25 p-4">
        <h3>Remover colaborador</h3>
        <hr>
        <p>Tem certeza que deseja remover o colaborador?</p>

        <div class="text-center">
            <h3 class="my-5">{{ $colaborator->name }}</h3>
            <p>{{ $colaborator->email }}</p>
            <a href="{{ route('recursos-humanos.listar') }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route('recursos-humanos.remover', ['id' => encrypt($colaborator->id)]) }}" class="btn btn-danger px-5">Sim</a>
        </div>

    </div>

</x-layout-app>
