<?php

namespace Core;

class Logger
{
    public static function error(string $message): void
    {
        $file = __DIR__ . '/../storage/logs/app.log';
        $entry = "[" . date('Y-m-d H:i:s') . "] ERROR: {$message}\n";
        file_put_contents($file, $entry, FILE_APPEND);
    }
}
