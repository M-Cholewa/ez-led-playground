<?php

use models\admin\User;
use repository\admin\UserRepository;

require_once 'AppController.php';
require_once __DIR__ . '/../models/admin/User.php';
require_once __DIR__ . '/../repository/admin/UserRepository.php';

class SecurityController extends AppController
{
    private int $SESSION_DURATION_S = 3 * 24 * 60 * 60; // 3 days

    public function login()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->get_ByEmail($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render("login", ['messages' => ['User with this email does not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render("login", ['messages' => ['Wrong password!']]);
        }

        $this->loginUser($user);
        $this->redirect("devices");
    }

    public function logout()
    {
        $this->logoutUser();
        $this->redirectLogin();
    }


}