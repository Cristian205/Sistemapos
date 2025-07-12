<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema POS - Login</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 35px;
        }

        .password-wrapper .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
            font-size: 20px;
        }

        .toggle-buttons button.active {
            font-weight: bold;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="form-card">
            <h1 class="title">Sistema POS RG</h1>

            <div class="toggle-buttons">
                <button id="show-login" class="active">Iniciar Sesión</button>
                <button id="show-register">Registrar Usuario</button>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login.usuarios') }}" method="POST" id="login-form" class="form-section">
                @csrf
                <div class="form-group">
                    <input type="text" required name="user" id="User" />
                    <label for="User">Nombre de usuario</label>
                </div>
                <div class="form-group">
                    <input type="email" required name="email" id="email" />
                    <label for="email">Correo electrónico</label>
                </div>
                <div class="form-group password-wrapper">
                    <input type="password" required name="password" id="password" />
                    <label for="password">Contraseña</label>
                    <i class="bx bx-show toggle-password" id="toggle-password-login"></i>
                </div>

                <div class="extra-options">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>
                <button type="submit" class="btn-primary">Ingresar</button>
            </form>

            <!-- Register Form -->
            <form action="{{ route('Register') }}" method="POST" id="register-form" class="form-section hidden">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" id="Username" required />
                    <label for="Username">Nombre de usuario</label>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="Correo" required />
                    <label for="Correo">Correo electrónico</label>
                </div>
                <div class="form-group password-wrapper">
                    <div class="input-container">
                        <input type="password" name="password" id="password_register" required />
                        <label for="passwordregister">Contraseña</label>
                        <i class="bx bx-show toggle-password" id="toggle-password-register"></i>
                    </div>
                </div>
                <div class="form-group">
                    <select name="role" required>
                        <option value="" disabled selected>Seleccione un perfil</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Cajero">Cajero</option>
                        <option value="Supervisor">Supervisor</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="date" name="birthdate" id="FechaNacimiento" required>
                    <label for="FechaNacimiento">Fecha Nacimiento</label>
                </div>
                <div class="form-group">
                    <input type="number" name="document_number" id="Cedula" required/>
                    <label for="Cedula">Número de cédula</label>
                </div>
                <div class="form-group">
                    <input type="number" name="phone_number" id="Telefono" required/>
                    <label for="Telefono">Número de teléfono</label>
                </div>
                <div class="social-login">
                    <span class="social">Google</span>
                    <span class="social">Facebook</span>
                </div>
                <button type="submit" class="btn-secondary">Registrar Usuario</button>
            </form>
        </div>

        <div class="auth-image">
            <img src="{{ asset('storage/Img-Login/software-pos.png') }}" alt="POS software">
        </div>
    </div>

    <script>
        const LOGIN_URL = "{{ route('login.usuarios') }}";
        const REGISTER_URL = "{{ route('Register') }}";
    </script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
