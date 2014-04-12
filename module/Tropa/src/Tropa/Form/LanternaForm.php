<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 16/03/14
 * Time: 15:41
 */

namespace Tropa\Form;

use Zend\Form\Form;

class LanternaForm extends Form
{

    protected $setorTable;

    public function __construct($name = null)
    {
        parent::__construct('lanterna');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'nome',
            'type' => 'text',
            'options' => array(
                'label' => 'Nome'
            )
        ));

        $this->add(array(
            'name' => 'codigo_setor',
            'type' => 'select',
            'options' => array(
                'label' => 'Setor',
                'value_options' => $this->getValueOptions()
            )
        ));

        $this->add(array(
            'name' => 'codigo',
            'type' => 'hidden'
        ));

        $this->add(array(
                'name' => 'submit',
                'attributes' => array(
                    'type' => 'submit',
                    'value' => 'Gravar',
                    'id' => 'submitbutton'
                )
            )
        );
    }

    private function getSetorTable()
    {
        if (!$this->setorTable) {
            $sm = $GLOBALS['sm'];
            $this->setorTable = $sm->get('Tropa\Model\SetorTable');
        }

        return $this->setorTable;
    }

    private function getValueOptions()
    {
        $valueOptions = array();
        $setores = $this->getSetorTable()->fetchAll();

        foreach ($setores as $setor) {
            $valueOptions[$setor->codigo] = $setor->nome;
        }

        return $valueOptions;
    }

} 