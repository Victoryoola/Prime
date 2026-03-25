<?php
class EditPropertyController
{
    private $conn;

    public function __construct($dbconn)
    {
        $this->conn = $dbconn;
    }

    public function editProperty()
    {
        if (isset($_GET['id'])) {
            $propertyID = intval($_GET['id']);

            // Query to fetch property details and associated images
            $stmt = $this->conn->prepare(
                "SELECT
            properties.id,
            properties.propertyTitle,
            properties.price,
            properties.propertyStatus,
            states.stateName AS state_name,
            lga.id AS lga_id,
            lga.lga AS lga_name,
            properties.address,
            properties.kitchen_number,
            properties.bath_number,
            properties.bed_number,
            properties.description,
            property_documents.file_url,
            property_documents.id AS image_id
            FROM properties
            JOIN states ON properties.state = states.id
            JOIN lga ON properties.lga = lga.id
            LEFT JOIN property_documents ON properties.id = property_documents.property_id
            WHERE properties.id = ?"
            );

            $stmt->bind_param("i", $propertyID);
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetching all records
            $propertyDetails = [];
            $propertyImages = [];
            while ($row = $result->fetch_assoc()) {
                // Set property details only once
                if (empty($propertyDetails)) {
                    $propertyDetails = [
                        'id' => $row['id'],
                        'propertyTitle' => $row['propertyTitle'],
                        'price' => $row['price'],
                        'propertyStatus' => $row['propertyStatus'],
                        'state_name' => $row['state_name'],
                        'lga_id' => $row['lga_id'],
                        'lga_name' => $row['lga_name'],
                        'address' => $row['address'],
                        'kitchen_number' => $row['kitchen_number'],
                        'bath_number' => $row['bath_number'],
                        'bed_number' => $row['bed_number'],
                        'description' => $row['description'],
                    ];
                }

                // Collect each image URL
                if (!empty($row['file_url'])) {
                    $propertyImages[] = [
                        'image_id' => $row['image_id'],
                        'file_url' => $row['file_url']
                    ];
                }
            }
            $stmt->close();

            return [
                'propertyDetails' => $propertyDetails,
                'propertyImages' => $propertyImages
            ];
        } else {
            return [
                'propertyDetails' => [],
                'propertyImages' => []
            ];
        }
    }

}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}

$init = new EditPropertyController($dbconn);
$propertyData = $init->editProperty();
$propertyDetails = $propertyData['propertyDetails'];
$propertyImages = $propertyData['propertyImages'];