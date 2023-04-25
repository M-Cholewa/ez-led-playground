<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/base.css"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>LEDs play - devices</title>
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
            <li><a href="#" class="active">Devices</a></li>
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
                <h1>Your devices</h1>
                <button class="base-btn">
                    <a href="newDevice">
                        New
                    </a>
                </button>
            </div>
            <div class="base-section-body">
                <input
                    id="base-search-input"
                    type="text"
                    class="search"
                    placeholder="Search"
                />
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Width</th>
                        <th>Height</th>
                        <th>API key</th>
                        <th>Active workspace</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($devices)): ?>
                        <?php foreach ($devices as $device): ?>
                            <tr device-id="<?= $device->getId(); ?>">
                                <td>
                                    <div class="base-table-first-cell">
                                        <?= $device->getName(); ?>
                                        <a>
                                            <i class="fa-solid fa-circle-chevron-down"></i>
                                            <i class="fa-solid fa-circle-chevron-up"></i>
                                        </a>
                                    </div>
                                </td>
                                <td><?= $device->getWidth(); ?></td>
                                <td><?= $device->getHeight(); ?></td>
                                <td><?= $device->getApiKey(); ?></td>
                                <td><?= $device->getActiveWorkspaceName(); ?></td>
                                <td>
                                    <a href="#" class="device-remove-btn"><i class="fa-solid fa-trash"></i></a>
                                    <a href="telemetry?id_device=<?= $device->getId(); ?>">
                                        <i class="fa-solid fa-circle-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <button class="base-floating-btn">
            <a href="newDevice">
                <i class="fa-solid fa-plus"></i>
            </a>
        </button>
    </main>
</div>
</body>

<footer>
    <script
        src="https://kit.fontawesome.com/c1c8d29a2a.js"
        crossorigin="anonymous"
    ></script>
    <script src="public/js/devices.js" defer></script>
    <script src="public/js/base.js" defer></script>
</footer>

<template id="device-row-template">
    <tr device-id="-1">
        <td>
            <div class="base-table-first-cell">
                <span my-role="device-name"></span>
                <a>
                    <i class="fa-solid fa-circle-chevron-down"></i>
                    <i class="fa-solid fa-circle-chevron-up"></i>
                </a>
            </div>
        </td>
        <td my-role="device-width"></td>
        <td my-role="device-height"></td>
        <td my-role="device-api-key"></td>
        <td my-role="device-active-workspace-name"></td>
        <td>
            <a href="#" class="device-remove-btn"><i class="fa-solid fa-trash"></i></a>
            <a my-role="device-telemetry-href">
                <i class="fa-solid fa-circle-arrow-right"></i>
            </a>
        </td>
    </tr>
</template>

</html>
