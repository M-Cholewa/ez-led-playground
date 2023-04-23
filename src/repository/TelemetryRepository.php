<?php

use models\DeviceTelemetry;

require_once 'Repository.php';
require_once __DIR__ . '/../models/DeviceTelemetry.php';

class TelemetryRepository extends Repository
{
    public function getTelemetry($id_device): ?DeviceTelemetry
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.devices_telemetry WHERE id_device = :id_device
        ');
        $stmt->bindParam(':id_device', $id_device, PDO::PARAM_INT);
        $stmt->execute();

        $telemetry = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$telemetry) {
            return null;
        }

        return new DeviceTelemetry(
            $telemetry['id_device'],
            $telemetry['board_temperature'],
            $telemetry['power_w'],
            $telemetry['uptime_s'],
            $telemetry['fw_ver'],
            $telemetry['status'],
            $telemetry['update_ts'],
        );
    }
}