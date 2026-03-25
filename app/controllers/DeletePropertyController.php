<?php
require_once '../config/config.php';

class DeleteProperty
{
    private $conn;

    public function __construct($dbconn)
    {
        $this->conn = $dbconn;
    }

    public function deleteProperty()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propertyID = intval($_POST['property_id']);

            // Start transaction to ensure both deletions happen together
            $this->conn->begin_transaction();

            try {
                // Delete associated images from property_documents
                $stmt1 = $this->conn->prepare('DELETE FROM property_documents WHERE property_id = ?');
                $stmt1->bind_param('i', $propertyID);
                $stmt1->execute();
                $stmt1->close();

                // Delete the property itself
                $stmt2 = $this->conn->prepare("DELETE FROM properties WHERE id = ?");
                $stmt2->bind_param('i', $propertyID);
                $stmt2->execute();
                $stmt2->close();

                // Commit transaction
                $this->conn->commit();

                // Redirect to the viewProperty page with a success message
                header("location: ../views/users/agents/viewProperty.php?deleted=success");
                exit();
            } catch (Exception $e) {
                // Rollback if there is an error
                $this->conn->rollback();
                echo "Error deleting property: " . $e->getMessage();
            }
        }
    }
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}

$init = new DeleteProperty($dbconn);
$init->deleteProperty();
