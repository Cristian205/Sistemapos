<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>POS Pro - Lleva tu tienda al siguiente nivel</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Poppins:wght@600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/Welcome.css') }}" rel="stylesheet">
</head>
<body>

  <video autoplay muted loop class="background-video">
    <source src="{{ asset('storage/Img-Login/Background-Welcome.mp4') }}" type="video/mp4">
    Tu navegador no soporta video HTML5.
  </video>

  <div class="overlay"></div>

  <header>
  <div class="logo">
    <img src="{{ asset('storage/Img-Login/Logo.png') }}" alt="Logo CR">
  </div>

  <!-- Botón hamburguesa -->
  <div class="hamburger" onclick="toggleMenu()" aria-label="Menú móvil">
    ☰
  </div>

  <!-- Menú -->
  <nav class="nav-links" id="mobileMenu">
    <a href="{{ route('LoginViews') }}">Iniciar sesión</a>
    <a href="{{ route('registro') }}">Crear cuenta</a>
  </nav>
</header>


  <main class="hero">
    <h1>Transforma tu tienda con nuestro sistema Pos</h1>
    <p>Una solución moderna para ventas, inventario, reportes y más. Fácil de usar, lista para crecer contigo.</p>
    <p class="trust-text">Sin tarjeta de crédito, sin contratos. Comienza gratis.</p>
    <div class="cta-buttons">
      <a href="{{ route('registro') }}">Empezar gratis</a>
      <a href="{{ route('LoginViews') }}">Ya tengo cuenta</a>
    </div>
  </main>

  <section class="benefits-summary">
    <div class="triangle-background">
        <div class="triangle" style="top: 5%; left: 3%; border-bottom-color: #38bdf8;"></div>
        <div class="triangle" style="top: 12%; left: 20%; border-bottom-color: #f59e0b;"></div>
        <div class="triangle" style="top: 8%; left: 80%; border-bottom-color: #22c55e;"></div>
        <div class="triangle" style="top: 18%; left: 60%; border-bottom-color: #ec4899;"></div>
        <div class="triangle" style="top: 22%; left: 40%; border-bottom-color: #8b5cf6;"></div>
        <div class="triangle" style="top: 30%; left: 10%; border-bottom-color: #0ea5e9;"></div>
        <div class="triangle" style="top: 35%; left: 85%; border-bottom-color: #38bdf8;"></div>
        <div class="triangle" style="top: 45%; left: 25%; border-bottom-color: #f59e0b;"></div>
        <div class="triangle" style="top: 48%; left: 70%; border-bottom-color: #22c55e;"></div>
        <div class="triangle" style="top: 55%; left: 50%; border-bottom-color: #ec4899;"></div>
        <div class="triangle" style="top: 65%; left: 5%; border-bottom-color: #8b5cf6;"></div>
        <div class="triangle" style="top: 70%; left: 95%; border-bottom-color: #0ea5e9;"></div>
        <div class="triangle" style="top: 78%; left: 35%; border-bottom-color: #38bdf8;"></div>
        <div class="triangle" style="top: 85%; left: 60%; border-bottom-color: #f59e0b;"></div>
        <div class="triangle" style="top: 92%; left: 15%; border-bottom-color: #22c55e;"></div>
</div>

    <div>
      <h3>🧾 Empieza a vender hoy</h3>
      <p>Configura tu tienda en minutos y comienza a registrar ventas desde cualquier dispositivo.</p>
    </div>
    <div>
      <h3>📊 Control total</h3>
      <p>Visualiza tus ganancias, inventario, usuarios y reportes sin complicaciones.</p>
    </div>
    <div>
      <h3>🚀 Listo para crecer</h3>
      <p>Funciona para tiendas pequeñas o grandes, con soporte para múltiples usuarios y planes.</p>
    </div>
  </section>

  <section class="features">
    <div class="triangle-background-features">
  <div class="triangle" style="top: 5%; left: 10%; border-bottom-color: #38bdf8;"></div>
  <div class="triangle" style="top: 15%; left: 80%; border-bottom-color: #f59e0b;"></div>
  <div class="triangle" style="top: 25%; left: 50%; border-bottom-color: #22c55e;"></div>
  <div class="triangle" style="top: 35%; left: 30%; border-bottom-color: #ec4899;"></div>
  <div class="triangle" style="top: 50%; left: 70%; border-bottom-color: #8b5cf6;"></div>
  <div class="triangle" style="top: 65%; left: 20%; border-bottom-color: #0ea5e9;"></div>
  <div class="triangle" style="top: 70%; left: 60%; border-bottom-color: #f43f5e;"></div>
  
</div>

    <div class="feature-box">
      <h3>✔ Control de inventario</h3>
      <p>Organiza productos, stock y movimientos en tiempo real.</p>
    </div>
    <div class="feature-box">
      <h3>✔ Reportes inteligentes</h3>
      <p>Estadísticas claras y útiles para tomar decisiones rápidas.</p>
    </div>
    <div class="feature-box">
      <h3>✔ Facturación legal</h3>
      <p>Cumple con la DIAN y automatiza tus comprobantes.</p>
    </div>
    <div class="feature-box">
      <h3>✔ Multiusuario & roles</h3>
      <p>Controla permisos y seguridad con perfiles adaptados.</p>
    </div>
  </section>

  <a href="{{ route('Register') }}" class="floating-cta">Crear cuenta gratis</a>

  <footer>
    &copy; {{ date('Y') }} POS Pro | Desarrollado por CR. Todos los derechos reservados.
  </footer>
  <script>
  function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('active');
  }
</script>
</body>
</html>
