<?php
require_once '../models/Database.php';
require_once '../models/Model.php';
require_once '../helper/Authentication.php';

class NewPropertyController
{
    private $conn;

    public function __construct($dbconn)
    {
        $this->conn = new Model($dbconn);
    }

    public function createProperty()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_SESSION["agent_id"];
            $title = $_POST["title"];
            $price = trim($_POST["price"]);
            // Validating price
            $numericPrice = str_replace("NGN", "", $price);
            $numericPrice = trim($numericPrice);
            $numericPrice = (float) $numericPrice;
            $numericPrice = filter_var($numericPrice, FILTER_VALIDATE_FLOAT);
            if ($numericPrice === false) {
                $this->error("Invalid price entered.");
                return;
            }
            $status = $_POST["propertyStatus"];
            $state = $_POST["state"];
            $lga = $_POST["lga"];
            $address = $_POST["address"];
            $kitchen_number = $_POST["kitchenNumber"];
            $bath_number = $_POST["bathNumber"];
            $bed_number = $_POST["bedNumber"];
            $description = $_POST["propertyDescription"];

            $this->conn->beginTransaction();

            try {
                // Insert property data into the `properties` table
                $propertyId = $this->conn->newProperty($id, $title, $numericPrice, $status, $state, $lga, $address, $kitchen_number, $bath_number, $bed_number, $description);

                // File Upload
                $uploadDir = "../../public/images/";
                $imagePaths = [];

                for ($i = 1; $i <= 4; $i++) {
                    $imageKey = 'image' . $i;

                    if (isset($_FILES[$imageKey]) && $_FILES[$imageKey]['error'] == 0) {
                        $imageTmpPath = $_FILES[$imageKey]['tmp_name'];
                        $imageName = basename($_FILES[$imageKey]['name']);
                        $imageSize = $_FILES[$imageKey]['size'];
                        $imageType = pathinfo($imageName, PATHINFO_EXTENSION);

                        $validImageTypes = ['jpg', 'jpeg', 'png', 'gif'];
                        if (in_array(strtolower($imageType), $validImageTypes)) {
                            $newImageName = uniqid() . '.' . $imageType;
                            $imagePath = $uploadDir . $newImageName;
                            $imagePathDB = $newImageName;

                            if (move_uploaded_file($imageTmpPath, $imagePath)) {
                                $imagePaths[] = $imagePath;

                                // Insert image path into the `property_images` table
                                $this->conn->addPropertyImage($propertyId, $imagePathDB);
                            } else {
                                throw new Exception("Failed to upload Image");
                            }
                        } else {
                            throw new Exception("Invalid Image Type");
                        }
                    }
                }

                $this->conn->commit();
                $this->success("New Property created successfully");
            } catch (Exception $e) {
                $this->conn->rollback();
                $this->error($e->getMessage());
            }
        } else {
            $this->error("Invalid Request Method.");
        }
    }

    private function success($successMessage)
    {
        header("Location: ../views/users/agents/createProperty.php?success=" . urlencode($successMessage));
        exit();
    }

    private function error($errorMessage)
    {
        header("Location: ../views/users/agents/createProperty.php?error=" . urlencode($errorMessage));
        exit();
    }
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}

$init = new NewPropertyController($dbconn);
$init->createProperty();
