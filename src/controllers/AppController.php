<?php

use models\admin\User;

class AppController
{
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function redirect(string $route)
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/{$route}");
    }

    protected function redirectLogin()
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }

    protected function isJsonContentType(): bool
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        return $contentType === "application/json";
    }

    protected function getJsonDecoded(): array
    {
        if ($this->isJsonContentType()) {
            $content = trim(file_get_contents("php://input"));
            return json_decode($content, true);
        }
        return [];
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/' . $template . '.php';
        $output = 'File not found';

        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }

    protected function loginUser(User $user)
    {
        session_set_cookie_params(30 * 60, "/");
        session_start();
        $_SESSION['user'] = serialize($user);
    }

    protected function logoutUser(){
        session_start();
        unset($_SESSION['user']);
    }

    protected function getUser():?User
    {
        return unserialize($_SESSION['user']);
    }
}