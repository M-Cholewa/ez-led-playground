<?php

use models\Device;

require_once 'SafeController.php';
require_once __DIR__ . '/../models/Device.php';
require_once __DIR__ . '/../repository/DeviceRepository.php';
require_once __DIR__ . '/../repository/TelemetryRepository.php';

class DeviceController extends SafeController
{
    private DeviceRepository $deviceRepository;
    private TelemetryRepository $telemetryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->deviceRepository = new DeviceRepository();
        $this->telemetryRepository = new TelemetryRepository();
    }


    public function devices()
    {
        $user = $this->getUser();

        $devices = $this->deviceRepository->get_ByUserId($user->getId());
        $this->render('device/devices', ["devices" => $devices]);
    }

    public function telemetry()
    {

        if (!$this->isGet()) {
            $this->redirect("devices");
            return;
        }

        $user = $this->getUser();
        $id_device = $_GET['id_device'];

        if ($id_device == null) {
            $this->redirect("devices");
            return;
        }

        $hasUserDevice = $this->deviceRepository->hasUserDevice($id_device, $user->getId());

        if (!$hasUserDevice) {
            $this->redirectLogin();
            return;
        }

        $device = $this->deviceRepository->get_ById($id_device);
        $telemetry = $this->telemetryRepository->getTelemetry($id_device);

        $this->render('device/telemetry', ["telemetry" => $telemetry, "device" => $device]);
    }

    public function newDevice()
    {
        if (!$this->isGet()) {
            $this->redirect("devices");
            return;
        }

        $this->render('device/newDevice');
    }

    public function removeDevice()
    {
        header('Content-type: application/json');
        $device_id = $this->getJsonDecoded()['id_device'];

        if ($device_id === null) {
            http_response_code(400);
            return;
        }

        $user_id = $this->getUser()->getId();

        if (!$this->deviceRepository->hasUserDevice($device_id, $user_id)) {
            http_response_code(401);
            return;
        }

        if ($this->deviceRepository->remove_byId($device_id)) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
    }

    public function search()
    {
        $searchValue = $this->getJsonDecoded()['search'];

        header('Content-type: application/json');

        if ($searchValue === null) {
            $searchValue = "";
        }

        $user_id = $this->getUser()->getId();

        $devicesByName = $this->deviceRepository->get_AsAssoc_ByUserIdByName($user_id, $searchValue);

        http_response_code(200);

        echo json_encode($devicesByName);

    }

    public function createDevice()
    {
        if (!$this->isPost()) {
            $this->redirect("newDevice");
            return;
        }

        $user_id = $this->getUser()->getId();

        $deviceCount = $this->deviceRepository->getCount_ByUserId($user_id);

        if ($deviceCount >= 3) {
            $this->render('device/newDevice', ["message" => "You can only have 3 devices"]);
            return;
        }

        $name = (is_string($_POST['name']) ? $_POST['name'] : "");
        $width = (is_numeric($_POST['width']) ? (int)$_POST['width'] : 0);
        $height = (is_numeric($_POST['height']) ? (int)$_POST['height'] : 0);

        if ($width == 0 || $height == 0) {
            $this->render('device/newDevice', ["message" => "Bad width/height"]);
            return;
        }

        if ($width * $height > 2000) {
            $this->render('device/newDevice', ["message" => "Max 2000 pixels"]);
            return;
        }

        $nameLength = strlen($name);
        if ($nameLength > 255 || $nameLength <= 1) {
            $this->render('device/newDevice', ["message" => "Wrong name"]);
            return;
        }

        $api_key = uniqid('apk_', true);

        $device = new Device(-1, $name, $width, $height, $api_key, null);

        if ($this->deviceRepository->create_byUserId($device, $user_id)) {
            $this->render('device/newDeviceSuccess', ["api_key" => $api_key]);
        } else {
            $this->render('device/newDevice', ["message" => "Something went wrong, try again"]);
        }

    }

}