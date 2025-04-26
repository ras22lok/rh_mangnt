<div class="d-flex flex-column sidebar pt-4">
    <a href="{{ route('home') }}"><i class="fas fa-home me-3"></i>Home</a>
    @can('admin')
        <a href="#"><i class="fas fa-users me-3"></i>Colaboradores</a>
        <a href="#"><i class="fas fa-user-gear me-3"></i>Colaboradores do RH</a>
        <a href="{{ route('departamento') }}"><i class="fas fa-industry me-3"></i>Departamentos</a>

    @endcan
    <hr>
    <a href="{{ route('user.perfil') }}"><i class="fas fa-address-card me-3"></i>Perfil</a>
    <hr>
    <div class="text-center">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt me-3"></i>Sair</button>
        </form>
    </div>
</div>
