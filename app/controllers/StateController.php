<?php

class StateController
{
    private $conn;


    function __construct($dbconn)
    {
        $this->conn = $dbconn;
    }

    public function getState()
    {
        $stmt = $this->conn->prepare("SELECT id, stateName FROM states");
        $stmt->execute();
        $result = $stmt->get_result();
        $states = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $states;
    }
}

// Create a new mysqli connection
$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
// Check connection
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}


$init = new StateController($dbconn);
$states = $init->getState();
