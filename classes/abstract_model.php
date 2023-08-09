<?php 
namespace Application\classes;
use Application\classes\db as DB;

abstract class abstract_model
{
    static protected $table;
    protected $data = array();

    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    public function __get($k)
    {
        return $this->data[$k];
    }

    public function __isset($k)
    {
        return isset($this->data[$k]);
    }

    public static function findAll($fields, $where)
    {
        $db = db::get_instance(); //new DB();
        $db->setClassName(get_called_class());
        //echo get_called_class(); exit;
        $sql = $fields . ' FROM ' . static::$table . ' WHERE ' . $where;
        //echo '===' . $sql; exit;
        $res = $db->query($sql);
        //var_dump($res);
        if (!empty($res)) {
            return $res;
        }
        return false;
    }

    public static function findOneByPk($id, $fields='*')
    {
        $db = db::get_instance(); //new DB();
        $db->setClassName(get_called_class());
        if ($fields !='*') {
            $sql = $fields . ' FROM ' . static::$table . ' WHERE id = ?';
        }
        else {
            $sql = 'SELECT ' . $fields . ' FROM ' . static::$table . ' WHERE id=:id';
        }

        $res = $db->query($sql, array($id));
        if (!empty($res)) {
            return $res[0];
        }
        return false;
    }

    public static function findByColumn($column, $value) //findOneByColumn
    {
        $db = db::get_instance(); //new DB();
        $db->setClassName(get_called_class());
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . '=:value';
        $res = $db->query($sql, [':value' => $value]);
        if (!empty($res)) {
            return $res;
        }
        return false;
    }

    protected  function insert()
    {
        $db = db::get_instance(); //new DB();
        $cols = array_keys($this->data);
        $data = [];
        foreach ($cols as $col) {
            $data[':' . $col] = $this->data[$col];
        }
        $sql = '
            INSERT INTO ' . static::$table . '
             (' . implode(', ', $cols). ')
             VALUES
             (' . implode(', ', array_keys($data)). ')
         ';
        $db->execute($sql, $data);
        $this->id = $db->lastInsertId();
    }
    
    protected function update($id)
    {
        $db = db::get_instance(); //new DB();
        $cols = [];
        $data = [];
        foreach ($this->data as $k => $v) {
            $data[':' . $k] = $v;
            if ('id' == $k) {
                continue;
            }
            $cols[] = $k . '=:' . $k;
        }
        $sql = 'UPDATE ' . static::$table . ' SET ' . implode(', ', $cols) . ' WHERE id=' . $id;
        $res = $db->execute($sql, $data);
        return $res;
    }

    public function save($id="")
    {
        if ($id=="") {
            $this->insert();
        } else {
            return $this->update($id);
        }
    }
    public function delete($id)
    {
        $db = db::get_instance(); //new DB();
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        return $db->execute($sql, [':id' => $id]);
    }

}    