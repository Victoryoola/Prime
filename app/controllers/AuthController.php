<?php

class AuthController extends Controller
{
    private UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel($this->db());
    }

    public function showLogin(): void
    {
        $this->view('users/buyers/login', ['pageTitle' => 'Login']);
    }

    public function login(): void
    {
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $user = $this->users->findByEmail($email);

        if (!$user) {
            $this->redirect(URLROOT . '/Estate/login?error=' . urlencode('User does not exist'));
        }

        if (!password_verify($password, $user['password_hash'])) {
            $this->redirect(URLROOT . '/Estate/login?error=' . urlencode('Incorrect password'));
        }

        if ($user['role'] === 'agent') {
            $_SESSION['agent_id']   = $user['id'];
            $_SESSION['agent_name'] = $user['fullName'];
            $this->redirect(URLROOT . '/Estate/agent/dashboard');
        } elseif ($user['role'] === 'buyer') {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['fullName'];
            $this->redirect(URLROOT . '/Estate/');
        } else {
            $this->redirect(URLROOT . '/Estate/login?error=' . urlencode('Unknown role'));
        }
    }

    public function showRegisterAgent(): void
    {
        $this->view('users/agents/agent', ['pageTitle' => 'Agent Signup']);
    }

    public function registerAgent(): void
    {
        $this->handleRegistration('agent');
    }

    public function showRegisterBuyer(): void
    {
        $this->view('users/buyers/user', ['pageTitle' => 'User Signup']);
    }

    public function registerBuyer(): void
    {
        $this->handleRegistration('buyer');
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect(URLROOT . '/Estate/');
    }

    private function handleRegistration(string $formType): void
    {
        $name            = trim($_POST['name'] ?? '');
        $email           = trim($_POST['email'] ?? '');
        $phone           = trim($_POST['phone'] ?? '');
        $password        = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmP'] ?? '';
        $status          = $_POST['status'] ?? 'pending';
        $role            = $_POST['role'] ?? $formType;

        $errorUrl   = URLROOT . '/Estate/' . ($formType === 'agent' ? 'register/agent' : 'register/buyer');
        $successUrl = $errorUrl . '?success=1';

        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $this->redirect($errorUrl . '?error=' . urlencode('Only letters and spaces allowed in name'));
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect($errorUrl . '?error=' . urlencode('Invalid email format'));
        }
        if (strlen($password) < 8) {
            $this->redirect($errorUrl . '?error=' . urlencode('Password must be at least 8 characters'));
        }
        if (!preg_match("/[a-z]/i", $password)) {
            $this->redirect($errorUrl . '?error=' . urlencode('Password must contain at least one letter'));
        }
        if (!preg_match("/[0-9]/", $password)) {
            $this->redirect($errorUrl . '?error=' . urlencode('Password must contain at least one number'));
        }
        if ($password !== $confirmPassword) {
            $this->redirect($errorUrl . '?error=' . urlencode('Passwords do not match'));
        }
        if ($this->users->findByEmail($email)) {
            $this->redirect($errorUrl . '?error=' . urlencode('Email already exists'));
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        if ($formType === 'agent') {
            $id_type = $_POST['id_type'] ?? '';
            $cvDir   = $_SERVER['DOCUMENT_ROOT'] . '/Estate/public/agents/cvFiles/';
            $idDir   = $_SERVER['DOCUMENT_ROOT'] . '/Estate/public/agents/idFiles/';

            try {
                $cv_path = $this->uploadFile($_FILES['upload_cv'], $cvDir);
                $id_path = $this->uploadFile($_FILES['upload_id'], $idDir);
            } catch (Exception $e) {
                $this->redirect($errorUrl . '?error=' . urlencode($e->getMessage()));
            }

            if ($this->users->createAgent($name, $email, $phone, $password_hash, $status, $role, $id_type, $id_path, $cv_path)) {
                $this->redirect($successUrl);
            } else {
                $this->redirect($errorUrl . '?error=' . urlencode('Agent could not be registered'));
            }
        } else {
            $cvDir = $_SERVER['DOCUMENT_ROOT'] . '/Estate/public/buyers/cvFiles/';
            try {
                $cv_path = $this->uploadFile($_FILES['upload_cv'], $cvDir);
            } catch (Exception $e) {
                $this->redirect($errorUrl . '?error=' . urlencode($e->getMessage()));
            }

            if ($this->users->createBuyer($name, $email, $phone, $password_hash, $status, $role, $cv_path)) {
                $this->redirect($successUrl);
            } else {
                $this->redirect($errorUrl . '?error=' . urlencode('User could not be registered'));
            }
        }
    }

    private function uploadFile(array $file, string $dir): string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('File upload error. Please upload a valid file.');
        }
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $targetFile = $dir . basename($file['name']);
        if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
            throw new Exception('Could not save uploaded file.');
        }
        return $targetFile;
    }
}
