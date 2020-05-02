<?php

if (!function_exists('format_rp')) {
    function format_rp($value, $symbol = true)
    {
        $format = number_format($value, 2, ',', '.');
        return ($symbol) ? "Rp. " . $format . ',-' : $format;
    }
}
