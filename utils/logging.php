<?php
function logMessage($message) {
    if ($_ENV['ENABLE_LOGGING'] === 'true') {
        $logFile = $_ENV['LOG_FILE'] ?? __DIR__.'../logs/app.log';
        $time = date('Y-m-d H:m:s');
        $entry = "[$time] $message\n";
        file_put_contents($logFile, $entry, FILE_APPEND);
    }
}