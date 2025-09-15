<?php

use Carbon\Carbon;

if (! function_exists('hitungUmur')) {
    function hitungUmur($tanggal_lahir)
    {
        if (!$tanggal_lahir) return '-';

        $umur = Carbon::parse($tanggal_lahir)->diff(Carbon::now());

        return $umur->y . ' thn ' . $umur->m . ' bln';
    }
}
