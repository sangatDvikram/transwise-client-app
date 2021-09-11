<?php

/**
 * Created by PhpStorm.
 * User: The Samir
 * Date: 8/25/14
 * Time: 4:30 PM
 */
class myDB {

    private static $_instance = null;
    private $_pdo,
        $_query,
        $_error = false,
        $_results,
        $_count = 0;

    private function __construct()
    {
        try
        {
            $this->_pdo = new PDO('mysql:host=SD;dbname=transwise', 'vrittDbAdmin', 'b@nd3Is@Awsm');
        } catch (PODException $e)
        {
            die($e->getMessage(0));
        }
    }

    public static function getInstance()
    {
        if (! isset(self::$_instance))
        {
            self::$_instance = new myDB();
        }

        return self::$_instance;
    }
public function getPdo(){
    return $this->_pdo;
}
    public function query($sql, $params = array())
    {
        try
        {
            $this->_error = false;
            if ($this->_query = $this->_pdo->prepare($sql))
            {

                if (count($params))
                {
                    $x = 1;
                    foreach ($params as $param)
                    {
                        $this->_query->bindValue($x, $param);
                        $x ++;
                    }
                }
                if ($this->_query->execute())
                {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                } else
                {
                    $this->_error = true;
                }

            }

            return $this;
        } catch (exception $e)
        {
        }
    }

    public function error()
    {
        return $this->_error;
    }

    public function action($action, $table, $where = array())
    {
        if (count($where) === 3)
        {
            $operators = array('=', '>', '<', '>=', '<=', '!=');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            if (in_array($operator, $operators))
            {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if (! $this->query($sql, array($value))->error())
                {
                    return $this;
                }
            }
        }

        return false;
    }

    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where)
    {
        return $this->action('DELETE', $table, $where);
    }

    public function count()
    {
        return $this->_count;
    }

    public function results()
    {
        return $this->_results;
    }

    public function first()
    {
        if ($this->count())
        {
            return $this->results()[0];
        }

        return $this->results();
    }

    public function insert($table, $fields = array())
    {
        try
        {
            if (count($fields))
            {
                $keys = array_keys($fields);
                $values = '';
                $x = 1;
                foreach ($fields as $field)
                {
                    $values .= '?';
                    if ($x < count($fields))
                    {
                        $values .= ', ';
                    }
                    $x ++;
                }
                $sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES ({$values})";
                if (! $this->query($sql, $fields)->error())
                {
                    return true;
                }
            }

            return false;
        } catch (exception $e)
        {
        }

    }

    /*
     * function will helps to update any values in any given table name
     * ex: $userUpdate=myDB::getInstance()->update("$user","id = '3'", array(
     *                                                                       'username'=>'sam',
    *                                                                        'password'=>'newpass'
     *                                                                      ));
     */
    public function update($table, $condition, $fields = array())
    {
        $set = '';
        $x = 1;
        foreach ($fields as $name => $value)
        {
            $set .= "{$name}= ?";
            if ($x < count($fields))
            {
                $set .= ', ';
            }
            $x ++;

        }
        $sql = "UPDATE {$table} SET {$set} WHERE {$condition}";
        if (! $this->query($sql, $fields)->error())
        {
            return true;
        }

        return false;
    }

    public function Transactions($queries)
    {
        try
        {
            //die("imin");
            if (count($queries))
            {
                // array(PDO::ATTR_PERSISTENT => true)

                $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->_pdo->beginTransaction();
                foreach ($queries as $query)
                {

                    $this->_pdo->exec($query);

                }
                $this->_pdo->commit();

                return true;
            }

            return false;
            //$this->_pdo->exec("insert into staff (id, first, last) values (23, 'Joe', 'Bloggs')");
            //$this->_pdo->exec("insert into salarychange (id, amount, changedate)
            // values (23, 50000, NOW())");


        } catch (Exception $e)
        {
            $this->_pdo->rollBack();
            echo $e->getMessage();
        }

    }

}