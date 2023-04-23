<?php

namespace models;

class Device
{
    private int $id;
    private string $name;
    private int $width;
    private int $height;
    private string $api_key;
    private ?string $active_workspace_name;

    /**
     * @param int $id
     * @param string $name
     * @param int $width
     * @param int $height
     * @param string $api_key
     * @param string|null $active_workspace_name
     */
    public function __construct(int $id, string $name, int $width, int $height, string $api_key, ?string $active_workspace_name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->width = $width;
        $this->height = $height;
        $this->api_key = $api_key;
        $this->active_workspace_name = $active_workspace_name;
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
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->api_key;
    }

    /**
     * @param string $api_key
     */
    public function setApiKey(string $api_key): void
    {
        $this->api_key = $api_key;
    }

    /**
     * @return string|null
     */
    public function getActiveWorkspaceName(): ?string
    {
        return $this->active_workspace_name;
    }

    /**
     * @param string|null $active_workspace_name
     */
    public function setActiveWorkspaceName(?string $active_workspace_name): void
    {
        $this->active_workspace_name = $active_workspace_name;
    }


}