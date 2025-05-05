<x-layout-app titulo="Editar colaborador">
    <div class="w-100 p-4">
        <h3>Editar colaborador</h3>
        <hr>
        <form action="{{ route('recursos-humanos.editar-db') }}" method="post">
            @csrf
            <div class="container-fluid">
                <div class="row gap-3">
                    <div class="col border border-black p-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $colaborator->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{--
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $colaborator->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        --}}
                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-grow-1 pe-3">
                                    <label for="department" class="form-label">Departamento</label>
                                    <select name="department_id" id="department" class="form-select">
                                        @foreach ($departments as $department)
                                            <option value="{{ encrypt($department->id) }}"><strong>{{ $department->name }}</strong></option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <a href="{{ route('departamento.criar') }}"
                                        class="btn btn-outline-primary mt-4"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- detalhes do usuário --}}
                    <div class="col border border-black p-4">
                        <div class="mb-3">
                            <label for="Address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $colaborator->detail->address) }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">Cep</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code', $colaborator->detail->zip_code) }}">
                                    @error('zip_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $colaborator->detail->city) }}">
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $colaborator->detail->phone) }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salario</label>
                                    <input type="number" class="form-control" id="salary" name="salary" step=".01" placeholder="0,00" value="{{ old('salary', $colaborator->detail->salary) }}">
                                    @error('salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="admission_date" class="form-label">Data de admissão</label>
                                    <input type="date" class="form-control" id="admission_date" name="admission_date" placeholder="YYYY-mm-dd" value="{{ old('admission_date', $colaborator->detail->admission_date) }}">
                                    @error('admission_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value={{ encrypt($colaborator->id) }}>
            <div class="mt-4">
                <a href="{{ route('recursos-humanos.listar') }}" class="btn btn-outline-danger me-3">CANCELAR</a>
                <button type="submit" class="btn btn-primary">Editar colaborador</button>
            </div>
        </form>
        @if (session('server_error'))
            <div class="alert alert-danger text-center">
                {{ session('server_error') }}
            </div>
        @endif
    </div>
</x-layout-app>
