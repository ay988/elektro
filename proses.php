<?php
$koneksi = mysqli_connect("localhost", "root", "", "phpmailer");

$nama = $_POST ['nama'];
$email = $_POST ['email'];
$pw = $_POST ['pw'];
$code = md5($email. date('Y-m-d H:i:s'));
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//require 'path/to/PHPMailer/src/Exception.php';
//require 'path/to/PHPMailer/src/PHPMailer.php';
//require 'path/to/PHPMailer/src/SMTP.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ayu608679@gmail.com';                     //SMTP username
    $mail->Password   = 'vwefvxczhchgqzqt';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@testwebsite.com', 'verifikasi');
    $mail->addAddress($email, $nama);     //Add a recipient
 
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verifikasi Akun';
    $mail->Body    = 'HI' .$nama. 'Terimakasih Sudah Mendaftar Di Website Ini </br> Mohon Verifikasi Akun kamu!
     <a href="http://localhost/ver/verif.php?code=" .$code. "">Verifikasi</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();{
           $koneksi->query("INSERT INTO data (nama, email, password, verifikasi_code)VALUES('$nama', '$email', '$pw', '$code')");
 echo "<script>alert('Registrasi Berhasil, Silahan Cek Email Untuk verifikasi akun ');window.location='login.php</script>";
    }
    
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
