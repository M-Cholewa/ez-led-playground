<?php

use models\admin\User;

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';

class SafeController extends AppController
{

    public function __construct(bool $adminOnly = false)
    {
        parent::__construct();

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
        return unserialize($_SESSION['user']);
    }

}