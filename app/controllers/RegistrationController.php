<?php
require_once '../models/Database.php';
require_once '../models/Model.php';
class RegistrationController
{
    private $conn;

    private $agentModel;

    public function __construct($dbconn)
    {
        $this->conn = $dbconn;
        $this->agentModel = new Model($this->conn);
    }


    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $formType = $_POST["form_type"];

            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $password = $_POST["password"];
            $status = $_POST["status"];
            $role = $_POST["role"];
            $confirmPassword = $_POST["confirmP"];


            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $this->error($formType, "Only letters and white space allowed in name");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error($formType, "Invalid email format");
            } elseif (strlen($password) < 8) {
                $this->error($formType, "Password must be at least 8 characters");
            } elseif (!preg_match("/[a-z]/i", $password)) {
                $this->error($formType, "Password must contain at least one letter");
            } elseif (!preg_match("/[0-9]/", $password)) {
                $this->error($formType, "Password must contain at least one number");
            } elseif ($password != $confirmPassword) {
                $this->error($formType, "Passwords do not match");
            } else {
                if ($this->agentModel->emailExists($email)) {
                    $this->error($formType, "Email already exists");
                } else {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    if ($formType === "agent") {
                        $id_type = $_POST["id_type"];
                        $id = $_FILES["upload_id"];
                        $cv = $_FILES["upload_cv"];

                        if ($this->fileError($cv) || $this->fileError($id)) {
                            $this->error($formType, "Upload CV and ID");
                        }

                        $id_path = $this->uploadID($id);
                        $cv_path = $this->uploadCV($cv);

                        if ($cv_path && $id_path) {
                            if ($this->agentModel->newAgent($name, $email, $phone, $password_hash, $status, $role, $id_type, $id_path, $cv_path)) {
                                $this->success($formType);
                            } else {
                                $this->error($formType, "Agent could not sign up");
                            }
                        } else {
                            $this->error($formType, "Error in uploading files");
                        }
                    } elseif ($formType === "buyer") {
                        $cv = $_FILES["upload_cv"];

                        if ($this->fileError($cv)) {
                            $this->error($formType, "Upload a CV");
                        }

                        $cv_path = $this->uploadCV($cv);

                        if ($cv_path) {
                            if ($this->agentModel->newUser($name, $email, $phone, $password_hash, $status, $role, $cv_path)) {
                                $this->success($formType);
                            } else {
                                $this->error($formType, "User could not sign up");
                            }
                        } else {
                            $this->error($formType, "Error in uploading files");
                        }

                    }
                }

            }
        }
    }

    private function uploadCV($file)
    {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/Estate/public/agents/cvFiles/";
        if (!is_dir($filePath)) {
            mkdir($filePath, 0777, true);
        }

        $targetFile = $filePath . basename($file['name']);

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        }
        return false;
    }

    private function uploadID($file)
    {
        $filePath = $_SERVER['DOCUMENT_ROOT'] .
            "/Estate/public/agents/idFiles/";
        if (!is_dir($filePath)) {
            mkdir($filePath, 0777, true);
        }

        $targetFile = $filePath . basename($file['name']);

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        }
        return false;
    }

    private function fileError($file)
    {
        return $file["error"] !== UPLOAD_ERR_OK && $file["error"] !== UPLOAD_ERR_NO_FILE;
    }

    private function error($formType, $errorMessage)
    {
        if ($formType == "agent") {
            header("Location: ../views/users/agents/agent.php?error=" . urlencode($errorMessage));
        } else {
            header("Location: ../views/users/buyers/user.php?error=" . urlencode($errorMessage));
        }
        exit();

    }

    private function success($formType)
    {
        if ($formType == "agent") {
            header("Location: ../views/users/agents/agent.php?success=1");
        } else {
            header("Location: ../views/users/buyers/user.php?success=1");
        }
        exit();
    }

}
$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($dbconn->connect_error) {
    die("Connection Failed: " . $dbconn->connect_error);
}

$agentControl = new RegistrationController($dbconn);
$agentControl->register();