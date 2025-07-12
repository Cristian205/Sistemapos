// Mostrar/Ocultar contraseña en Login
const loginPassword = document.getElementById('password');
const loginToggle = document.getElementById('toggle-password-login');

loginToggle.addEventListener('click', () => {
    const isHidden = loginPassword.type === "password";
    loginPassword.type = isHidden ? "text" : "password";
    loginToggle.classList.toggle('bx-show', !isHidden);
    loginToggle.classList.toggle('bx-hide', isHidden);
});

// Mostrar/Ocultar contraseña en Registro
const registerPassword = document.getElementById('password_register');
const registerToggle = document.getElementById('toggle-password-register');

registerToggle.addEventListener('click', () => {
    const isHidden = registerPassword.type === "password";
    registerPassword.type = isHidden ? "text" : "password";
    registerToggle.classList.toggle('bx-show', !isHidden);
    registerToggle.classList.toggle('bx-hide', isHidden);
});

// Alternar formularios
const loginBtn = document.getElementById('show-login');
const registerBtn = document.getElementById('show-register');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');

loginBtn.addEventListener('click', () => {
    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');
    loginBtn.classList.add('active');
    registerBtn.classList.remove('active');
});

registerBtn.addEventListener('click', () => {
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');
    loginBtn.classList.remove('active');
    registerBtn.classList.add('active');
});

// Inicio de sesión
$(document).ready(function () {
    $("#login-form").submit(function (event) {
        event.preventDefault();

        let user = $('#login-form input[name="user"]').val();
        let email = $('#login-form input[name="email"]').val();
        let password = $('#login-form input[name="password"]').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST",
            url: LOGIN_URL,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            dataType: "json",
            data: {
                user: user,
                email: email,
                password: password
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "¡Inicio de sesión exitoso!",
                    text: "Bienvenido a la plataforma",
                }).then(() => {
                    window.location.href = response.redirect;
                });
            },
            error: function (xhr) {
                const response = xhr.responseJSON;
                const message = response?.error || "Ocurrió un error inesperado";

                Swal.fire({
                    icon: "error",
                    title: "Error de inicio de sesión",
                    text: message
                });
            }
        });
    });
});

// Registro
$(document).ready(function () {
    $("#register-form").submit(function (event) {
        event.preventDefault();

        let formData = {
            name: $('#register-form input[name="name"]').val(),
            email: $('#register-form input[name="email"]').val(),
            password: $('#register-form input[name="password"]').val(),
            role: $('#register-form select[name="role"]').val(),
            birthdate: $('#register-form input[name="birthdate"]').val(),
            document_number: $('#register-form input[name="document_number"]').val(),
            phone_number: $('#register-form input[name="phone_number"]').val()
        };


        $.ajax({
            type: "POST",
            dataType: "json",
            url: REGISTER_URL,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json' // ✅ Esto es lo que forzará respuestas JSON desde Laravel
            },
            data: formData,
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Registro exitoso",
                    text: response.message || "Usuario registrado correctamente.",
                }).then(() => {
                    window.location.href = response.redirect || "/";
                });
            },
            error: function (xhr) {
                const response = xhr.responseJSON;
                const errors = response?.details || {};
                let message = response?.error || "Ocurrió un error al registrar";

                if (Object.keys(errors).length > 0) {
                    message += '\n' + Object.values(errors).map(err => `• ${err[0]}`).join('\n');
                }

                Swal.fire({
                    icon: "error",
                    title: "Error de registro",
                    text: message
                });
            }
        });
    });
});
