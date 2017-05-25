<?php

namespace Sl\Models;


use Phalcon\Validation;

class NodeRole extends ModelBase
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $role_id;

    /**
     *
     * @var integer
     */
    public $nodeId;


    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function  columnMap()
    {
        return array(
            'id' => 'id',
            'role_id' => 'roleId',
            'node_id' => 'nodeId',
            'created_at' => 'createdAt',
            'updated_at' => 'updatedAt',
        );
    }

    public function initialize(){
        $this->belongsTo('role_id','Sl\Mvc\YnModel\Role','id',array('alias'=>'role'));
        $this->belongsTo('node_id','Sl\Mvc\YnModel\Node','id',array('alias'=>'node'));
    }
}
