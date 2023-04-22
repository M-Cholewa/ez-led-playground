<?php

use models\User;

require_once 'AppController.php';

class SafeController extends AppController
{

    public function __construct(bool $adminOnly = false)
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            // redirect to login page
            $this->redirectLogin();
        }else{
            if($adminOnly && !$this->getUser()->isAdmin()){
                $this->redirectLogin();
            }
        }
    }

    protected function getUser():?User
    {
        return $_SESSION['user'];
    }

}