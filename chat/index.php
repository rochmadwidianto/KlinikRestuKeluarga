<?php
// session_start();

include 'smilies/smilie.php';
include 'fungsi.php';

$filename = 'log.txt';

$login_error = '';

// if (isset($_POST['login'])) {
//     if (trim($_POST['username']) <> '') {
//         $_SESSION['username'] = trim($_POST['username']);
//         $string = '<div class="pesanmute"><i><strong>' . $_SESSION['username'] . ' </strong> masuk chat</i></div>';
//         tulis_pesan($filename, $string);
//     } else {
//         $login_error = '<span style="color:red">Username Tidak Boleh Kosong</span>';
//     }
// }

// if ($_GET['logout'] == 'true') {
//     $string = '<div class="pesanmute"><i><strong>' . $_SESSION['username'] . ' </strong> meninggalkan chat</i></div>';
//     tulis_pesan($filename, $string);
//     session_destroy();
//     echo '<script>window.location="index.php"</script>';
// }
?>
<!doctype html>
<html>
    <head>
        <style>
            *{
                font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
                font-size: 11px;
            }

            .waktu{
                font-size: xx-small;
                color: grey;
            }

            .pesanmute{
                font-size: small;
            }
        </style>
    </head>
    <body>
        <?php
        // if (!isset($_SESSION['username'])) {
            ?>
           <!--  <div>
                <form action="index.php" method="post">
                    <p>Masukkan Nama Anda : <?php echo $login_error; ?> </p>
                    <input type="text" name="username" id="username" />
                    <input type="submit" name="login" id="login" value="masuk" />
                </form>
            </div> -->
            <?php
        // } else {
            ?>
            <div>
                <p>
                    Selamat Datang <?php echo $_SESSION['s_user'] ?>
                    <!-- <a href="index.php?logout=true" onclick="javascript: return confirm('Logout ?')">Logout</a> -->
                </p>
            </div>
            <div id="chatbox" style="height: 200px; width: 450px; overflow: auto; border: 1px solid lightgray">
                <?php
                if (file_exists($filename) && filesize($filename) > 0) {
                    $handle = fopen($filename, 'r');
                    $content = fread($handle, filesize($filename));
                    echo $content;
                }
                ?>
            </div>
            <div style="margin-top: 10px">
                <form action="" name="chat" method="post">
                    <?php
                    foreach ($smilies as $key => $value) {
                        ?>
                        <a href="javascript:tambahSmilie('<?php echo $key ?>')" title="<?php echo $key ?>"><?php echo $value ?></a>
                        <?php
                    }
                    ?><br>
                    <input type="text" name="message" id="message" value="" size="55" />
                    <input type="submit" name="send" id="send" value="send" />
                    <button id="clear">clear</button>
                </form>
            </div>

            <?php
        // }
        ?>

        <script src="jquery-1.11.0.js"></script>
        <script>
            function tambahSmilie(smilie) {
                document.chat.message.value = document.chat.message.value + smilie;
            }

            $(document).ready(function () {
                var session = "<?php echo $_SESSION['username']; ?>";
                $('#message').focus();


                $('#send').click(function () {
                    var message = $('#message').val();
                    if (message !== '') {
                        $.post("simpan.php", {message: message, session: session, jenis: 'kirim'});
                        $('#message').val('');
                    }
                    $('#message').focus();
                    return false;
                });

                $('#clear').click(function () {
                    $.post("simpan.php", {jenis: 'clear'});
                    $('#message').val('');
                    $('#message').focus();
                    return false;
                });

                function log() {
                    var tinggi_lama = $('#chatbox').prop('scrollHeight');
                    $.ajax({
                        url: 'log.txt',
                        cache: false,
                        success: function (log) {
                            $("#chatbox").html(log);
                            var tinggi_baru = $('#chatbox').prop('scrollHeight');
                            if (tinggi_baru > tinggi_lama) {
                                $('#chatbox').animate({
                                    scrollTop: tinggi_baru
                                }, 'normal');
                            }
                            ;
                        }
                    });
                }
                ;

                if (session !== '') {
                    setInterval(log, 200);
                }
            });
        </script>
    </body>
</html>
