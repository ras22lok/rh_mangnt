<div class="col-3">
    <div class="border p-5 shadow-sm">
        <form action="{{ route('user.alterar-senha') }}" method="post">
            @csrf
            <h3>Alterar senha</h3>
            <div class="mb-3">
                <label for="current_password" class="form-label">Senha atual</label>
                <input type="password" name="current_password" id="current_password" class="form-control">
                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Nova senha</label>
                <input type="password" name="new_password" id="new_password" class="form-control">
                @error('new_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirmar nova senha</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                @error('new_password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Alterar senha</button>
            </div>
        </form>
        @if (session('server_error'))
            <div class="alert alert-danger mt-3">
                {{ session('server_error') }}
            </div>
        @elseif (session('server_success'))
            <div class="alert alert-success mt-3">
                {{ session('server_success') }}
            </div>
        @endif
    </div>
</div>

