<?php

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = APPROOT . '/views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            die("View not found: $view");
        }
        require $viewPath;
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit();
    }

    protected function db(): mysqli
    {
        return Database::getInstance()->getConnection();
    }

    protected function uploadImage(array $file, string $targetDir): string
    {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($ext, $allowed)) {
            throw new Exception("Invalid image type: $ext");
        }
        $newName = uniqid() . '.' . $ext;
        $fullPath = $targetDir . $newName;
        if (!move_uploaded_file($file['tmp_name'], $fullPath)) {
            throw new Exception("Failed to upload image.");
        }
        return $newName;
    }

    protected function parsePrice(string $price): float
    {
        $numeric = str_replace(['NGN', ',', ' '], '', trim($price));
        $value = filter_var((float) $numeric, FILTER_VALIDATE_FLOAT);
        if ($value === false) {
            throw new Exception("Invalid price entered.");
        }
        return $value;
    }
}
