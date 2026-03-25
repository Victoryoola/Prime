<?php

class ImageController extends Controller
{
    private PropertyModel $properties;

    public function __construct()
    {
        Auth::requireAgent();
        $this->properties = new PropertyModel($this->db());
    }

    public function add(): void
    {
        $propertyId = (int) ($_POST['propertyID'] ?? 0);
        $uploadDir  = $_SERVER['DOCUMENT_ROOT'] . '/Estate/public/images/';

        try {
            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('No image uploaded.');
            }
            $imageName = $this->uploadImage($_FILES['image'], $uploadDir);
            $this->properties->addImage($propertyId, $imageName);
            $this->redirect(URLROOT . '/Estate/agent/properties/' . $propertyId . '/edit?status=success&message=' . urlencode('Image added successfully'));
        } catch (Exception $e) {
            $this->redirect(URLROOT . '/Estate/agent/properties/' . $propertyId . '/edit?status=error&message=' . urlencode($e->getMessage()));
        }
    }

    public function update(): void
    {
        $imageId    = (int) ($_POST['imageID'] ?? 0);
        $propertyId = (int) ($_POST['propertyID'] ?? 0);
        $uploadDir  = $_SERVER['DOCUMENT_ROOT'] . '/Estate/public/images/';

        try {
            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('No image uploaded.');
            }
            $imageName = $this->uploadImage($_FILES['image'], $uploadDir);
            $this->properties->updateImage($imageId, $imageName);
            $this->redirect(URLROOT . '/Estate/agent/properties/' . $propertyId . '/edit?status=success&message=' . urlencode('Image updated successfully'));
        } catch (Exception $e) {
            $this->redirect(URLROOT . '/Estate/agent/properties/' . $propertyId . '/edit?status=error&message=' . urlencode($e->getMessage()));
        }
    }

    public function delete(): void
    {
        $imageId    = (int) ($_POST['imageID'] ?? 0);
        $propertyId = (int) ($_POST['propertyID'] ?? 0);

        try {
            $this->properties->deleteImage($imageId);
            $this->redirect(URLROOT . '/Estate/agent/properties/' . $propertyId . '/edit?status=success&message=' . urlencode('Image deleted successfully'));
        } catch (Exception $e) {
            $this->redirect(URLROOT . '/Estate/agent/properties/' . $propertyId . '/edit?status=error&message=' . urlencode($e->getMessage()));
        }
    }
}
