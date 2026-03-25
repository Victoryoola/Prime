<?php
class Model
{
    private $conn;

    public function __construct($dbconn)
    {
        $this->conn = $dbconn;
    }

    public function emailExists($email)
    {
        $stmt = $this->conn->prepare('SELECT id, fullName, email, role, password_hash FROM users WHERE email = ?');
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }

    public function newAgent($name, $email, $phone, $password_hash, $status, $role, $id_type, $id_path, $cv_path)
    {
        $stmt = $this->conn->prepare('INSERT INTO users (fullName, email, phone, password_hash, status, role, id_type, id_path, cv_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("sssssssss", $name, $email, $phone, $password_hash, $status, $role, $id_type, $id_path, $cv_path);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }

    public function newProperty($id, $title, $price, $status, $state, $lga, $address, $kitchen_number, $bath_number, $bed_number, $description)
    {
        $stmt = $this->conn->prepare("INSERT INTO properties (agent_id, propertyTitle, price, propertyStatus, state, lga, address, kitchen_number, bath_number, bed_number, description) VALUES (? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $id, $title, $price, $status, $state, $lga, $address, $kitchen_number, $bath_number, $bed_number, $description);
        $stmt->execute();
        $propertyId = $stmt->insert_id;
        $stmt->close();
        return $propertyId;
    }

    public function updateProperty($id, $title, $price, $status, $state, $lga, $address, $kitchen_number, $bath_number, $bed_number, $description)
    {
        $stmt = $this->conn->prepare("UPDATE properties SET propertyTitle=?, price=?, propertyStatus=?, state=?, lga=?, address=?, kitchen_number=?, bath_number=?, bed_number=?, description=? WHERE id=?");
        $stmt->bind_param("ssssssssssi", $title, $price, $status, $state, $lga, $address, $kitchen_number, $bath_number, $bed_number, $description, $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function newUser($name, $email, $phone, $password_hash, $status, $role, $cv_path)
    {
        $stmt = $this->conn->prepare('INSERT INTO users (fullName, email, phone, password_hash, status, role, cv_path) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("sssssss", $name, $email, $phone, $password_hash, $status, $role, $cv_path);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }


    public function addPropertyImage($propertyId, $filePath)
    {
        $stmt = $this->conn->prepare("INSERT INTO property_documents (property_id, file_url) VALUES (?, ?)");
        $stmt->bind_param("is", $propertyId, $filePath);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function updateImage($imageName, $imageID)
    {
        $stmt = $this->conn->prepare("UPDATE property_documents SET file_url = ? WHERE id = ?");
        $stmt->bind_param("si", $imageName, $imageID);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function deleteImage($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM property_documents WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function addNewImage($imageName, $id)
    {
        $stmt = $this->conn->prepare("INSERT INTO property_documents (file_url, property_id) VALUES (?, ?)");
        $stmt->bind_param("si", $imageName, $id);
        $stmt->execute();
        $stmt->close;
    }

    // Transaction methods
    public function beginTransaction()
    {
        $this->conn->begin_transaction();
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function rollback()
    {
        $this->conn->rollback();
    }
}