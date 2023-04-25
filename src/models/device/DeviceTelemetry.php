<?php

namespace models\device;

class DeviceTelemetry
{
private int $id_device;
private float $board_temperature;
private float $power_w;
private int $uptime_s;
private string $fw_ver;
private int $status;
private int $update_ts;

    /**
     * @param int $id_device
     * @param float $board_temperature
     * @param float $power_w
     * @param int $uptime_s
     * @param string $fw_ver
     * @param int $status
     * @param int $update_ts
     */
    public function __construct(int $id_device, float $board_temperature, float $power_w, int $uptime_s, string $fw_ver, int $status, int $update_ts)
    {
        $this->id_device = $id_device;
        $this->board_temperature = $board_temperature;
        $this->power_w = $power_w;
        $this->uptime_s = $uptime_s;
        $this->fw_ver = $fw_ver;
        $this->status = $status;
        $this->update_ts = $update_ts;
    }

    /**
     * @return int
     */
    public function getIdDevice(): int
    {
        return $this->id_device;
    }

    /**
     * @param int $id_device
     */
    public function setIdDevice(int $id_device): void
    {
        $this->id_device = $id_device;
    }

    /**
     * @return float
     */
    public function getBoardTemperature(): float
    {
        return $this->board_temperature;
    }

    /**
     * @param float $board_temperature
     */
    public function setBoardTemperature(float $board_temperature): void
    {
        $this->board_temperature = $board_temperature;
    }

    /**
     * @return float
     */
    public function getPowerW(): float
    {
        return $this->power_w;
    }

    /**
     * @param float $power_w
     */
    public function setPowerW(float $power_w): void
    {
        $this->power_w = $power_w;
    }

    /**
     * @return int
     */
    public function getUptimeS(): int
    {
        return $this->uptime_s;
    }

    /**
     * @param int $uptime_s
     */
    public function setUptimeS(int $uptime_s): void
    {
        $this->uptime_s = $uptime_s;
    }

    /**
     * @return string
     */
    public function getFwVer(): string
    {
        return $this->fw_ver;
    }

    /**
     * @param string $fw_ver
     */
    public function setFwVer(string $fw_ver): void
    {
        $this->fw_ver = $fw_ver;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getUpdateTs(): int
    {
        return $this->update_ts;
    }

    /**
     * @param int $update_ts
     */
    public function setUpdateTs(int $update_ts): void
    {
        $this->update_ts = $update_ts;
    }



}