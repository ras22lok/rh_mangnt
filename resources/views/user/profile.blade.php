<x-layout-app titulo="Perfil do usuário">
    <div class="w-100 p-4">
        <h3>Perfil</h3>
        <hr>
        <x-profile-user-data />
        <hr>
        <div class="container-fluid m-0 p-0 mt-5">
            <div class="row">
                {{-- Componente de alteração de senha --}}
                <x-profile-user-change-password />

                {{-- Componente de alteração dos dados --}}
                <x-profile-user-change-data />
            </div>
        </div>

    </div>
</x-layout-app>
