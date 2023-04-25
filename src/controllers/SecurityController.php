<?php

use models\User;

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{

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

        if ($user->getPassword() !== $password) {
            return $this->render("login", ['messages' => ['Wrong password!']]);
        }

        $this->storeSessionCookie($user);
        $this->redirect("devices");
    }

    public function logout(){
        session_start();
        unset($_SESSION['user']);
        $this->redirectLogin();
    }

    private function storeSessionCookie(User $user)
    {
        session_start();
        $_SESSION['user'] = serialize($user);
    }
}