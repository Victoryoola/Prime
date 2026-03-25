<?php
$agentID = $_SESSION['agent_id'];

class AgentDetailsController
{
    private $conn;

    public function __construct($dbconn)
    {
        $this->conn = $dbconn;
    }

    public function getAgentDetails($agentID)
    {
        if (isset($_SESSION['agent_id'])) {
            $stmt = $this->conn->prepare("SELECT phone, email FROM users WHERE id = ?");
            $stmt->bind_param('i', $agentID);
            $stmt->execute();
            $result = $stmt->get_result();
            $agentDetails = $result->fetch_assoc();
            $stmt->close();

            return $agentDetails;

        }
    }
}

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}

$init = new AgentDetailsController($dbconn);
$agentDetails = $init->getAgentDetails($agentID);