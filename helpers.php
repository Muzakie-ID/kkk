<?php
/**
 * Helper functions untuk aplikasi SIPAS
 */

/**
 * Format tanggal ke bahasa Indonesia
 * @param string $date - tanggal dalam format yang bisa diparse strtotime()
 * @param string $format - 'short' untuk "10 Okt 2023", 'long' untuk "10 Oktober 2023 - 09:30"
 * @return string
 */
function tanggal_indo($date, $format = 'short') {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $bulan_pendek = [
        1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];

    $timestamp = strtotime($date);
    $tgl = date('d', $timestamp);
    $bln = (int)date('m', $timestamp);
    $thn = date('Y', $timestamp);

    if ($format === 'long') {
        $jam = date('H:i', $timestamp);
        return $tgl . ' ' . $bulan[$bln] . ' ' . $thn . ' - ' . $jam;
    }

    return $tgl . ' ' . $bulan_pendek[$bln] . ' ' . $thn;
}
?>
