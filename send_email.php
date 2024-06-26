<!--LINK BOOTSTRAP-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    .loading-container {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
</style>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'testejaksjkajksdjk@outlook.com';
        $mail->Password = 'senhaTeste123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('testejaksjkajksdjk@outlook.com', $nome);
        $mail->addAddress('casaoliveira987123@hotmail.com', 'Site Oliveira!');

        $assunto = 'Feedback de ' . $nome;
        $mail->Subject = $assunto;

        $mensagemFormatada = "
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    .container {
                        background-color: #ffffff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    }
                    .header {
                        background-color: #007bff;
                        color: #ffffff;
                        padding: 10px;
                        text-align: center;
                        border-radius: 5px 5px 0 0;
                    }
                    .content {
                        padding: 20px;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>$assunto</h2>
                    </div>
                    <div class='content'>
                        <p><strong>Nome:</strong> $nome</p>
                        <p><strong>Email:</strong> $email</p>
                        <p><strong>Mensagem:</strong></p>
                        <p>$mensagem</p>
                    </div>
                </div>
            </body>
            </html>
        ";
        $mail->msgHTML($mensagemFormatada);

        $mail->send();

        echo '<div class="mt-5 text-center mt-3">';
        echo '  <div class="spinner-border text-primary" role="status">';
        echo '    <span class="visually-hidden">Carregando...</span>';
        echo '  </div>';
        echo '  <p class="mt-2">Enviando mensagem, por favor aguarde...</p>';
        echo '</div>';

        echo '<script>';
        echo 'setTimeout(function() {';
        echo '  document.querySelector("p").innerHTML = "Mensagem enviada com sucesso!";';
        echo '  setTimeout(function() {';
        echo '    window.location.href = "index.html#contact";';
        echo '  }, 2000);';
        echo '}, 2000);';
        echo '</script>';


    } catch (Exception $e) {
        echo "Erro ao enviar email: {$mail->ErrorInfo}";
    }
}
?>