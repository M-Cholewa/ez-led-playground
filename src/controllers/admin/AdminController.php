<?php


use models\admin\User;
use repository\admin\UserRepository;

require_once __DIR__ .'/../../controllers/SafeController.php';
require_once __DIR__ . '/../../models/admin/User.php';
require_once __DIR__ . '/../../repository/admin/UserRepository.php';

class AdminController extends SafeController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct(true);
        $this->userRepository = new UserRepository();
    }

    public function users()
    {
        $loggedUserId = $this->getUser()->getId();
        $users = $this->userRepository->get();
        $this->render("admin/users", ["users" => $users, "loggedUserId" => $loggedUserId]);
    }

    public function newUser()
    {
        if ($this->isGet()) {
            $this->render("admin/newUser");
            return;
        }

        if ($this->isPost()) {
            $email = (is_string($_POST['email']) ? $_POST['email'] : "");
            $password = (is_string($_POST['password']) ? $_POST['password'] : "");
            $is_admin = (is_string($_POST['is_admin']) && $_POST['is_admin'] == "on");

            $emailLength = strlen($email);
            $passwordLength = strlen($password);

            if ($emailLength > 255 || $emailLength <= 1) {
                $this->render('admin/newUser', ["message" => "Wrong user email"]);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->render('admin/newUser', ["message" => "Wrong user email"]);
                return;
            }

            if ($passwordLength > 255 || $passwordLength <= 1) {
                $this->render('admin/newUser', ["message" => "Wrong password length"]);
                return;
            }

            $user_email_exists = $this->userRepository->get_ByEmail($email) != null;

            if ($user_email_exists) {
                $this->render('admin/newUser', ["message" => "User already exists"]);
                return;
            }

            $password = password_hash($password, PASSWORD_DEFAULT);

            $user = new User($email, $password, $is_admin, -1);

            if ($this->userRepository->create($user)) {
                $this->redirect("users");
            } else {
                $this->render('admin/newUser', ["message" => "Something went wrong, try again"]);
            }

            return;
        }

        $this->redirect("newUser");
    }

    public function searchUser()
    {
        $searchValue = $this->getJsonDecoded()['search'];

        header('Content-type: application/json');

        if ($searchValue === null) {
            $searchValue = "";
        }

        $usersByEmail = $this->userRepository->get_AsAssoc_ByEmail($searchValue);

        http_response_code(200);

        echo json_encode($usersByEmail);

    }

    public function removeUser()
    {
        header('Content-type: application/json');
        $user_id = $this->getJsonDecoded()['id_user'];

        if ($user_id === null) {
            http_response_code(400);
            return;
        }

        $logged_user_id = $this->getUser()->getId();

        if ($logged_user_id === $user_id) {
            http_response_code(400);
            return;
        }

        if ($this->userRepository->remove_byId($user_id)) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
    }

}