<x-layout-app titulo='Departamentos'>
    <div class="w-100 p-4">
        <h3>Departamentos</h3>
        <hr>
        @empty($departments)
            <div class="text-center my-5">
                <p>Nenhum departamento encontrado.</p>
                <a href="{ route('departamento.criar') }" class="btn btn-primary">Criar um novo departamento</a>
            </div>
            <hr>
        @else
            <div class="mb-3">
                <a href="{{ route('departamento.criar') }}" class="btn btn-primary">Criar um novo departamento</a>
            </div>
            <table class="table w-50" id="table">
                <thead class="table-dark">
                    <th>Departamento</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    @if ($department->id < 3)
                                        <i class="fa-solid fa-lock"></i>
                                    @else
                                        <a href="{{ route('departamento.editar', ['id' => encrypt($department->id)]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                        <a href="{{ route('departamento.confirmar-remocao', ['id' => encrypt($department->id)]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-trash-can me-2"></i>Deletar</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endempty
        @if (session('server_success'))
            <div class="alert alert-success text-center w-50">
                {{ session('server_success') }}
            </div>
        @elseif (session('server_error'))
            <div class="alert alert-danger text-center w-50">
                {{ session('server_error') }}
            </div>
        @endif
    </div>
</x-layout-app>
