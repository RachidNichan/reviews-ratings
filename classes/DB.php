<?php

class DB {
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;
    
    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db') . '', Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/options'));
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()) {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param, PDO::PARAM_STR);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }

        return $this;
    }

    public function action($action, $table, $where = array(), $user_id = 0) {
        if (count($where) === 3) {
            $operators = array('=', '!=', '>', '<', '>=', '<=');

            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];

            if ($user_id > 0) {
                $where2 = 'AND user_id = ' . $user_id;
            }else {
                $where2 = '';
            }

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? {$where2}";

                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        } else {

            $sql = "{$action} FROM {$table}";

            if (!$this->query($sql)->error()) {
                return $this;
            }

        }
        return false;
    }

    public function actionLimit($action, $table, $where = array(), $start = 0, $end = 1) {
        if (count($where) === 3) {
            $operators = array('=', '!=', '>', '<', '>=', '<=');

            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ORDER BY id DESC LIMIT {$start}, $end";

                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        } else {

            $sql = "{$action} FROM {$table} LIMIT {$start}, $end";

            if (!$this->query($sql)->error()) {
                return $this;
            }

        }
        return false;
    }

    public function actionAll($action, $table, $start = 0, $end = 1) {
        $sql = "{$action} FROM {$table} LIMIT {$start}, $end";

        if (!$this->query($sql)->error()) {
            return $this;
        }

        return false;
    }

    public function actionSearch($action, $table, $where = array(), $start = 0, $end = 1) {
        if (count($where) === 3) {

            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];

                $sql = "{$action} FROM {$table} WHERE {$field} LIKE :search ORDER BY id DESC LIMIT {$start}, $end";

                if ($this->_query = $this->_pdo->prepare($sql)) {
                    $this->_query->bindValue(':search', '%' . $value . '%', PDO::PARAM_STR);
        
                    if ($this->_query->execute()) {
                        $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                        $this->_count = $this->_query->rowCount();
                    } else {
                        $this->_error = true;
                    }
                }
        
                return $this;

        }
        return false;
    }

    public function get($table, $where, $user_id = 0) {
        return $this->action('SELECT *', $table, $where, $user_id);
    }

    public function allWithLimit($table, $where, $start, $end) {
        return $this->actionLimit('SELECT *', $table, $where, $start, $end);
    }

    public function all($table) {
        return $this->action('SELECT *', $table);
    }

    public function allLimit($table, $start, $end) {
        return $this->actionAll('SELECT *', $table, $start, $end);
    }

    public function allSearch($table, $where, $start, $end) {
        return $this->actionSearch('SELECT *', $table, $where, $start, $end);
    }

    public function delete($table, $where, $user_id = 0) {
        return $this->action('DELETE', $table, $where, $user_id);
    }

    public function insert($table, $fields = array()) {
        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        foreach ($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function update($table, $id, $fields) {
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE `id` = {$id}";

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function results() {
        return $this->_results;
    }

    public function first() {
        return $this->results()[0];
    }

    public function error() {
        return $this->_error;
    }

    public function count() {
        return $this->_count;
    }
    
}

?>