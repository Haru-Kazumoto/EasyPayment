<?php

function format_date($date, $show_time = true)
{
    if (empty($date)) {
        return '-';
    }

    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $timestamp = strtotime($date);
    if (!$timestamp) {
        return '-';
    }

    $day   = date('j', $timestamp);
    $month = $months[(int) date('n', $timestamp)];
    $year  = date('Y', $timestamp);
    $time  = date('H:i:s', $timestamp);

    return $show_time ? "$day $month $year $time" : "$day $month $year";
}
