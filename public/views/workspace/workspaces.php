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
        <a href="devices">
            <img src="public/img/logo.svg"/>
        </a>
        <ul class="base-menu">
            <li><a href="devices">Devices</a></li>
            <li><a href="#" class="active">Workspaces</a></li>
            <li><a href="users">Admin</a></li>
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
                            <tr workspace-id="<?= $workspace->getId() ?>">
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
                                    <a href="#" class="workspace-remove-btn"><i class="fa-solid fa-trash"></i></a>
                                    <a href="draw?id_workspace=<?= $workspace->getId(); ?>" my-role="draw-href">
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
            <a href="newWorkspace">
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
    <script src="public/js/workspaces.js"></script>
    <script src="public/js/base.js"></script>
</footer>

<template id="workspace-row-template">
    <tr workspace-id="-1">
        <td>
            <div class="base-table-first-cell">
                <span my-role="workspace-name"></span>
                <a>
                    <i class="fa-solid fa-circle-chevron-down"></i>
                    <i class="fa-solid fa-circle-chevron-up"></i>
                </a>
            </div>
        </td>
        <td my-role="device-name"></td>
        <td my-role="device-width"></td>
        <td my-role="device-height"></td>
        <td>
            <a href="#" class="workspace-remove-btn"><i class="fa-solid fa-trash"></i></a>
            <a my-role="draw-href">
                <i class="fa-solid fa-paintbrush"></i>
            </a>
        </td>
    </tr>
</template>

</html>
