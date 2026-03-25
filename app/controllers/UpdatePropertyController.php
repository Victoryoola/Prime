<?php
require_once '../config/config.php';
require_once '../models/Model.php';
class UpdateController
{
    private $conn;

    public function __construct($dbconn)
    {
        $this->conn = new Model($dbconn);
    }

    public function updateProperty()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["property_id"];
            $title = $_POST["title"];
            $price = trim($_POST["price"]);
            $status = $_POST["propertyStatus"];
            $state = $_POST["state"];
            $lga = $_POST["lga"];
            $address = $_POST["address"];
            $kitchen_number = $_POST["kitchenNumber"];
            $bath_number = $_POST["bathNumber"];
            $bed_number = $_POST["bedNumber"];
            $description = $_POST["propertyDescription"];

            // Validating price
            $numericPrice = str_replace("NGN", "", $price);
            $numericPrice = trim($numericPrice);
            $numericPrice = (float) $numericPrice;
            $numericPrice = filter_var($numericPrice, FILTER_VALIDATE_FLOAT);
            if ($numericPrice === false) {
                $this->error("Invalid price entered.");
                return;
            }

            // Start transaction
            $this->conn->beginTransaction();

            try {
                // Update the property details
                $this->conn->updateProperty($id, $title, $numericPrice, $status, $state, $lga, $address, $kitchen_number, $bath_number, $bed_number, $description);

                // Commit transaction if successful
                $this->conn->commit();

                // Redirect to a success page or message
                $this->success("Property Updated");
            } catch (Exception $e) {
                // Rollback if there is any failure
                $this->conn->rollback();
                $this->error("Failed to update property: " . $e->getMessage());
            }
        }
    }

    private function success($successMessage)
    {
        header("Location: ../views/users/agents/viewProperty.php?status=success" . urlencode($successMessage));
        exit();
    }

    private function error($errorMessage)
    {
        header("Location: ../views/users/agents/editProperty.php?status=error" . urlencode($errorMessage));
        exit();
    }
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}

$init = new UpdateController($dbconn);
$init->updateProperty();
