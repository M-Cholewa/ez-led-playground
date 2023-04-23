<?php

use models\Workspace;

require_once 'Repository.php';
require_once __DIR__ . '/../models/Workspace.php';

class WorkspaceRepository extends Repository
{
    public function get_ByUserId(int $id_user): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM workspaces where id_user = :id_user
        ');

        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $workspaces = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($workspaces as $workspace) {

            $result[] = new Workspace(
                $workspace['id'],
                $workspace['id_user'],
                $workspace['id_device'],
                $workspace['name'],
                $workspace['workspace_bytes']
            );
        }

        return $result;
    }

    public function get_AsAssoc_ByUserIdByName(int $id_user, string $workspace_name): array
    {
        $searchString = '%' . strtolower($workspace_name) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM workspaces where id_user = :id_user 
            AND
            LOWER(workspaces.name) LIKE : workspace_name
        ');

        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':workspace_name', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_ById(int $id_workspace): ?Workspace
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.workspaces WHERE id = :workspace_id
        ');
        $stmt->bindParam(':workspace_id', $id_workspace, PDO::PARAM_INT);
        $stmt->execute();

        $workspace = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$workspace) {
            return null;
        }

        return new Workspace(
            $workspace['id'],
            $workspace['id_user'],
            $workspace['id_device'],
            $workspace['name'],
            $workspace['workspace_bytes']
        );
    }

    public function getCount_ByUserId(int $id_user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT count(id_user) FROM workspaces where id_user = :id_user
        ');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $workspaceCount = $stmt->fetch(PDO::FETCH_COLUMN);

        if (!$workspaceCount) {
            return 0;
        }

        return $workspaceCount;
    }

    public function remove_byId(int $id_workspace): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('
                    DELETE FROM workspaces WHERE id = :id_workspace
        ');
            $stmt->bindParam(':id_workspace', $id_workspace, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function create(Workspace $workspace): bool
    {
        try {

            $stmt = $this->database->connect()->prepare('
            INSERT INTO workspaces (id_user, id_device, name, workspace_bytes) 
            VALUES (?, ?, ?, ?)
        ');
            $stmt->execute([
                $workspace->getIdUser(),
                $workspace->getIdDevice(),
                $workspace->getName(),
                $workspace->getWorkspaceBytes()
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateWorkspaceBytes_ById($id_workspace, $workspace_bytes): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('
            UPDATE workspaces SET workspace_bytes = :workspace_bytes where id = :id_workspace
        ');
            $stmt->bindParam(':id_workspace', $id_workspace, PDO::PARAM_INT);
            $stmt->bindParam(':workspace_bytes', $workspace_bytes, PDO::PARAM_LOB);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function hasUserWorkspace(int $id_workspace, int $id_user): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT count(id_user) FROM workspaces where id=:id_workspace and id_user = :id_user
        ');
        $stmt->bindParam(':id_device', $id_workspace, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $count = $stmt->fetch(PDO::FETCH_COLUMN);

        if (!$count) {
            return false;
        }

        return $count > 0;
    }
}