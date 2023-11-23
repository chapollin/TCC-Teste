<?php
// Inclua o arquivo conecta_bd.php
require '../bd/conecta_bd.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-6.8.1/src/Exception.php';
require 'PHPMailer-6.8.1/src/PHPMailer.php';
require 'PHPMailer-6.8.1/src/SMTP.php';

try {
    // Conecte-se ao banco de dados usando a função do arquivo conecta_bd.php
    $conn = conecta_bd();

    // Data atual
    $dataAtual = new DateTime();

    // Data atual mais 5 dias (para verificar promissórias com 5 dias de antecedência)
    $dataVencimentoLimite = $dataAtual->modify('+5 days')->format('Y-m-d');

    // Consulta SQL para selecionar promissórias prestes a vencer (status = 2 para não pagas)
    $sql = "SELECT promissoria.cod, promissoria.descricao, promissoria.data_vencimento, promissoria.valor, cliente.email AS email_cliente, cliente.nome AS nome_cliente
            FROM promissoria
            INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod
            WHERE promissoria.status = 2 AND promissoria.data_vencimento <= :dataVencimentoLimite";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':dataVencimentoLimite', $dataVencimentoLimite, PDO::PARAM_STR);
    $stmt->execute();

    // Processar os resultados e enviar e-mails
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'marcos.cardos@alunos.ifsuldeminas.edu.br';
            $mail->Password   = 'mmeqrnykggjhawfe';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet = 'UTF-8';

            // Conteúdo do email
            $mail->isHTML(true);
            $mail->setFrom('marcos.cardoso@alunos.ifsuldeminas.edu.br', 'Inadimanager');
            $mail->addAddress($row['email_cliente']);

            $subject = 'Promissória em Atraso';
            $message = '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="utf-8">
                            <title>Email de Atraso</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
                            <style type="text/css">
                                body{margin-top:20px;}
                            </style>
                        </head>
                        <body>
                        <table class="body-wrap" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
                            <tbody>
                            <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                <td class="container" width="600" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                                    <div class="content" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                                        <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                                            <tbody>
                                            <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td class style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background: #000000;background: -webkit-linear-gradient(to right, #a09aad, #000000);background: linear-gradient(to right, #000000, #a09aad); margin: 0; padding: 20px;" align="center" bgcolor="#71b6f9" valign="top">
                                                    <img src="https://i.imgur.com/VAMKkFq.png" width="200">
                                                </td>
                                            </tr>
                                            <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td class="content-wrap" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                                                    <table width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                        <tbody>
                            
                                                        <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px; text-align: center;" valign="top">
                                                                Prezado(a) ' . $row['nome_cliente'] . ',
                                                            </td>
                                                        </tr>
                                                        <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px; text-align: center;" valign="top">
                                                                Sua promissória do produto/serviço \'' . $row['descricao'] . '\' adquirido em nossa loja está em atraso.<br>
                                                                Data de Vencimento: ' . date('d/m/Y', strtotime($row['data_vencimento'])) . '<br>
                                                                Valor: R$ ' . number_format($row['valor'], 2, ',', '.') . '
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                            </tr>
                            </tbody>
                        </table>
                        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
                        <script type="text/javascript"></script>
                        </body>
                        </html>';
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Envie o email
            $mail->send();

            echo "E-mail enviado para {$row['email_cliente']} com sucesso.<br>";
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
    }
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}

// Feche a conexão com o banco de dados
$conn = null;
?>
