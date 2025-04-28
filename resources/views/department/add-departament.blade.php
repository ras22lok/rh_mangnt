<x-layout-app titulo="Criar departamento">
    <div class="w-25 p-4">
        <h3>Novo departamento</h3>
        <hr>
        <form action="{{ route('departamento.criar-db') }}" method="post">
            @csrf
            <div class="mb-3">
                @php $placeholder = ""; @endphp
                @error('name') {{$placeholder = $message}} @enderror
                <label for="name" class="form-label">Nome do departamento</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{ $placeholder }}" required>
            </div>
            <div class="mb-3">
                <a href="{{ route('departamento.listar') }}" class="btn btn-outline-danger me-3">CANCELAR</a>
                <button type="submit" class="btn btn-primary">Criar departamento</button>
            </div>
        </form>
    </div>
</x-layout-app>
