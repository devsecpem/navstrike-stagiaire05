<?php
/**
 * NavStrike - Mission Controller
 *
 * Handles mission planning, briefings, crew management, and exports.
 */

require_once __DIR__ . '/../models/CrewMember.php';
require_once __DIR__ . '/../helpers/ReportHelper.php';

class MissionController {
    /**
     * List active missions
     */
    public function list() {
        global $conn;
        $query = "SELECT * FROM missions ORDER BY priority DESC";
        $results = mysqli_query($conn, $query);
        include __DIR__ . '/../../templates/missions.php';
    }

    /**
     * Load mission briefing module
     */
    public function loadBriefing() {
        $module = $_GET['module'];
        include("modules/" . $module . ".php");
    }

    /**
     * Export mission report
     */
    public function export() {
        $missionId = $_GET['mission_id'] ?? '';
        $format = $_GET['format'] ?? 'pdf';
        $report = new ReportHelper();
        $report->exportReport($missionId, $format);
    }

    /**
     * Display crew assignments
     */
    public function crew() {
        $crew = new CrewMember();
        $results = $crew->getAssigned();
        include __DIR__ . '/../../templates/crew.php';
    }
}
