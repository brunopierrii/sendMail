<?php

include 'Mensagem.php';

use AppSendMail\Mensagem;

$mensagem = new Mensagem();

$mensagem->__set('para', $_POST['para']);
$mensagem->__set('assunto', $_POST['assunto']);
$mensagem->__set('mensagem', $_POST['mensagem']);

$mensagem->enviarEmail();