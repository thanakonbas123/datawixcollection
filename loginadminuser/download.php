<?php
if (isset($_POST['csv_data'])) {
    $dataItems = json_decode($_POST['csv_data'], true);

    if (json_last_error() === JSON_ERROR_NONE && !empty($dataItems)) {
        $filename = "data_export_" . date('Ymd') . ".csv";
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment;filename=' . $filename);

        $output = fopen('php://output', 'w');

        // Add BOM to fix UTF-8 in Excel
        fputs($output, "\xEF\xBB\xBF");

        // Get headers from the first item
        $headers = array_keys($dataItems[0]['data']);
        fputcsv($output, $headers);

        // Write data rows
        foreach ($dataItems as $item) {
            $row = [];
            foreach ($item['data'] as $value) {
                // If value is an array, convert it to a comma-separated string
                if (is_array($value)) {
                    $row[] = implode(', ', $value);
                } else {
                    $row[] = $value;
                }
            }
            fputcsv($output, $row);
        }

        fclose($output);
        exit();
    } else {
        echo "Invalid or empty data received.";
    }
} else {
    echo "No data received.";
}
?>
