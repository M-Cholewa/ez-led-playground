<?php

use models\Workspace;

require_once 'SafeController.php';
require_once __DIR__ . '/../models/Workspace.php';
require_once __DIR__ . '/../models/DeviceWorkspace.php';
require_once __DIR__ . '/../repository/WorkspaceRepository.php';
require_once __DIR__ . '/../repository/DeviceRepository.php';
require_once __DIR__ . '/../repository/DeviceWorkspaceRepository.php';
require_once __DIR__ . '/../utility/Utility.php';

class WorkspaceController extends SafeController
{
    private WorkspaceRepository $workspaceRepository;
    private DeviceRepository $deviceRepository;
    private DeviceWorkspaceRepository $deviceWorkspaceRepository;

    public function __construct()
    {
        parent::__construct();
        $this->workspaceRepository = new WorkspaceRepository();
        $this->deviceRepository = new DeviceRepository();
        $this->deviceWorkspaceRepository = new DeviceWorkspaceRepository();
    }

    public function workspaces()
    {
        $id_user = $this->getUser()->getId();

        $deviceWorkspaces = $this->deviceWorkspaceRepository->get_ByUserId($id_user);

        $this->render('workspace/workspaces', ["deviceWorkspaces" => $deviceWorkspaces]);
    }

    public function newWorkspace()
    {

        $id_user = $this->getUser()->getId();
        $user_devices = $this->deviceRepository->get_ByUserId($id_user);

        if ($this->isGet()) {
            $this->render('workspace/newWorkspace', ["devices" => $user_devices]);
            return;
        }

        if ($this->isPost()) {
            $id_user = $this->getUser()->getId();

            $workspaceCount = $this->workspaceRepository->getCount_ByUserId($id_user);

            if ($workspaceCount >= 3) {
                $this->render('workspace/newWorkspace',
                    ["message" => "You can only have 3 workspaces",
                        "devices" => $user_devices]);
                return;
            }

            $workspace_name = (is_string($_POST['workspace_name']) ? $_POST['workspace_name'] : "");
            $id_device = (is_numeric($_POST['id_device']) ? (int)$_POST['id_device'] : 0);

            $nameLength = strlen($workspace_name);

            if ($nameLength > 255 || $nameLength <= 1) {
                $this->render('workspace/newWorkspace', ["message" => "Wrong workspace name",
                    "devices" => $user_devices]);
                return;
            }

            if (!$this->deviceRepository->hasUserDevice($id_device, $id_user)) {
                $this->render('workspace/newWorkspace', ["message" => "You don't own this device",
                    "devices" => $user_devices]);
                return;
            }

            $workspace = new Workspace(-1, $id_user, $id_device, $workspace_name, array());

            if ($this->workspaceRepository->create($workspace)) {
                $this->redirect("workspaces");
            } else {
                $this->render('workspace/newWorkspace', ["message" => "Something went wrong, try again",
                    "devices" => $user_devices]);
            }

            return;
        }

        $this->redirect("newWorkspace");

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

    public function searchWorkspace()
    {
        $searchValue = $this->getJsonDecoded()['search'];

        header('Content-type: application/json');

        if ($searchValue === null) {
            $searchValue = "";
        }

        $user_id = $this->getUser()->getId();

        $workspacesByName = $this->deviceWorkspaceRepository->get_AsAssoc_ByUserIdByName($user_id, $searchValue);

        http_response_code(200);

        echo json_encode($workspacesByName);
    }

    public function draw()
    {
        if (!$this->isGet()) {
            $this->redirect("workspaces");
            return;
        }

        $id_workspace = (is_numeric($_GET["id_workspace"]) ? (int)$_GET["id_workspace"] : 0);
        $id_user = $this->getUser()->getId();

        if (!$this->workspaceRepository->hasUserWorkspace($id_workspace, $id_user)) {
            $this->redirectLogin();
            return;
        }

        $deviceWorkspace = $this->deviceWorkspaceRepository->get_ByWorkspaceId($id_workspace);

        $this->render('workspace/draw', ["deviceWorkspace" => $deviceWorkspace]);
    }

    public function updateWorkspaceBytes()
    {
        header('Content-type: application/json');

        if (!$this->isJsonContentType()) {
            http_response_code(400);
            return;
        }

        $id_workspace = $this->getJsonDecoded()['id_workspace'];
        $workspace_bytes = $this->getJsonDecoded()['workspace_bytes'];
        $setAsActive = $this->getJsonDecoded()['setAsActive'];

        $id_user = $this->getUser()->getId();

        if ($id_workspace == null || $workspace_bytes == null) {
            http_response_code(400);
            return;
        }

        if (!$this->workspaceRepository->hasUserWorkspace($id_workspace, $id_user)) {
            http_response_code(401);
            return;
        }

        $workspace = $this->workspaceRepository->get_ById($id_workspace);
        $workspace->setWorkspaceBytes($workspace_bytes);
        $result = $this->workspaceRepository->updateWorkspaceBytes_ById($id_workspace, $workspace_bytes);

        if ($result) {
            if ($setAsActive) {
                $result = $this->deviceWorkspaceRepository->upsert_workspace($id_workspace, $workspace->getIdDevice());
            }
        }

        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
    }

    public function getWorkspaceBytes()
    {
        header('Content-type: application/json');

        if (!$this->isJsonContentType()) {
            http_response_code(400);
            return;
        }

        $id_workspace = $this->getJsonDecoded()['id_workspace'];
        $id_user = $this->getUser()->getId();

        if ($id_workspace == null) {
            http_response_code(400);
            return;
        }

        if (!$this->workspaceRepository->hasUserWorkspace($id_workspace, $id_user)) {
            http_response_code(401);
            return;
        }

        $workspace = $this->workspaceRepository->get_ById($id_workspace);

        if ($workspace == null) {
            http_response_code(400);
            return;
        }

        http_response_code(200);
        $wb = $workspace->getWorkspaceBytes();
        echo json_encode($wb);
    }


}