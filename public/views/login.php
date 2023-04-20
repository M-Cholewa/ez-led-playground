<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>LEDs play - login</title>
</head>
<body>
<div class="container">
    <div class="login-container">
        <div class="logo">
            <img src="public/img/logo.svg" alt="logo"/>
        </div>
        <div class="login-form-container">
            <form action="login" method="POST">
                <input type="text" name="email" placeholder="email@email.com"/>
                <input type="password" name="password" placeholder="password"/>
                <button class="login-btn" type="submit">Login</button>
            </form>
            <div class="message">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message)
                        echo $message;
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
