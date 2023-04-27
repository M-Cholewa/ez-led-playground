<?php

namespace models\workspace;

use models\device\Device;

require_once __DIR__ . '/../../models/workspace/Workspace.php';
require_once __DIR__ . '/../../models/device/Device.php';

class DeviceWorkspace
{
    private ?Device $device;
    private ?Workspace $workspace;

    /**
     * @param Device|null $device
     * @param Workspace|null $workspace
     */
    public function __construct(?Device $device, ?Workspace $workspace)
    {
        $this->device = $device;
        $this->workspace = $workspace;
    }

    /**
     * @return Device|null
     */
    public function getDevice(): ?Device
    {
        return $this->device;
    }

    /**
     * @param Device|null $device
     */
    public function setDevice(?Device $device): void
    {
        $this->device = $device;
    }

    /**
     * @return Workspace|null
     */
    public function getWorkspace(): ?Workspace
    {
        return $this->workspace;
    }

    /**
     * @param Workspace|null $workspace
     */
    public function setWorkspace(?Workspace $workspace): void
    {
        $this->workspace = $workspace;
    }



}