<?php
function readCSVFile($filename) {
    $rows = [];

    if (file_exists($filename)) {
        if (($handle = fopen($filename, "r")) !== FALSE) {
            $headers = fgetcsv($handle);
            if ($headers) {
                $headers = array_map('trim', $headers); // Clean header names
            }

            while (($data = fgetcsv($handle)) !== FALSE) {
                // Skip empty or mismatched rows
                if (count($data) != count($headers)) {
                    continue;
                }

                $row = array_combine($headers, array_map('trim', $data));
                $rows[] = $row;
            }

            fclose($handle);
        }
    } else {
        echo "File not found: $filename";
    }

    return $rows;
}
?>
