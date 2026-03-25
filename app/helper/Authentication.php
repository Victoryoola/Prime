<?php
session_start();

// Check if agent_name session variable is set
if (!isset($_SESSION['agent_name']) && !isset($_SESSION["agent_id"])) {
    header("Location: ../views/users/agents/login.php");
    exit();
}
// echo $_SESSION["agent_id"];
