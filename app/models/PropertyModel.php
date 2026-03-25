<?php

class PropertyModel
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function getAll(): array
    {
        $stmt = $this->conn->prepare(
            "SELECT properties.id, properties.propertyTitle, properties.price,
                properties.propertyStatus, states.stateName AS state_name,
                lga.lga AS lga_name, properties.address,
                properties.kitchen_number, properties.bath_number, properties.bed_number,
                (SELECT file_url FROM property_documents WHERE property_documents.property_id = properties.id LIMIT 1) AS file_url
            FROM properties
            JOIN states ON properties.state = states.id
            JOIN lga ON properties.lga = lga.id"
        );
        $stmt->execute();
        $result = $stmt->get_result();
        $properties = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $properties;
    }

    public function getByAgent(int $agentId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT properties.id, properties.propertyTitle, properties.price,
                properties.propertyStatus, states.stateName AS state_name,
                lga.lga AS lga_name, properties.address,
                properties.kitchen_number, properties.bath_number, properties.bed_number,
                (SELECT file_url FROM property_documents WHERE property_documents.property_id = properties.id LIMIT 1) AS file_url
            FROM properties
            JOIN states ON properties.state = states.id
            JOIN lga ON properties.lga = lga.id
            WHERE agent_id = ?"
        );
        $stmt->bind_param("i", $agentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $properties = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $properties;
    }

    public function getById(int $id): array
    {
        $stmt = $this->conn->prepare(
            "SELECT properties.id, properties.propertyTitle, properties.price,
                properties.propertyStatus, states.stateName AS state_name,
                lga.lga AS lga_name, properties.address,
                properties.kitchen_number, properties.bath_number, properties.bed_number,
                properties.description, property_documents.file_url
            FROM properties
            JOIN states ON properties.state = states.id
            JOIN lga ON properties.lga = lga.id
            LEFT JOIN property_documents ON properties.id = property_documents.property_id
            WHERE properties.id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $details = [];
        $images = [];
        while ($row = $result->fetch_assoc()) {
            if (empty($details)) {
                $details = array_diff_key($row, ['file_url' => '']);
            }
            if (!empty($row['file_url'])) {
                $images[] = $row['file_url'];
            }
        }
        $stmt->close();
        return ['details' => $details, 'images' => $images];
    }

    public function getForEdit(int $id): array
    {
        $stmt = $this->conn->prepare(
            "SELECT properties.id, properties.propertyTitle, properties.price,
                properties.propertyStatus, states.stateName AS state_name,
                lga.id AS lga_id, lga.lga AS lga_name, properties.address,
                properties.kitchen_number, properties.bath_number, properties.bed_number,
                properties.description, property_documents.file_url,
                property_documents.id AS image_id
            FROM properties
            JOIN states ON properties.state = states.id
            JOIN lga ON properties.lga = lga.id
            LEFT JOIN property_documents ON properties.id = property_documents.property_id
            WHERE properties.id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $details = [];
        $images = [];
        while ($row = $result->fetch_assoc()) {
            if (empty($details)) {
                $details = [
                    'id' => $row['id'], 'propertyTitle' => $row['propertyTitle'],
                    'price' => $row['price'], 'propertyStatus' => $row['propertyStatus'],
                    'state_name' => $row['state_name'], 'lga_id' => $row['lga_id'],
                    'lga_name' => $row['lga_name'], 'address' => $row['address'],
                    'kitchen_number' => $row['kitchen_number'], 'bath_number' => $row['bath_number'],
                    'bed_number' => $row['bed_number'], 'description' => $row['description'],
                ];
            }
            if (!empty($row['file_url'])) {
                $images[] = ['image_id' => $row['image_id'], 'file_url' => $row['file_url']];
            }
        }
        $stmt->close();
        return ['details' => $details, 'images' => $images];
    }

    public function create(int $agentId, string $title, float $price, string $status, int $state, int $lga, string $address, int $kitchen, int $bath, int $bed, string $description): int
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO properties (agent_id, propertyTitle, price, propertyStatus, state, lga, address, kitchen_number, bath_number, bed_number, description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("isdsiisiiis", $agentId, $title, $price, $status, $state, $lga, $address, $kitchen, $bath, $bed, $description);
        $stmt->execute();
        $propertyId = $stmt->insert_id;
        $stmt->close();
        return $propertyId;
    }

    public function update(int $id, string $title, float $price, string $status, int $state, int $lga, string $address, int $kitchen, int $bath, int $bed, string $description): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE properties SET propertyTitle=?, price=?, propertyStatus=?, state=?, lga=?, address=?, kitchen_number=?, bath_number=?, bed_number=?, description=? WHERE id=?"
        );
        $stmt->bind_param("sdsiisiiisi", $title, $price, $status, $state, $lga, $address, $kitchen, $bath, $bed, $description, $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function delete(int $id): bool
    {
        $this->conn->begin_transaction();
        try {
            $stmt1 = $this->conn->prepare('DELETE FROM property_documents WHERE property_id = ?');
            $stmt1->bind_param('i', $id);
            $stmt1->execute();
            $stmt1->close();

            $stmt2 = $this->conn->prepare('DELETE FROM properties WHERE id = ?');
            $stmt2->bind_param('i', $id);
            $stmt2->execute();
            $stmt2->close();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }

    public function addImage(int $propertyId, string $fileUrl): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO property_documents (property_id, file_url) VALUES (?, ?)");
        $stmt->bind_param("is", $propertyId, $fileUrl);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateImage(int $imageId, string $fileUrl): bool
    {
        $stmt = $this->conn->prepare("UPDATE property_documents SET file_url = ? WHERE id = ?");
        $stmt->bind_param("si", $fileUrl, $imageId);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function deleteImage(int $imageId): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM property_documents WHERE id = ?");
        $stmt->bind_param("i", $imageId);
        $stmt->execute();
        $stmt->close();
        return true;
    }
}
