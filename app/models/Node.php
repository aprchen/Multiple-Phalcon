<?php

namespace Sl\Models;


use Phalcon\Validation;


class Node extends ModelBase
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
    public $title;
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
     *
     * @var integer
     */
    public $private;
    /**
     *
     * @var integer
     */
    public $orderId;
    /**
     *
     * @var string
     */
    public $style;
    /**
     *
     * @var string
     */
    public $type;



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
            'action' => 'action',
            'controller' => 'controller',
            'private' => 'private',
            'created_at' => 'createdAt',
            'updated_at' => 'updatedAt',
        );
    }

    public function initialize(){

    }

}
