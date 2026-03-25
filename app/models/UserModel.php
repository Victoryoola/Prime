<?php

class UserModel
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->conn->prepare('SELECT id, fullName, email, role, password_hash FROM users WHERE email = ?');
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user ?: null;
    }

    public function createAgent(string $name, string $email, string $phone, string $password_hash, string $status, string $role, string $id_type, string $id_path, string $cv_path): bool
    {
        $stmt = $this->conn->prepare('INSERT INTO users (fullName, email, phone, password_hash, status, role, id_type, id_path, cv_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("sssssssss", $name, $email, $phone, $password_hash, $status, $role, $id_type, $id_path, $cv_path);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function createBuyer(string $name, string $email, string $phone, string $password_hash, string $status, string $role, string $cv_path): bool
    {
        $stmt = $this->conn->prepare('INSERT INTO users (fullName, email, phone, password_hash, status, role, cv_path) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("sssssss", $name, $email, $phone, $password_hash, $status, $role, $cv_path);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->conn->prepare("SELECT phone, email, fullName FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user ?: null;
    }
}
