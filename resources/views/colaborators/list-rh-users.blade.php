<x-layout-app titulo="Colaboradores">
    <div class="w-100 p-4">
        <h3>Colaboradores</h3>
        <hr>
        @if($colaborators->count() === 0)
            <div class="text-center my-5">
                <p>Nenhum colaborador encontrado.</p>
                <a href="{{ route('recursos-humanos.criar') }}" class="btn btn-primary">Criar um novo colaborador</a>
            </div>
            <hr>
        @else
            <div class="mb-3">
                <a href="{{ route('recursos-humanos.criar') }}" class="btn btn-primary">Criar um novo colaborador</a>
            </div>
            <table class="table" id="table">
                <thead class="table-dark">
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Departamento</th>
                    <th>Permissões</th>
                    <th>Endereço</th>
                    <th>Cidade</th>
                    <th>Data de admissão</th>
                    <th>Salario</th>
                    <th>Conta confirmada</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($colaborators as $colaborator)
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>{{ $colaborator->department->name }}</td>
                            <td>{{ implode(',', json_decode($colaborator->permissions)) }}</td>
                            <td>{{ $colaborator->detail->address }}</td>
                            <td>{{ $colaborator->detail->city }}</td>
                            <td>{{ $colaborator->detail->admission_date }}</td>
                            <td>R${{ $colaborator->detail->salary }}</td>
                            <td>{{ $colaborator->email_verified_at }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="{{ route('recursos-humanos.editar', ['id' => encrypt($colaborator->id)]) }}" class="btn btn-sm btn-outline-success"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                    <a href="{{ route('recursos-humanos.confirmar-remocao', ['id' => encrypt($colaborator->id)]) }}" class="btn btn-sm btn-outline-danger"><i class="fa-regular fa-trash-can me-2"></i>Remover</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
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
