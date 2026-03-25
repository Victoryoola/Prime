<?php
require_once '../../../config/config.php'; // Adjust path as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['imageID'])) {
    $imageID = $_POST['imageID'];

    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM property_documents WHERE id = ?");
    if ($stmt->execute([$imageID])) {
        echo json_encode(['status' => 'success', 'message' => 'Image deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete image.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
