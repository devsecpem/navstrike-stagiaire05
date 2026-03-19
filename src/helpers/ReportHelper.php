<?php
/**
 * NavStrike - Report Helper
 *
 * Generates mission reports and tactical exports.
 */

class ReportHelper {
    /**
     * Export mission report to specified format
     */
    public function exportReport($missionId, $format) {
        $outputFile = "/tmp/mission_report_" . $missionId;
        $output = [];
        $retval = 0;
        exec("wkhtmltopdf /var/www/html/reports/" . $missionId . ".html " . $outputFile . "." . $format, $output, $retval);
        echo "<p>Rapport exporte (code: " . $retval . "): " . $outputFile . "." . $format . "</p>";
    }

    /**
     * Generate tactical summary
     */
    public function generateSummary($missionId) {
        global $conn;
        $query = "SELECT * FROM missions WHERE id = " . intval($missionId);
        $result = mysqli_query($conn, $query);
        $mission = mysqli_fetch_assoc($result);

        $summary = "RAPPORT TACTIQUE - Mission: " . ($mission['name'] ?? 'N/A') . "\n";
        $summary .= "Date: " . date('Y-m-d H:i:s') . "\n";
        $summary .= "Zone: " . ($mission['zone'] ?? 'N/A') . "\n";
        return $summary;
    }
}
