<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="public/../css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/../css/base.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="public/../css/new-item-form.css"
    />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LEDs play - new device</title>
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
            <h1>New device</h1>
          </div>
          <div class="base-section-body">
            <form class="nif-form">
              <div class="nif-input-container">
                <!-- nif -> new item form -->
                <div class="nif-item">Device name</div>
                <div class="nif-item nif-item-input">
                  <input type="text" class="nif-input" placeholder="Device 1" />
                </div>
                <div class="nif-item">LED matrix width</div>
                <div class="nif-item nif-item-input">
                  <input type="number" class="nif-input" placeholder="48" />
                </div>
                <div class="nif-item">LED matrix height</div>
                <div class="nif-item nif-item-input">
                  <input type="number" class="nif-input" placeholder="32" />
                </div>
              </div>
              <div class="nif-create-group">
                <p>Device creation failed:</p>
                <p>You can only have 3 devices</p>
                <button class="base-btn base-container-bottom-btn">
                  Create
                </button>
              </div>
            </form>
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
