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
    <title>LEDs play - new workspace</title>
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
          <li><a href="#">Device</a></li>
          <li><a href="#" class="active">Workspace</a></li>
          <li><a href="#">Admin</a></li>
        </ul>
        <ul>
          <li><a href="#">Log out</a></li>
        </ul>
      </nav>
      <main>
        <section class="base-section">
          <div class="base-section-header">
            <h1>New workspace</h1>
          </div>
          <div class="base-section-body">
            <form class="nif-form">
              <div class="nif-input-container">
                <!-- nif -> new item form -->
                <div class="nif-item">Workspace name</div>
                <div class="nif-item nif-item-input">
                  <input
                    type="text"
                    class="nif-input"
                    placeholder="Workspace 1"
                  />
                </div>
                <div class="nif-item">Target device</div>
                <div class="nif-item nif-item-input">
                  <select name="target" id="target" class="nif-input">
                    <option value="1">Device 1</option>
                    <option value="2">Device 2</option>
                    <option value="3">Device 3</option>
                  </select>
                </div>
              </div>
              <div class="nif-create-group">
                <p>Workspace creation failed:</p>
                <p>you can only have 3 workspaces</p>
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