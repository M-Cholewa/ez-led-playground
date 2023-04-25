<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/base.css"/>
    <link
        rel="stylesheet"
        type="text/css"
        href="public/css/new-device-success.css"
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
        <img src="public/img/logo.svg"/>
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
                <h1>Device created successfully</h1>
            </div>
            <div class="base-section-body nds-container">
                <div class="nds-api-message">
                    <p>Your API Key is:</p>
                    <?php if (isset($api_key)): ?>
                        <h1><?=$api_key ?></h1>
                    <?php endif; ?>
                </div>
                <button class="base-btn base-container-bottom-btn">
                    <a href="devices">
                        Show devices
                    </a>
                </button>
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
    <script src="public/js/base.js"></script>
</footer>
</html>
