<?php

class LocationModel
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function getStates(): array
    {
        $stmt = $this->conn->prepare("SELECT id, stateName FROM states");
        $stmt->execute();
        $result = $stmt->get_result();
        $states = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $states;
    }

    public function getLGAsByState(int $stateId): array
    {
        $stmt = $this->conn->prepare("SELECT id, lga FROM lga WHERE state_id = ?");
        $stmt->bind_param("i", $stateId);
        $stmt->execute();
        $result = $stmt->get_result();
        $lgas = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $lgas;
    }
}
