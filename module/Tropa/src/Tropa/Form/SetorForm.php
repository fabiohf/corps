<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 15/03/14
 * Time: 11:39
 */

namespace Tropa\Form;

use Zend\Form\Form;

class SetorForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('setor');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'codigo',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Codigo',
            )
        ));

        $this->add(array(
            'name' => 'nome',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Nome',
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Gravar',
                'id' => 'submitbutton',
            )
        ));
    }
} 