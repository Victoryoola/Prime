<?php
require_once '../config/config.php';
require_once '../helper/Authentication.php';
require_once '../models/Model.php';
class DeleteImageController
{
    private $conn;

    public function __construct($dbconn)
    {
        $this->conn = new Model($dbconn);
    }

    public function deleteImage()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['imageID'];

            $this->conn->beginTransaction();

            try {
                $this->conn->deleteImage($id);

                $this->conn->commit();
                $this->success("Image deleted successfully");
            } catch (Exception $e) {
                $this->conn->rollback();

                error_log($e->getMessage());


                $this->error("Could not delete Image");
            }
        }
    }

    private function success($successMessage)
    {
        $propertyID = $_POST["propertyID"];
        header("Location: ../views/users/agents/editProperty.php?id=" . $propertyID . "&status=success&message=" . urlencode($successMessage));
        exit();
    }

    private function error($errorMessage)
    {
        $propertyID = $_POST["propertyID"];
        header("Location: ../views/users/agents/editProperty.php?id=" . $propertyID . "&status=error&message=" . urlencode($errorMessage));
        exit();
    }
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}

$init = new DeleteImageController($dbconn);
$init->deleteImage();