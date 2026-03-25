<?php
class ViewPropertyController
{
    private $conn;

    function __construct($dbconn)
    {
        $this->conn = $dbconn;
    }

    public function getProperties()
    {
        if (isset($_SESSION["agent_id"])) {
            $agentID = $_SESSION["agent_id"];

            $stmt = $this->conn->prepare
            ("SELECT 
                properties.id, 
                properties.propertyTitle, 
                properties.price, 
                properties.propertyStatus, 
                states.stateName AS state_name, 
                lga.lga AS lga_name,
                properties.address, 
                properties.kitchen_number, 
                properties.bath_number, 
                properties.bed_number,
                (SELECT file_url FROM property_documents WHERE property_documents.property_id = properties.id LIMIT 1) AS file_url
                FROM properties
                JOIN states ON properties.state = states.id
                JOIN lga ON properties.lga = lga.id
                WHERE agent_id = ?
                ");

            $stmt->bind_param("i", $agentID);
            $stmt->execute();
            $result = $stmt->get_result();
            $properties = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $properties;
        } else {
            return [];
        }
    }
}
$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
// Check connection
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}

$init = new ViewPropertyController($dbconn);
$properties = $init->getProperties();