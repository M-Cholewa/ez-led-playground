<?php

use models\Workspace;

require_once 'SafeController.php';
require_once __DIR__ . '/../models/Workspace.php';
require_once __DIR__ . '/../models/DeviceWorkspace.php';
require_once __DIR__ . '/../repository/WorkspaceRepository.php';
require_once __DIR__ . '/../repository/DeviceRepository.php';
require_once __DIR__ . '/../utility/Utility.php';

class WorkspaceController extends SafeController
{
    private WorkspaceRepository $workspaceRepository;
    private DeviceRepository $deviceRepository;

    public function __construct()
    {
        parent::__construct();
        $this->workspaceRepository = new WorkspaceRepository();
        $this->deviceRepository = new DeviceRepository();
    }

    public function workspaces()
    {
        $id_user = $this->getUser()->getId();

        $workspaces = $this->workspaceRepository->get_ByUserId($id_user);

        $ids_device = array();

        foreach ($workspaces as $workspace) {
            $ids_device[] = $workspace->getIdDevice();
        }

        $devicesByIds = $this->deviceRepository->get_ByIds($ids_device);
        $deviceWorkspaces = array();

        foreach ($workspaces as $workspace) {
            $device = \Utility\Utility::findObjectById($workspace->getIdDevice(), $devicesByIds);
            $deviceWorkspaces[] = new \models\DeviceWorkspace($device, $workspace);
        }

        $this->render('workspace/workspaces', ["deviceWorkspaces" => $deviceWorkspaces]);
    }

    public function newWorkspace()
    {
        if (!$this->isGet()) {
            $this->redirect("workspaces");
            return;
        }

        $this->render('workspace/newWorkspace');
    }

    public function removeWorkspace()
    {
        header('Content-type: application/json');
        $id_workspace = $this->getJsonDecoded()['id_workspace'];

        if ($id_workspace === null) {
            http_response_code(400);
            return;
        }

        $user_id = $this->getUser()->getId();

        if (!$this->workspaceRepository->hasUserWorkspace($id_workspace, $user_id)) {
            http_response_code(401);
            return;
        }

        if ($this->workspaceRepository->remove_byId($id_workspace)) {
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

        $workspacesByName = $this->workspaceRepository->get_AsAssoc_ByUserIdByName($user_id, $searchValue);

        http_response_code(200);

        echo json_encode($workspacesByName);
    }

    public function createWorkspace()
    {
        if (!$this->isPost()) {
            $this->redirect("newWorkspace");
            return;
        }

        $id_user = $this->getUser()->getId();

        $workspaceCount = $this->workspaceRepository->getCount_ByUserId($id_user);

        if ($workspaceCount >= 3) {
            $this->render('workspace/newWorkspace', ["message" => "You can only have 3 workspaces"]);
            return;
        }

        $workspace_name = (is_string($_POST['workspace_name']) ? $_POST['workspace_name'] : "");
        $id_device = (is_numeric($_POST['id_device']) ? (int)$_POST['id_device'] : 0);

        $nameLength = strlen($workspace_name);

        if ($nameLength > 255 || $nameLength <= 1) {
            $this->render('workspace/newWorkspace', ["message" => "Wrong workspace name"]);
            return;
        }

        if (!$this->deviceRepository->hasUserDevice($id_device, $id_user)) {
            $this->render('workspace/newWorkspace', ["message" => "You don't own this device"]);
            return;
        }


        $workspace = new Workspace(-1, $id_user, $id_device, $workspace_name, array());

        if ($this->workspaceRepository->create($workspace)) {
            $this->redirect("workspaces");
        } else {
            $this->render('workspace/newWorkspace', ["message" => "Something went wrong, try again"]);
        }

    }
}