<?php

class AjaxController extends Controller
{
    public function getLGAs(): void
    {
        header('Content-Type: application/json');
        $stateId = (int) ($_POST['stateId'] ?? 0);
        if (!$stateId) {
            echo json_encode([]);
            exit();
        }
        $lgas = (new LocationModel($this->db()))->getLGAsByState($stateId);
        echo json_encode($lgas);
        exit();
    }
}
