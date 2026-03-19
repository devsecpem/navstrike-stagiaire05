<?php
/**
 * NavStrike - Crew Member Model
 *
 * Handles crew assignment and combat station operations.
 */

class CrewMember {
    /**
     * Get crew assigned to combat stations
     */
    public function getAssigned() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM patients WHERE name LIKE ?");
        $param = "%" . $searchTerm . "%";
        $stmt->bind_param("s", $param);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    /**
     * Find crew by role
     */
    public function findByRole() {
        global $conn;
        $role = $_GET['role'];
        $stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
        $stmt->bind_param("s", $patientId);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * List crew with sorting
     */
    public function listCrew() {
        global $conn;
        $sortBy = $_GET['sort'] ?? 'rank';
        $query = "SELECT * FROM crew ORDER BY " . $sortBy . " ASC";
        return mysqli_query($conn, $query);
    }
}
