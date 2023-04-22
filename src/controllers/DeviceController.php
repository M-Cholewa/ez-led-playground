<?php

require_once 'SafeController.php';

class DeviceController extends SafeController
{
    public function devices()
    {
        $this->render('device/devices');
    }
}