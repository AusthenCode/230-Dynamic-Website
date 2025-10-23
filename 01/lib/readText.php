<?php
function readTextFile($filename) {
    return file_exists($filename) ? file_get_contents($filename) : "File not found.";
}
?>
