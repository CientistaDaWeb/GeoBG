<?php
class FaleconoscoController extends Webscientist_Action {
    function indexAction() {
        $this->view->title = $this->view->h2 = 'Fale Conosco';
        $this->view->description = '';
        $this->view->keywords = '';
        
        $this->view->headScript()
                ->prependFile(JS_PATH.'jquery.maskedinput-1.2.2.min.js')
                ->appendFile(JS_PATH.'faleconosco.js')
        ;
        $this->view->headLink()->appendStylesheet(CSS_PATH.'faleconosco.css');
        $form = new FormFaleconosco();
        if ($this->_request->isPost()) {
            if ($form->isValid( $this->_request->getPost() )) {

                $nome = $this->_request->nome;
                $email = $this->_request->email;

                $mail = new Email($nome, $email);

                $this->view->conteudo = $this->_request->getPost();
                $body = $this->view->render('emails/contato.phtml');

                $mail->MsgHTML($body);
                $mail->Subject = 'Contato enviado pelo site geobg.com.br';

                if(!$mail->Send()) {
                    $this->_helper->FlashMessenger(array('error'=>'Erro ao enviar o e-mail - ' . $mail->ErrorInfo));
                } else {
                    $this->_helper->FlashMessenger(array('sucess'=>'E-mail enviado com sucesso!'));
                    $form->reset();
                    $this->_helper->getHelper('Redirector')->gotoUrl('faleconosco');
                }
            }else {
                $this->_helper->FlashMessenger(array('error'=>'Preencha todos os campos obrigatórios!'));
                $form->populate($this->_request->getPost())->markAsError();
            }
        }
        $this->view->form = $form;
    }
}