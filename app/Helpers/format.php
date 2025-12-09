<?php

if (!function_exists('format_large_number')) {
    /**
     * Formats a large number into a human-readable format (e.g., 1.2M, 5B).
     *
     * @param float|int $number
     * @return string
     */
    function format_large_number($number)
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, 2) . ' ' . __('messages.billion');
        } elseif ($number >= 1000000) {
            return round($number / 1000000, 2) . ' ' . __('messages.million');
        } elseif ($number >= 1000) {
            return round($number / 1000, 2) . ' ' . __('messages.thousand');
        }

        return number_format($number, 0, ',', '.');
    }
}
