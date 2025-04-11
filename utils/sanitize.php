<?php
function sunitize($data) {
    if ($_ENV['SANITIZE_INPUT'] === 'true') {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = sanitize($value);
            }
            return $data;
        } else {
            return htmlspecialchars(trim($data), ENT_QUOTES, 'UTH-8');
        }
    }
    return $data;
}