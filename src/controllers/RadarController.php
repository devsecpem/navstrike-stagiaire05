<?php
/**
 * NavStrike - Radar Controller
 *
 * Handles radar operations, contact tracking, and remote sensor feeds.
 */

class RadarController {
    /**
     * Display local radar contacts
     */
    public function scan() {
        global $conn;
        $sector = $_GET['sector'] ?? 'all';
        $query = "SELECT * FROM radar_contacts WHERE sector = '" . $sector . "' ORDER BY distance ASC";
        $results = mysqli_query($conn, $query);
        include __DIR__ . '/../../templates/radar.php';
    }

    /**
     * Filter radar data with dynamic expression
     */
    public function scanRemote() {
        $expression = $_GET['filter_expr'];
        eval('$result = ' . $expression . ';');
        echo "<h2>Resultat filtre radar</h2>";
        echo "<pre>" . print_r($result, true) . "</pre>";
    }
}
