<?php

namespace Sl\Models;


use Phalcon\Validation;

class UserRole extends ModelBase
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
    public $user_id;


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
            'user_id' => 'userId',
            'created_at' => 'createdAt',
            'updated_at' => 'updatedAt',
        );
    }

    public function initialize(){

    }
}
