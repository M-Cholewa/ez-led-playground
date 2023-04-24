<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Workspace.php';
require_once __DIR__ . '/../models/Device.php';
require_once __DIR__ . '/../models/DeviceWorkspace.php';

class DeviceWorkspaceRepository extends Repository
{
    public function get_ByUserId(int $id_user): array
    {
        try {
            $stmt = $this->database->connect()->prepare('
            SELECT 
                    d.*,
                   w.id as workspace_id,
                   w.id_user as workspace_id_user,
                   w.id_device as workspace_id_device,
                   w.name  as workspace_name 
               FROM workspaces w 
                LEFT JOIN devices d on d.id = w.id_device
            where w.id_user = :id_user
            ');
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $deviceWorkspaces = array();

            foreach ($rows as $row) {
                $device = new \models\Device($row["id"], $row["name"], $row["width"],
                    $row["height"], $row["api_key"], null);
                $workspace = new \models\Workspace($row["workspace_id"], $row["workspace_id_user"],
                    $row["workspace_id_device"], $row["workspace_name"], array());

                $deviceWorkspaces[] = new \models\DeviceWorkspace($device, $workspace);
            }

            return $deviceWorkspaces;
        } catch (PDOException $e) {
            return array();
        }
    }

    public function get_AsAssoc_ByUserIdByName(int $id_user, string $workspace_name): array
    {
        try {
            $searchString = '%' . strtolower($workspace_name) . '%';

            $stmt = $this->database->connect()->prepare('
            SELECT 
                    d.*,
                   w.id as workspace_id,
                   w.id_user as workspace_id_user,
                   w.id_device as workspace_id_device,
                   w.name  as workspace_name 
               FROM workspaces w 
                LEFT JOIN devices d on d.id = w.id_device
            where w.id_user = :id_user
                AND LOWER(w.name) LIKE :workspace_name
            ');
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':workspace_name', $searchString, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return array();
        }
    }
}