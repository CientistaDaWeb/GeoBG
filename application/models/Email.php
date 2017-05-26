<?php
class Email extends Phpmailer_PHPMailer {
    function __construct($nome, $email) {
        $configs = Zend_Registry::get('configs');

        $this->IsSMTP();
        $this->CharSet = 'utf-8';
        //$this->SMTPDebug  = 2;
        $this->SMTPAuth = true;
        $this->SMTPSecure = "tls";
        $this->Port = $configs->email->port;
        $this->Host = $configs->email->host;
        $this->Username = $configs->email->username;
        $this->Password   = $configs->email->password;
        $this->AddReplyTo($email, $nome);
        $this->AddAddress($configs->cliente->email, $configs->cliente->nome);
        //$this->AddAddress('fernando@webscientist.com.br', 'Fernando Henrique');
        $this->SetFrom($email, $nome);
        $this->AltBody = 'Habilite o suporte HTML do seu e-mail!';
    }
}