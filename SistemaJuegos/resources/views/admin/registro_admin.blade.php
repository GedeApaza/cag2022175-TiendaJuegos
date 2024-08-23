<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador</title>
    <!-- Incluye Bootstrap -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .invalid-feedback {
            display: none;
            color: red;
        }
        .is-invalid {
            border-color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Registro de Administrador</h1>
            <div class="card shadow-lg">
                <div class="card-body p-4">
                <form id="registroCensistaForm" method="POST" action="{{ route('admin.registrar_admin') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Nombres -->
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" maxlength="45">
                            <div class="invalid-feedback" id="nombres-feedback">Solo se permiten letras y espacios. Máximo 40 caracteres.</div>
                        </div>
                        <!-- Apellidos -->
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" maxlength="45">
                            <div class="invalid-feedback" id="apellidos-feedback">Solo se permiten letras y espacios. Máximo 40 caracteres.</div>
                        </div>
                        <!-- Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required maxlength="45" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Debe incluir un '@' y un dominio válido.">
                            <div class="invalid-feedback" id="email-feedback">Correo electrónico inválido. Asegúrate de incluir un '@' y un dominio válido.</div>
                        </div>
                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required maxlength="20">
                            </div>
                            <div class="invalid-feedback" id="password-feedback">La contraseña debe incluir al menos una letra mayúscula, una minúscula, un número y un símbolo especial. Máximo 20 caracteres.</div>
                        </div>
                        <!-- Foto de Perfil -->
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto de Perfil</label>
                            <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/*" required>
                        </div>
                        <!-- Vista Previa y Confirmación de Foto -->
                        <div class="mb-3">
                            <img id="fotoPreview" src="" alt="Vista previa de la foto" style="max-width: 200px; display: none;" class="img-thumbnail">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-success" id="confirmarFoto" style="display: none;">Confirmar Foto</button>
                        </div>
                        <!-- Celular -->
                        <div class="mb-3">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="number" class="form-control" id="celular" name="celular" maxlength="8">
                            <div class="invalid-feedback" id="celular-feedback">Número de celular inválido. Máximo 8 caracteres.</div>
                        </div>
                        <!-- Dirección -->
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" maxlength="45">
                            <div class="invalid-feedback" id="direccion-feedback">Solo se permiten letras y espacios. Máximo 40 caracteres.</div>
                        </div>
                        <!-- Botón de Registrar -->
                        <button type="submit" class="btn btn-primary w-100" id="registrarButton" disabled>Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS y dependencias -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script para vista previa y validación de la foto
    const fotoInput = document.getElementById('foto_perfil');
    const fotoPreview = document.getElementById('fotoPreview');
    const confirmarFotoBtn = document.getElementById('confirmarFoto');
    const registrarButton = document.getElementById('registrarButton');

    fotoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                fotoPreview.src = e.target.result;
                fotoPreview.style.display = 'block';
                confirmarFotoBtn.style.display = 'inline-block';
                registrarButton.disabled = true;
            }
            reader.readAsDataURL(file);
        }
    });

    confirmarFotoBtn.addEventListener('click', function () {
        confirmarFotoBtn.style.display = 'none';
        registrarButton.disabled = false;
        validateForm();
    });

    // Función para validar el formulario
    function validateForm() {
        const form = document.getElementById('registroCensistaForm');
        const inputs = [
            { id: 'nombres', maxLength: 40, feedback: 'nombres-feedback' },
            { id: 'apellidos', maxLength: 40, feedback: 'apellidos-feedback' },
            { id: 'email', maxLength: 40, feedback: 'email-feedback' },
            { id: 'password', maxLength: 20, feedback: 'password-feedback' },
            { id: 'celular', maxLength: 8, feedback: 'celular-feedback' },
            { id: 'direccion', maxLength: 40, feedback: 'direccion-feedback' }
        ];

        let formIsValid = true;

        inputs.forEach(input => {
            const element = document.getElementById(input.id);
            const feedbackElement = document.getElementById(input.feedback);

            if (element.value.length > input.maxLength) {
                feedbackElement.style.display = 'block';
                element.classList.add('is-invalid');
                formIsValid = false;
            } else {
                feedbackElement.style.display = 'none';
                element.classList.remove('is-invalid');
            }
        });

        // Validación específica del correo electrónico
        const emailInput = document.getElementById('email');
        const emailFeedback = document.getElementById('email-feedback');
        const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;

        if (emailInput.value.length > 0) {
            if (!emailPattern.test(emailInput.value)) {
                emailFeedback.style.display = 'block';
                emailInput.classList.add('is-invalid');
                formIsValid = false;
            } else {
                emailFeedback.style.display = 'none';
                emailInput.classList.remove('is-invalid');
            }
        }

        // Validación específica de la contraseña
        const passwordInput = document.getElementById('password');
        const passwordFeedback = document.getElementById('password-feedback');
        const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{1,20}$/;

        if (passwordInput.value.length > 0) {
            if (!passwordPattern.test(passwordInput.value)) {
                passwordFeedback.style.display = 'block';
                passwordInput.classList.add('is-invalid');
                formIsValid = false;
            } else {
                passwordFeedback.style.display = 'none';
                passwordInput.classList.remove('is-invalid');
            }
        }

        registrarButton.disabled = !formIsValid;
    }

    // Validación de longitud y formato de campos
    const allInputs = document.querySelectorAll('input');
    allInputs.forEach(input => {
        input.addEventListener('input', validateForm);
    });

    // Validación inicial del formulario
    validateForm();
</script>
</body>
</html>
