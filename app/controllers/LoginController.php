<?php
require_once '../models/Database.php';
require_once '../models/Model.php';
class LoginController
{
    private $conn;
    private $userModel;

    public function __construct($dbconn)
    {
        $this->conn = $dbconn;
        $this->userModel = new Model($this->conn);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);


            $user = $this->userModel->emailExists($email);

            if ($user) {
                if ($user["role"] === "agent") {
                    if (password_verify($password, $user["password_hash"])) {
                        session_start();
                        $_SESSION["agent_name"] = $user["fullName"];
                        $_SESSION["agent_id"] = $user["id"];
                        header("Location: ../views/users/agents/Dashboard.php");
                        exit();
                    } else {
                        $this->error("Incorrect Password! Try Again");
                    }
                } elseif ($user["role"] === "buyer") {
                    if (password_verify($password, $user["password_hash"])) {
                        session_start();
                        $_SESSION["user_name"] = $user["fullName"];
                    } else {
                        $this->error("Incorrect Password! Try Again");
                    }
                } else {
                    $this->error("User not signed up yet");
                }
            } else {
                $this->error("User does not exist");
            }
        }
    }

    public function processLogin()
    {
        // Check if agent_name session variable is set
        if (!isset($_SESSION['agent_name']) && !isset($_SESSION["agent_id"])) {
            header("Location: ../views/users/agents/login.php");
            exit();
        }
    }

    private function error($errorMessage)
    {
        header("Location: ../views/users/buyers/login.php?error=" . urlencode($errorMessage));
        exit();
    }
}
$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}

$userControl = new LoginController($dbconn);
$userControl->login();