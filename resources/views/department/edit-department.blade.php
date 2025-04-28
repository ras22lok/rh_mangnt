<x-layout-app titulo="Editar departamento">
    <div class="w-25 p-4">
        <h3>Editar departamento</h3>
        <hr>
        <form action="{{ route('departamento.editar-db') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome do departamento</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" required>
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input type="hidden" name="id" value={{ $department->id }}>
            <div class="mb-3">
                <a href="{{ route('departamento.listar') }}" class="btn btn-outline-danger me-3">CANCELAR</a>
                <button type="submit" class="btn btn-primary">Editar departamento</button>
            </div>
        </form>
        @if (session('server_error'))
            <div class="alert alert-danger text-center w-50">
                {{ session('server_error') }}
            </div>
        @endif
    </div>
</x-layout-app>
