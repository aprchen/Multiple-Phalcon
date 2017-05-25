<?php

namespace Sl\Models;


use Phalcon\Validation;

class Role extends ModelBase
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
    public $pid;

    /**
     *
     * @var integer
     */
    public $member;
    /**
     *
     * @var string
     */
    public $name;
    /**
     *
     * @var integer
     */
    public $childOpen;
    /**
     *
     * @var string
     */
    public $description;
    /**
     *
     * @var integer
     */
    public $status;
    /**
     *
     * @var integer
     */
    public $level;



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
            'member' => 'member',
            'pid' => 'pid',
            'name' => 'name',
            'child_open' => 'childOpen',
            'description' => 'description',
            'status' => 'status',
            'level' => 'level',
            'created_at' => 'createdAt',
            'updated_at' => 'updatedAt',
        );
    }

    public function initialize(){

    }
}
