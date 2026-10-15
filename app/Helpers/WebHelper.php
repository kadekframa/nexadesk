<?php

use Illuminate\Support\Str;

/*
 * Helper global aplikasi (didaftarkan lewat "autoload.files" di composer.json).
 *
 * Pola helper status dipakai berpasangan dengan print_status()/print_var():
 *
 *   function status_contoh($key = null)
 *   {
 *       $data = [
 *           'open'   => ['val' => 'Dibuka', 'alert' => 'warning'],
 *           'closed' => ['val' => 'Ditutup', 'alert' => 'success'],
 *       ];
 *
 *       $print = array_key_exists($key, $data) ? $data[$key] : null;
 *       return (is_null($key)) ? $data : $print;
 *   }
 *
 *   {!! print_status(status_contoh('open')) !!}
 */

function print_status($str)
{
    if (empty($str['alert']) or empty($str['val'])) return null;
    return '<span class="badge badge-' . $str['alert'] . ' disabled">' . $str['val'] . '</span>';
}

function print_var($str)
{
    return Str::ucfirst($str['val']);
}

/**
 * Tampilkan SweetAlert pada request berikutnya.
 * Pasangannya: @include('components.result') di view tujuan.
 */
if (!function_exists('sweetAlert')) {
    function sweetAlert($title, $text, $icon, $footer = null)
    {
        session()->flash('sweetAlert', compact('title', 'text', 'icon', 'footer'));
    }
}
