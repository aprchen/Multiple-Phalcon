<?php

namespace Sl\Models;


use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;

class User extends ModelBase
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $sex;

    /**
     *
     * @var double
     */
    public $money;

    /**
     *
     * @var double
     */
    public $frozen_money;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var integer
     */
    public $Ip;

    /**
     *
     * @var integer
     */
    public $lastLoginTime;


    /**
     *
     * @var integer
     */
    public $loginCount;

    /**
     *
     * @var integer
     */
    public $isValidated;

    /**
     *
     * @var integer
     */
    public $status;
    /**
     *
     * @var string
     */
    public $avatar;

    /**
     *
     * @var integer
     */
    public $ID;
    /**
     *
     * @var string
     */
    public $lastLoginIp;

    /**
     *
     * @var integer
     */
    public $cityId;

//    /**
//     * Validations and business logic
//     */
//    public function validation()
//    {
//
//        $this->validate(
//            new Email(
//                array(
//                    'field'    => 'email',
//                    'required' => true,
//                )
//            )
//        );
//        if ($this->validationHasFailed() == true) {
//            return false;
//        }
//    }

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
            'phone' => 'phone',
            'email' => 'email',
            'name' => 'name',
            'password' => 'password',
            'id_number' => 'ID',
            'sex' => 'sex',
            'status' => 'status',
            'avatar' => 'avatar',
            'money' => 'money',
            'frozen_money' => 'frozenMoney',
            'address' => 'address',
            'is_validated' => 'isValidated',
            'last_login_ip' => 'lastLoginIp',
            'last_login_time' => 'lastLoginTime',
            'login_count' => 'loginCount',
            'city_id' => 'cityId',
            'created_at' => 'createdAt',
            'updated_at' => 'updatedAt',
        );
    }

    public function initialize(){
        $this->hasMany('id','Sl\Mvc\YnModel\UserRole','id',array('alias'=>'userRole'));
        $this->belongsTo('city_id','Sl\Mvc\YnModel\region','id',array('alias'=>'region'));
    }


    public function findFirstByLogin($arr)
    {

    }

    public function findAll()
    {

    }
}
