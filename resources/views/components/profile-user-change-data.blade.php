<div class="col-3">
    <div class="border p-5 shadow-sm">
        <form action="{{ route('user.alterar-dados') }}" method="post">
            @csrf
            <h3>Alterar dados</h3>
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email (Username)</label>
                <input type="email" name="email" id="email" class="form-control text-center" value="{{ auth()->user()->email }}" style="color: black" disabled />
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Atualizar dados</button>
            </div>
        </form>
        @if (session('server_error_data'))
            <div class="alert alert-danger mt-3">
                {{ session('server_error_data') }}
            </div>
        @elseif (session('server_success_data'))
            <div class="alert alert-success mt-3">
                {{ session('server_success_data') }}
            </div>
        @endif
    </div>
</div>
