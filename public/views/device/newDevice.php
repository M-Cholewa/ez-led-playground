<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/base.css"/>
    <link
        rel="stylesheet"
        type="text/css"
        href="public/css/new-item-form.css"
    />
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>LEDs play - new device</title>
</head>
<body>
<div class="base-container">
    <section class="base-overlay" id="base-overlay"></section>
    <header>
        <img src="public/img/logo.svg"/>
        <a id="base-drawer-btn">
            <i class="fa-solid fa-bars"></i>
        </a>
    </header>
    <nav>
        <a href="devices">
            <img src="public/img/logo.svg"/>
        </a>
        <ul class="base-menu">
            <li><a href="devices" class="active">Devices</a></li>
            <li><a href="workspaces">Workspaces</a></li>
            <li><a href="users">Admin</a></li>
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
                <form class="nif-form" action="newDevice" method="post">
                    <div class="nif-input-container">
                        <!-- nif -> new item form -->
                        <div class="nif-item">Device name</div>
                        <div class="nif-item nif-item-input">
                            <input type="text" class="nif-input" placeholder="Device 1" name="name"/>
                        </div>
                        <div class="nif-item">LED matrix width</div>
                        <div class="nif-item nif-item-input">
                            <input type="number" class="nif-input" placeholder="48" name="width"/>
                        </div>
                        <div class="nif-item">LED matrix height</div>
                        <div class="nif-item nif-item-input">
                            <input type="number" class="nif-input" placeholder="32" name="height"/>
                        </div>
                    </div>
                    <div class="nif-create-group">
                        <?php if (isset($message)): ?>
                            <p>Device creation failed:</p>
                            <p><?= $message ?></p>
                        <?php endif ?>
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
    <script src="public/js/device/newDevice.js"></script>
    <script src="public/js/base.js"></script>
</footer>
</html>
