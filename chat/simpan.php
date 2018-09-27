<?php 
session_start();
include 'smilies/smilie.php';
include 'fungsi.php';

$filename = 'log.txt';

$message = stripslashes(htmlspecialchars(trim($_POST['message'])));
$message = str_replace(array_keys($smilies), array_values($smilies), $message);
$session = $_POST['session'];
$jenis = $_POST['jenis'];

if ($session <> '' && $jenis == 'kirim') {
    $string = '<div class="pesan"><span class="waktu">(' . date("Y-m-d H:i:s") . ')</span> <strong>' . $session . ' : </strong>' . $message . '</div>';
    tulis_pesan($filename, $string);
} elseif ($jenis == 'clear'){
    hapus_pesan($filename);
} else {
    session_destroy();
    echo '<script>window.location="index.php"</script>';
}
?>