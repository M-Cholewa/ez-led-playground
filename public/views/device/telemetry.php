<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="public/../css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/../css/base.css" />
    <link rel="stylesheet" type="text/css" href="public/../css/telemetry.css" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LEDs play - telemetry</title>
  </head>
  <body>
    <div class="base-container">
      <section class="base-overlay" id="base-overlay"></section>
      <header>
        <img src="public/../img/logo.svg" />
        <a id="base-drawer-btn">
          <i class="fa-solid fa-bars"></i>
        </a>
      </header>
      <nav>
        <img src="public/../img/logo.svg" />
        <ul class="base-menu">
          <li><a href="#" class="active">Devices</a></li>
          <li><a href="workspaces">Workspaces</a></li>
          <li><a href="admin">Admin</a></li>
        </ul>
        <ul>
          <li><a href="logout">Log out</a></li>
        </ul>
      </nav>
      <main>
        <section class="base-section">
          <div class="base-section-header">
            <h1>Telemetry</h1>
          </div>
          <div class="base-section-body">
            <div class="telemetry-container">
              <div class="telemetry-grid">
                <div>Target</div>
                <div>Device 1, led matrix 48x32</div>
                <div>Status</div>
                <div>Running</div>
                <div>Updated At</div>
                <div>03.04.2023, 13:06:24</div>
                <div>Board Temperature</div>
                <div>25 °C</div>
                <div>Power draw</div>
                <div>7 Wat</div>
                <div>Uptime</div>
                <div>2d 1h 3m 7s</div>
                <div>Firmware version</div>
                <div>1.13.0_beta</div>
              </div>
              <button class="base-btn base-container-bottom-btn">
                Show devices
              </button>
            </div>
          </div>
        </section>
      </main>
    </div>
  </body>

  <footer>
    <script
      src="https://kit.fontawesome.com/c1c8d29a2a.js"
      crossorigin="anonymous"
    ></script>
    <script src="public/../js/base.js"></script>
  </footer>
</html>
