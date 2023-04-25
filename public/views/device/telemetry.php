<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/telemetry.css"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>LEDs play - telemetry</title>
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
                <h1>Telemetry</h1>
            </div>
            <div class="base-section-body">
                <div class="telemetry-container">
                    <div class="telemetry-grid">
                        <?php if (isset($device) && isset($telemetry)): ?>
                        <div>Target</div>
                        <div><?= $device->getName(); ?>, <?= $device->getWidth(); ?>x<?= $device->getHeight(); ?></div>
                        <div>Status</div>
                        <div><?= $telemetry->getStatus(); ?></div>
                        <div>Updated At</div>
                        <div><?= $telemetry->getUpdateTs(); ?></div>
                        <div>Board Temperature</div>
                        <div><?= $telemetry->getBoardTemperature(); ?> °C</div>
                        <div>Power draw</div>
                        <div><?= $telemetry->getPowerW(); ?> Wat</div>
                        <div>Uptime</div>
                        <div><?= $telemetry->getUptimeS(); ?> s</div>
                        <div>Firmware version</div>
                        <div><?= $telemetry->getFwVer(); ?></div>
                        <?php else:?>
                        <div>Brak dostępnej telemetrii, poczekaj na aktualizację</div>
                        <?php endif; ?>

                    </div>
                    <button class="base-btn base-container-bottom-btn">
                        <a href="devices">
                            Show devices
                        </a>
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
    <script src="public/js/base.js"></script>
</footer>
</html>
