<?php
class LGAController
{
    private $conn;

    public function __construct($dbconn)
    {
        $this->conn = $dbconn;
    }

    public function getLGA($stateId)
    {
        $stmt = $this->conn->prepare("SELECT id, lga FROM lga WHERE state_id = ?");
        $stmt->bind_param("i", $stateId);
        $stmt->execute();
        $result = $stmt->get_result();
        $lgas = $result->fetch_all(MYSQLI_ASSOC); // Fetch as an associative array
        $stmt->close();
        return $lgas;
    }
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
// Check connection
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}
// Initialize the controller
$init = new LGAController($dbconn);

if (isset($_POST['stateId'])) {
    $stateId = $_POST['stateId'];
    $lgas = $init->getLGA($stateId);

    echo json_encode($lgas); // Encode the array as a JSON string
    exit;
}

