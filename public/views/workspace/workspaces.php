<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/base.css"/>
    <link
        rel="stylesheet"
        type="text/css"
        href="public/css/workspaces.css"
    />
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>LEDs play - workspaces</title>
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
            <li><a href="devices">Devices</a></li>
            <li><a href="#" class="active">Workspaces</a></li>
            <li><a href="admin">Admin</a></li>
        </ul>
        <ul>
            <li><a href="logout">Log out</a></li>
        </ul>
    </nav>
    <main>
        <section class="base-section">
            <div class="base-section-header">
                <h1>Workspaces</h1>
                <button class="base-btn">
                    <a href="newWorkspace">
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
                        <th>Target name</th>
                        <th>Width</th>
                        <th>Height</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($deviceWorkspaces)): ?>
                        <?php foreach ($deviceWorkspaces as $deviceWorkspace): ?>

                            <?php

                            $workspace = $deviceWorkspace->getWorkspace();
                            $device = $deviceWorkspace->getDevice();

                            ?>
                            <tr>
                                <td>
                                    <div class="base-table-first-cell">
                                        <span my-role="workspace-name"><?= $workspace->getName() ?></span>
                                        <a>
                                            <i class="fa-solid fa-circle-chevron-down"></i>
                                            <i class="fa-solid fa-circle-chevron-up"></i>
                                        </a>
                                    </div>
                                </td>
                                <td my-role="device-name"><?= $device->getName() ?></td>
                                <td my-role="device-width"><?= $device->getWidth() ?></td>
                                <td my-role="device-height"><?= $device->getHeight() ?></td>
                                <td>
                                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                                    <a href="draw?id_device=<?= $device->getId(); ?>" my-role="device-telemetry-href">
                                        <i class="fa-solid fa-paintbrush"></i>
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
            <i class="fa-solid fa-plus"></i>
        </button>
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

<template>

</template>

</html>
