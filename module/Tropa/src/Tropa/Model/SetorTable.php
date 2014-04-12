<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 14/03/14
 * Time: 23:25
 */

namespace Tropa\Model;

use Zend\Db\TableGateway\TableGateway;

class SetorTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getSetor($codigo)
    {
        $codigo = (int)$codigo;
        $rowSet = $this->tableGateway->select(array('codigo' => $codigo));
        $row = $rowSet->current();
        return $row;
    }

    public function saveSetor(Setor $setor)
    {
        $data = array(
            'nome' => $setor->nome,
        );

        $codigo = $setor->codigo;
        if (!$this->getSetor($codigo)) {
            $data['codigo'] = $codigo;
            $this->tableGateway->insert($data);
        } else {
            $this->tableGateway->update($data, array('codigo' => $codigo));
        }
    }

    public function deleteSetor($codigo)
    {
        $codigo = (int)$codigo;
        $this->tableGateway->delete(array('codigo' => $codigo));
    }
} 