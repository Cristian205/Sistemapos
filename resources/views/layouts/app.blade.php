<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard POS Pro</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-dark: #0f172a;
      --bg-light: #f1f5f9;
      --bg-white: #ffffff;
      --primary: #38bdf8;
      --text-dark: #1e293b;
      --text-muted: #64748b;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }

    body {
      display: flex;
      height: 100vh;
      background-color: var(--bg-light);
    }

    .sidebar {
      width: 250px;
      background: var(--bg-dark);
      color: white;
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
    }

    .sidebar h1 {
      font-size: 24px;
      color: var(--primary);
      margin-bottom: 30px;
      text-align: center;
    }

    .sidebar ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .sidebar ul li {
      padding: 12px 15px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .sidebar ul li:hover,
    .sidebar ul li.active {
      background-color: #1e293b;
    }

    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .header {
      background: var(--bg-white);
      height: 60px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 30px;
      border-bottom: 1px solid #e2e8f0;
      position: relative;
    }

    .header .welcome {
      font-size: 18px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .header .user {
      display: flex;
      align-items: center;
      gap: 15px;
      position: relative;
    }

    .header .user img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      cursor: pointer;
    }

    .dropdown {
      position: absolute;
      right: 0;
      top: 60px;
      background: white;
      color: #1e293b;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 180px;
      display: none;
      flex-direction: column;
      z-index: 100;
    }

    .dropdown a,
    .dropdown button {
      padding: 10px 16px;
      text-align: left;
      text-decoration: none;
      color: inherit;
      background: none;
      border: none;
      font-size: 14px;
      cursor: pointer;
    }

    .dropdown a:hover,
    .dropdown button:hover {
      background-color: #f1f5f9;
    }

    .content {
      flex: 1;
      padding: 30px;
      overflow-y: auto;
    }

    .content h2 {
      font-size: 24px;
      margin-bottom: 20px;
      color: var(--text-dark);
    }

    .dashboard-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: var(--bg-white);
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.06);
      display: flex;
      flex-direction: column;
      gap: 10px;
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card .icon {
      font-size: 30px;
      color: var(--primary);
    }

    .card .value {
      font-size: 28px;
      font-weight: bold;
      color: var(--text-dark);
    }

    .card .label {
      font-size: 16px;
      color: var(--text-muted);
    }

    @media(max-width: 768px) {
      .sidebar {
        display: none;
      }

      body {
        flex-direction: column;
      }

      .header {
        padding: 10px 20px;
      }

      .content {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h1>POS Pro</h1>
    <ul>
      <li class="active"><i class="fas fa-chart-line"></i> Dashboard</li>
      <li><i class="fas fa-shopping-cart"></i> Ventas</li>
      <li><i class="fas fa-box"></i> Inventario</li>
      <li><i class="fas fa-cash-register"></i> Caja</li>
      <li><i class="fas fa-users"></i> Clientes</li>
      <li><i class="fas fa-truck"></i> Proveedores</li>
      <li><i class="fas fa-cog"></i> Configuración</li>
    </ul>
  </div>

  <div class="main">
    <div class="header">
      <div class="welcome">Hola, {{ $user->name }}</div>
      <div class="user">
        <span>{{ $user->email }}</span>
        <img src="https://i.pravatar.cc/150?u={{ $user->id }}" alt="avatar" onclick="toggleDropdown()" />
        <div id="userDropdown" class="dropdown">
          <a href="/perfil">Perfil</a>
          <a href="/configuracion">Configuración</a>
          <form method="POST" action="">
            @csrf
            <button type="submit">Cerrar sesión</button>
          </form>
        </div>
      </div>
    </div>

    <div class="content">
      <h2>Panel de Control</h2>
      <div class="dashboard-cards">
        <div class="card">
          <div class="icon"><i class="fas fa-dollar-sign"></i></div>
          <div class="value">$18,450</div>
          <div class="label">Ventas del día</div>
        </div>
        <div class="card">
          <div class="icon"><i class="fas fa-box-open"></i></div>
          <div class="value">125</div>
          <div class="label">Productos en stock</div>
        </div>
        <div class="card">
          <div class="icon"><i class="fas fa-user-friends"></i></div>
          <div class="value">47</div>
          <div class="label">Clientes registrados</div>
        </div>
        <div class="card">
          <div class="icon"><i class="fas fa-cash-register"></i></div>
          <div class="value">$2,305</div>
          <div class="label">En caja</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById("userDropdown");
      dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
    }

    // Cierra el menú si haces clic fuera
    window.addEventListener('click', function(e) {
      const avatar = document.querySelector('.user img');
      const dropdown = document.getElementById('userDropdown');
      if (!avatar.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
      }
    });
  </script>
</body>
</html>
