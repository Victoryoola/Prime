<?php

class Auth
{
    public static function requireAgent(): void
    {
        if (!isset($_SESSION['agent_id'])) {
            header('Location: ' . URLROOT . '/Estate/login');
            exit();
        }
    }

    public static function isAgent(): bool
    {
        return isset($_SESSION['agent_id']);
    }

    public static function agentId(): ?int
    {
        return $_SESSION['agent_id'] ?? null;
    }

    public static function agentName(): ?string
    {
        return $_SESSION['agent_name'] ?? null;
    }
}
