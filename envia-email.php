<?php
//Variáveis

$nome = $_POST['nome'];
$email = $_POST['email'];
$whats = $_POST['whats'];
$mensagem = $_POST['mensagem'];
$tipo = $_POST['tipo'];
$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

$arquivo = "
  <style type='text/css'>
  body {
  margin:0px;
  font-family:Verdane;
  font-size:12px;
  color: #666666;
  }
  a{
  color: #666666;
  text-decoration: none;
  }
  a:hover {
  color: #FF0000;
  text-decoration: none;
  }
  </style>
    <html>
        <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
                <tr>
                  <td width='500'>Nome:$nome</td>
                </tr>
                <tr>
                  <td width='320'>E-mail:<b>$email</b></td>
                 </tr>
                <tr>
                  <td width='320'>Whats:<b>$whats</b></td>
                </tr>
    
                <tr>
                  <td width='320'>Mensagem:$mensagem</td>
                </tr>
                </td>
                </tr>
                <tr>
                    <td>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
                </tr>
                <tr>
                    <td>Tipo: <b>$tipo</b></td>
                </tr>
        </table>
    </html>
  ";

//enviar

// emails para quem será enviado o formulário
$emailenviar = "alexandre.barros@distribuidoradominus.com,okubobarros@gmail.com";
$destino = $emailenviar;
$assunto = "Contato pelo Site";

// É necessário indicar que o formato do e-mail é html
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $nome <cairofelipedev@gmail.com>";
//$headers .= "Bcc: $EmailPadrao\r\n";

$enviaremail = mail($destino, $assunto, $arquivo, $headers);
if ($enviaremail) {
    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
    echo ("<script type= 'text/javascript'>alert('Obrigado! Em breve entramos em contato com você');</script>
            <script>window.location = 'home';</script>");
} else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo "";
} 
