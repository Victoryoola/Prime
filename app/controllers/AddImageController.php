<?php
require_once '../config/config.php';
require_once '../helper/Authentication.php';
require_once '../models/Model.php';
class AddImageController
{
    private $conn;

    public function __construct($dbconn)
    {
        $this->conn = new Model($dbconn);
    }

    public function addImage()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
            $property_id = $_POST["propertyID"];
            $imageFile = $_FILES['image'];

            $this->conn->beginTransaction();
            try {
                // Start transaction
                $this->conn->beginTransaction();

                // Handle file upload if a new image was selected
                if ($imageFile['error'] == UPLOAD_ERR_OK) {
                    // Generate a new file name (optional, to avoid conflicts)
                    $imageName = basename($imageFile['name']);
                    $targetDir = '../../public/images/';
                    $targetFile = $targetDir . $imageName;

                    // Move the uploaded file to the designated directory
                    if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
                        // Call the model function to update the image URL in the database
                        $this->conn->addNewImage($imageName, $property_id);

                    } else {
                        throw new Exception('File upload failed.');
                    }
                }

                // Commit the transaction if everything goes well
                $this->conn->commit();

                // Redirect to success page or show success message
                $this->success("Image updated successfully");

            } catch (Exception $e) {
                // Rollback the transaction in case of error
                $this->conn->rollBack();

                // Log the error and show an error message (optional)
                error_log($e->getMessage());

                $this->error("Error uploading file");

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

$init = new AddImageController($dbconn);
$init->addImage();