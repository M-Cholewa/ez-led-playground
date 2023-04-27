<?php

namespace repository\admin;

use models\admin\User;
use PDO;
use PDOException;
use Repository;

require_once __DIR__ .'/../../repository/Repository.php';
require_once __DIR__ . '/../../models/admin/User.php';

class UserRepository extends Repository
{

    public function get_ByEmail(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['is_admin'],
            $user['id']
        );
    }

    public function get_AsAssoc_ByEmail(string $email): array
    {
        $searchString = '%' . strtolower($email) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE LOWER(email) LIKE :email
        ');
        $stmt->bindParam(':email', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users
        ');
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($users == null)
            return array();

        $result = [];

        foreach ($users as $user) {
            $result[] = new User($user["email"], $user["password"], $user["is_admin"], $user["id"]);
        }

        return $result;
    }

    public function create(User $user): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('
            INSERT INTO users(email, password, is_admin) VALUES (:email,:password,:isAdmin)
        ');

            $email = $user->getEmail();
            $password = $user->getPassword();
            $isAdmin = $user->isAdmin();

            $stmt->bindParam(':email', $email, PDO::PARAM_INT);
            $stmt->bindParam(':password', $password, PDO::PARAM_INT);
            $stmt->bindParam(':isAdmin', $isAdmin, PDO::PARAM_BOOL);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function remove_byId(int $id_user): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('
                    DELETE FROM users WHERE id = :id_user
        ');
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}