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
    <title>LEDs play - new workspace</title>
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
            <li><a href="workspaces" class="active">Workspaces</a></li>
            <li><a href="users">Admin</a></li>
        </ul>
        <ul>
            <li><a href="logout">Log out</a></li>
        </ul>
    </nav>
    <main>
        <section class="base-section">
            <div class="base-section-header">
                <h1>New workspace</h1>
            </div>
            <div class="base-section-body">
                <form class="nif-form" method="post" action="newWorkspace">
                    <div class="nif-input-container">
                        <!-- nif -> new item form -->
                        <div class="nif-item">Workspace name</div>
                        <div class="nif-item nif-item-input">
                            <input
                                type="text"
                                class="nif-input"
                                placeholder="Workspace 1"
                                name="workspace_name"
                            />
                        </div>
                        <div class="nif-item">Target device</div>
                        <div class="nif-item nif-item-input">
                            <select id="target" class="nif-input"
                                    name="id_device">

                                <?php if (isset($devices)): ?>
                                    <?php foreach ($devices as $user_device): ?>
                                        <option value="<?= $user_device->getId() ?>">
                                            <?= $user_device->getName() ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="nif-create-group">
                        <?php if (isset($message)): ?>
                            <p>Workspace creation failed:</p>
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
    <script src="public/js/workspace/newWorkspace.js"></script>
    <script src="public/js/base.js"></script>
</footer>
</html>
