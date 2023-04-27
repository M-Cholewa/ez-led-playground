<?php

namespace repository\device;

use models\device\Device;
use PDO;
use PDOException;
use Repository;

require_once __DIR__ .'/../../repository/Repository.php';
require_once __DIR__ . '/../../models/device/Device.php';

class DeviceRepository extends Repository
{
    public function get_ByUserId(int $userId): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
        SELECT
            devices.*,
            workspaces."name" as workspace_name
        FROM
            devices
            INNER JOIN users_devices ON devices."id" = users_devices.id_device
            LEFT JOIN devices_active_workspaces as DAW ON devices."id" = DAW.id_device
            LEFT JOIN workspaces ON DAW.id_workspace = workspaces."id"
        WHERE
	        users_devices.id_user = :userId
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($devices as $device) {

            $result[] = new Device(
                $device['id'],
                $device['name'],
                $device['width'],
                $device['height'],
                $device['api_key'],
                $device['workspace_name']
            );
        }

        return $result;
    }

    public function get_AsAssoc_ByUserIdByName(int $id_user, string $name): array
    {
        $searchString = '%' . strtolower($name) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT
                devices.*,
                workspaces."name" as workspace_name
            FROM
                devices
                    INNER JOIN users_devices ON devices."id" = users_devices.id_device
                    LEFT JOIN devices_active_workspaces as DAW ON devices."id" = DAW.id_device
                    LEFT JOIN workspaces ON DAW.id_workspace = workspaces."id"
            WHERE
                    users_devices.id_user = :userId
            AND 
                    LOWER(devices.name) LIKE :devName
        ');

        $stmt->bindParam(':userId', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':devName', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_ById(int $device_id): ?Device
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.devices WHERE id = :device_id
        ');
        $stmt->bindParam(':device_id', $device_id, PDO::PARAM_INT);
        $stmt->execute();

        $device = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$device) {
            return null;
        }

        return new Device(
            $device['id'],
            $device['name'],
            $device['width'],
            $device['height'],
            $device['api_key'],
            $device['workspace_name']
        );
    }

    public function getCount_ByUserId(int $id_user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT count(id_device) FROM users_devices where id_user = :id_user
        ');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $deviceCount = $stmt->fetch(PDO::FETCH_COLUMN);

        if (!$deviceCount) {
            return 0;
        }

        return $deviceCount;
    }

    public function remove_byId(int $id_device): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('
                    DELETE FROM devices WHERE id = :id_device
        ');
            $stmt->bindParam(':id_device', $id_device, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    public function create_byUserId(Device $device, int $id_user): bool
    {
        $conn = $this->database->connect();

        try {
            $conn->beginTransaction();

            $stmt = $conn->prepare('
            INSERT INTO devices (name, width, height, api_key)
            VALUES ( ?, ?, ?, ?)
        ');


            $stmt->execute([
                $device->getName(),
                $device->getWidth(),
                $device->getHeight(),
                $device->getApiKey()
            ]);


            $device_id = $conn->lastInsertId();

            if ($device_id == null || $device_id == 0)
                throw new PDOException("err device id");

            $stmt = $conn->prepare('
            INSERT INTO users_devices (id_user, id_device) 
            VALUES (?,?)
        ');

            $stmt->execute([
                $id_user,
                $device_id,
            ]);


            $conn->commit();

            return true;
        } catch (PDOException $e) {

            $conn->rollBack();
            return false;
        }
    }

    public function hasUserDevice(int $id_device, int $id_user): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT count(id_device) FROM users_devices where id_device=:id_device and id_user = :id_user
        ');
        $stmt->bindParam(':id_device', $id_device, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $count = $stmt->fetch(PDO::FETCH_COLUMN);

        if (!$count) {
            return false;
        }

        return $count > 0;
    }
}