<?php 
//fungsi tulis pesan
function tulis_pesan($filename,$string) {
    $handle = fopen($filename, 'a');
    fwrite($handle, $string);
    fclose($handle);
}

//fungsi hapus pesan
function hapus_pesan($filename) {
    $string = '';
    $handle = fopen($filename, 'w');
    fwrite($handle, $string);
    fclose($handle);
}
?>