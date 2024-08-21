@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Registro de Censistas</h1>
            <form action="{{ route('admin.registrar_admin') }}" method="POST" enctype="multipart/form-data" id="registroCensistaForm">
                @csrf
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios">
                    <div class="invalid-feedback" id="nombres-feedback">Solo se permiten letras y espacios.</div>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" required pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios">
                    <div class="invalid-feedback" id="apellidos-feedback">Solo se permiten letras y espacios.</div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </button>
                        <button type="button" class="btn btn-secondary" id="generatePassword">Generar Contraseña Segura</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto de Perfil</label>
                    <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <img id="fotoPreview" src="" alt="Vista previa de la foto" style="max-width: 200px; display: none;">
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-success" id="confirmarFoto" style="display: none;">Confirmar Foto</button>
                </div>
                <div class="mb-3">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="number" class="form-control" id="celular" name="celular">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios">
                    <div class="invalid-feedback" id="apellidos-feedback">Solo se permiten letras y espacios.</div>
                </div>
                <button type="submit" class="btn btn-primary" id="registrarButton" disabled>Registrar</button>
            </form>
        </div>
    </div>
    
</div>
