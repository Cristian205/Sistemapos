<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema POS RG - Login</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
 
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #f1f5f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #1e293b;
    }

    .login-container {
      display: flex;
      width: 95%;
      max-width: 1080px;
      background-color: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
      animation: fadeIn 0.8s ease-out;
    }

    .form-section {
      flex: 1;
      padding: 60px 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-section h1 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #0f172a;
      text-align: center;
    }

    .form-section img.logo {
      display: block;
      margin: 0 auto 30px;
      width: 90px;
      height: 90px;
      border-radius: 50%;
      background: #0c1e36;
      padding: 10px;
    }

    .form-group {
      position: relative;
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-size: 0.9rem;
      color: #475569;
    }

    .form-group input {
      width: 100%;
      padding: 12px 44px 12px 14px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      font-size: 1rem;
      color: #0f172a;
      background-color: #fff;
      transition: border 0.3s ease;
    }

    .form-group input:focus {
      border-color: #0ea5e9;
      outline: none;
    }

    .form-group i {
      position: absolute;
      top: 38px;
      right: 12px;
      font-size: 20px;
      color: #64748b;
      cursor: pointer;
    }

    .btn-submit {
      background-color: #0ea5e9;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
      margin-top: 10px;
    }

    .btn-submit:hover {
      background-color: #0284c7;
    }

    .forgot {
      text-align: right;
      margin-top: 8px;
    }

    .forgot a {
      font-size: 0.85rem;
      color: #0ea5e9;
      text-decoration: none;
    }

    .image-section {
      flex: 1;
      background: #f0f9ff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }

    .image-section img {
      max-width: 100%;
      border-radius: 12px;
    }

    .image-section h2 {
      font-size: 1.5rem;
      margin-top: 20px;
      color: #0f172a;
    }

    .image-section p {
      color: #64748b;
      font-size: 0.9rem;
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        margin: 20px;
      }

      .image-section {
        display: none;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="form-section">
      <h1>Sistema POS RG</h1>
      <img src="{{ asset('storage/Img-Login/Logo.png') }}" alt="Logo CR" class="logo">

      <form action="{{ route('login.usuarios') }}" method="POST" id="login-form">
        @csrf

        <div class="form-group">
          <label for="user">Nombre de usuario</label>
          <input type="text" name="user" id="user" required>
          <i class="bx bx-user"></i>
        </div>

        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" name="email" id="email" required>
          <i class="bx bx-envelope"></i>
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" name="password" id="password" required>
          <i class="bx bx-show toggle-password" id="toggle-password"></i>
        </div>

        <div class="forgot">
          <a href="#">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="btn-submit">Ingresar</button>
      </form>
    </div>

    <div class="image-section">
      <img src="{{ asset('storage/Img-Login/software-pos.png') }}" alt="POS Software" />
      <h2>POS Colombia</h2>
      <p>www.softwarepos.co</p>
    </div>
  </div>

  <script>
    const toggle = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');

    toggle.addEventListener('click', () => {
      const isHidden = passwordInput.type === 'password';
      passwordInput.type = isHidden ? 'text' : 'password';
      toggle.classList.toggle('bx-show');
      toggle.classList.toggle('bx-hide');
    });
  </script>
</body>
</html>
