<?php
namespace Sl\Models;
use Phalcon\Mvc\Model;

/**
 * Class YnModel
 * @package Sl\Mvc
 * 连接dbh数据库
 * 表前缀 yn_
 */
class ModelBase extends Model
{
    public $createdAt;
    public $updatedAt;
    public function getSource()
    {
        $arr = explode('\\',get_class($this));
        return $this->getDI()->get('config')->database->prefix.strtolower(end($arr));
    }

    public function beforeCreate()
    {
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = $this->createdAt;
    }

    public function beforeUpdate()
    {
        $this->updatedAt = date('Y-m-d H:i:s');
    }

    function get_tree_child($data, $pid) {
        $result = array();
        $fids = array('pid'=>$pid);
        do {
            $cids = array();
            $flag = false;
            foreach($fids as $fid) {
                for($i = count($data) - 1; $i >=0 ; $i--) {
                    $node = $data[$i];
                    if($node['pid'] == $fid) {
                        array_splice($data, $i , 1);
                        $result[] = $node['id'];
                        $cids[] = $node['id'];
                        $flag = true;
                    }
                }
            }
            $fids = $cids;
        } while($flag === true);
        return $result;
    }
}
