<?php

namespace repository\workspace;

use models\workspace\DeviceWorkspace;
use PDO;
use PDOException;
use Repository;

require_once __DIR__ .'/../../repository/Repository.php';
require_once __DIR__ . '/../../models/workspace/Workspace.php';
require_once __DIR__ . '/../../models/device/Device.php';
require_once __DIR__ . '/../../models/workspace/DeviceWorkspace.php';

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
                $device = new \models\device\Device($row["id"], $row["name"], $row["width"],
                    $row["height"], $row["api_key"], null);
                $workspace = new \models\workspace\Workspace($row["workspace_id"], $row["workspace_id_user"],
                    $row["workspace_id_device"], $row["workspace_name"], array());

                $deviceWorkspaces[] = new DeviceWorkspace($device, $workspace);
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

    public function upsert_workspace($id_workspace, $id_device): bool
    {
        try {

            $stmt = $this->database->connect()->prepare('
               INSERT INTO devices_active_workspaces (id_device, id_workspace) VALUES (:id_device, :id_workspace)
                ON CONFLICT (id_device)
                DO UPDATE SET id_workspace = excluded.id_workspace;
            ');
            $stmt->bindParam(':id_device', $id_device, PDO::PARAM_INT);
            $stmt->bindParam(':id_workspace', $id_workspace, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function get_ByWorkspaceId(int $id_workspace): ?DeviceWorkspace
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
            where w.id = :id_workspace
            ');
            $stmt->bindParam(':id_workspace', $id_workspace, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            $device = new \models\device\Device($row["id"], $row["name"], $row["width"],
                $row["height"], $row["api_key"], null);
            $workspace = new \models\workspace\Workspace($row["workspace_id"], $row["workspace_id_user"],
                $row["workspace_id_device"], $row["workspace_name"], array());

            return new \models\workspace\DeviceWorkspace($device, $workspace);
        } catch (PDOException $e) {
            return null;
        }
    }
}