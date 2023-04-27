<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/admin.css"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>LEDs play - Admin - Users</title>
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
            <li><a href="workspaces">Workspaces</a></li>
            <li><a href="#" class="active">Admin</a></li>
        </ul>
        <ul>
            <li><a href="logout">Log out</a></li>
        </ul>
    </nav>
    <main>
        <section class="base-section">
            <div class="base-section-header">
                <h1>Admin - Users</h1>
                <button class="base-btn">
                    <a href="newUser">
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
                        <th>Admin</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if (isset($users) && isset($loggedUserId)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr user-id="<?= $user->getId(); ?>">
                                <td>
                                    <div class="base-table-first-cell">
                                        <span my-role="user-email"><?= $user->getEmail(); ?></span>
                                        <a>
                                            <i class="fa-solid fa-circle-chevron-down"></i>
                                            <i class="fa-solid fa-circle-chevron-up"></i>
                                        </a>
                                    </div>
                                </td>
                                <td my-role="user-isAdmin"><?= $user->isAdmin() ? "true" : "false"; ?></td>
                                <td>
                                    <?php if ($loggedUserId != $user->getId()): ?>
                                        <a href="#" class="user-remove-btn"><i class="fa-solid fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <button class="base-floating-btn">
            <a href="newUser">
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
    <script src="public/js/admin/users.js" defer></script>
    <script src="public/js/base.js" defer></script>
</footer>

<template id="user-row-template">
    <tr user-id="-1">
        <td>
            <div class="base-table-first-cell">
                <span my-role="user-email"></span>
                <a>
                    <i class="fa-solid fa-circle-chevron-down"></i>
                    <i class="fa-solid fa-circle-chevron-up"></i>
                </a>
            </div>
        </td>
        <td my-role="user-isAdmin"></td>
        <td>
            <a href="#" class="user-remove-btn"><i class="fa-solid fa-trash"></i></a>
        </td>
    </tr>
</template>

<?php if (isset($loggedUserId)): ?>
    <section style="display: none" id="hidden-id-user-section" user-id="<?= $loggedUserId ?>"></section>
<?php endif; ?>

</html>
