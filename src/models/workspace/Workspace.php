<?php

namespace models\workspace;

class Workspace
{
private int $id;
private int $id_user;
private int $id_device;
private string $name;
private array $workspace_bytes;

    /**
     * @param int $id
     * @param int $id_user
     * @param int $id_device
     * @param string $name
     * @param array $workspace_bytes
     */
    public function __construct(int $id, int $id_user, int $id_device, string $name, array $workspace_bytes)
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_device = $id_device;
        $this->name = $name;
        $this->workspace_bytes = $workspace_bytes;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getWorkspaceBytes(): array
    {
        return $this->workspace_bytes;
    }

    /**
     * @param array $workspace_bytes
     */
    public function setWorkspaceBytes(array $workspace_bytes): void
    {
        $this->workspace_bytes = $workspace_bytes;
    }



}