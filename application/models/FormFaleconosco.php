<?php
class FormFaleconosco extends Zend_Form {
    public function init() {
        $this->setAttrib('id', 'formFaleconosco')
                ->setAction('faleconosco')
                ->setMethod('post');
        $this->addElement( 'text', 'nome', array(
                'label' => 'Nome *',
                'required' => true,
                'validators' => array(
                        'NotEmpty'
                )
        ));
        $this->addElement('text', 'email', array(
                'label' => 'E-mail *',
                'required' => true,
                'validators' => array(
                        'NotEmpty',
                        'EmailAddress'
                )
        ));
        $this->addElement( 'text', 'telefone', array(
                'label' => 'Telefone',
                'required' => false
        ));
        $this->addElement( 'text', 'cidade', array(
                'label' => 'Cidade',
                'required' => false
        ));
        $this->addElement( 'text', 'estado', array(
                'label' => 'Estado',
                'required' => false
        ));
        $this->addElement( 'textarea', 'mensagem', array(
                'label' => 'Mensagem *',
                'rows' => '7',
                'required' => true,
                'validators' => array('NotEmpty')
        ));
        $this->addElement( 'submit', 'enviar', array(
                'ignore' => true,
                'label' => 'Enviar Mensagem'
        ));
        $this->getElement('enviar')->removeDecorator('label');
    }
}