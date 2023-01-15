<?php

namespace App\Database;

class QueryBuilder
{
    private $query = [];
    private $fields = [];
    private $conditions = [];
    private $from = [];
    private  string $table;
    private \PDOStatement $stmt;
    protected \PDO $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    function setTable($table)
    {
        $this->table = $table;
    }
    function setQuery($query)
    {
        $this->query = $query;
    }
    function getQuery()
    {
        return $this->query;
    }
    function setStmt($stmt)
    {
        $this->stmt = $stmt;
    }
    function getStmt()
    {
        return $this->stmt;
    }

    function getTable()
    {
        return $this->table;
    }

    function select($fields): self
    {
        $sql = "SELECT ";
        $list = implode(',', $fields);
        $this->query[] = $sql . $list;
        return $this;
    }

    function insert($data = []): self
    {
        $k = array_keys($data);
        $v = array_values($data);
        $keys = implode(',', $k);
        $values = "'" . implode("', '", $v) . "'";
        $sql = "INSERT INTO {$this->table}({$keys}) VALUES({$values})";
        $this->query[] = $sql;
        return $this;
    }

    function from($table): self
    {

        $this->query[] = " FROM {$table} ";
        return $this;
    }

    function where(array $conditions): self
    {
        $k = array_keys($conditions);
        $v = array_values($conditions);
        $this->query[] = " WHERE {$k[0]}='{$v[0]}'";
        return $this;
    }

    function limit(int $n): self
    {
        $this->query[] = " LIMIT {$n}";
        return $this;
    }

    function and(array $conditions)
    {
        $k = array_keys($conditions);
        $v = array_values($conditions);
        $this->query[] = " AND {$k[0]}='{$v[0]}'";
        return $this;
    }

    function or(array $conditions)
    {
        $k = array_keys($conditions);
        $v = array_values($conditions);
        $this->query[] = " OR {$k[0]}='{$v[0]}'";
        return $this;
    }

    function __toString()
    {
        return join($this->query);
    }

    function query($sql)
    {

        return  $statement = $this->pdo->prepare($sql);
    }

    function exec($array = null): self
    {
        $sql = join($this->query);
        $this->stmt = $this->query($sql);
        $this->stmt->execute();
        $this->query = []; // vaciar la query para poder hacer más de una seguida
        return $this;
    }

    function fetch(): ?array
    {
        $rows = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($rows) {
            return $rows;
        }
        return null;
    }


    function selectAllWithJoin($table1, $table2, array $fields = null, string $join1, string $join2): array
    {
        if (is_array($fields)) {
            $columns = implode(',', $fields);
        } else {
            $columns = "*";
        }

        $inners = "{$table1}.{$join1} = {$table2}.{$join2}";

        $sql = "SELECT {$columns} FROM {$table1} INNER JOIN {$table2} ON {$inners}";

        $stmt = $this->query($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
    /*
            function select($table,$fields=null,$not=null,$condition=null){
                if($fields==null){
                    $fields=['*'];
                }

                $sql="SELECT " 
                .implode(",",$fields).
                " FROM {$table} ";
                
                if($condition==null){
                    $sql.='';
                }else{
                    $sql.="WHERE ";
                    if($not!=null){
                        $sql.=' NOT ';
                    }

                    $sql.=implode('=',$condition);
                }
                
                $stmt=$this->query($sql);
                $stmt->execute();
                $rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
                return $rows;   
            }
  */
    // només una condició
    function selectWhereWithJoin($table1, $table2, array $fields = null, string $join1, string $join2, array $conditions): array
    {
        if (is_array($fields)) {
            $columns = implode(',', $fields);
        } else {
            $columns = "*";
        }

        $inners = "{$table1}.{$join1} = {$table2}.{$join2}";
        $cond = "{$conditions[0]}='{$conditions[1]}'";

        $sql = "SELECT {$columns} FROM {$table1} INNER JOIN {$table2} ON {$inners} WHERE {$cond} ";


        $stmt = $this->query($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }

    function update(string $table, array $data, $id)
    {
        if ($data) {
            $keys = array_keys($data);
            $values = array_values($data);
            $changes = "";
            for ($i = 0; $i < count($keys); $i++) {
                $changes .= $keys[$i] . "='" . $values[$i] . "',";
            }
            $changes = substr($changes, 0, -1);
            $cond = "id='{$id}'";
            $sql = "UPDATE {$table} SET {$changes} WHERE {$cond}";

            $stmt = $this->query($sql);
            $res = $stmt->execute();
            if ($res) {
                return true;
            }
        } else {
            return false;
        }
    }
    function updateWhere(string $table, array $data, $field, $fieldvalue)
    {
        if ($data) {
            $keys = array_keys($data);
            $values = array_values($data);
            $changes = "";
            for ($i = 0; $i < count($keys); $i++) {
                $changes .= $keys[$i] . "='" . $values[$i] . "',";
            }
            $changes = substr($changes, 0, -1);
            $cond = "{$field}='{$fieldvalue}'";
            $sql = "UPDATE {$table} SET {$changes} WHERE {$cond}";
            print $sql;
            $stmt = $this->query($sql);
            $res = $stmt->execute();
            if ($res) {
                return true;
            }
        } else {
            return false;
        }
    }

    function updateOneField($field, $value, $fieldWhere, $valueWhere)
    {
        $sql = "UPDATE {$this->table} SET {$field}={$value} WHERE {$fieldWhere}={$valueWhere}";
        $this->query($sql)->execute();
    }


    function remove($tbl, $id)
    {

        $sql = "DELETE FROM {$tbl} WHERE id='{$id}'";

        $stmt = $this->query($sql);
        $res = $stmt->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function removeRow($table, $field, $fieldvalue)
    {

        $sql = "DELETE FROM {$table} WHERE {$field}='{$fieldvalue}'";

        $stmt = $this->query($sql);
        $res = $stmt->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }




    /*

    function insert($table,$data):bool 
        {
            

            if (is_array($data)){
              $columns='';$bindv='';$values=null;
                foreach ($data as $column => $value) {
                    $columns.='`'.$column.'`,';
                    $bindv.='?,';
                    $values[]=$value;
                }
                $columns=substr($columns,0,-1);
                $bindv=substr($bindv,0,-1);

                $sql="INSERT INTO {$table}({$columns}) VALUES ({$bindv})";
                
                    try{
                        $stmt=$this->query($sql);
                        $stmt->execute($values);
                        return $this->pdo->lastInsertId();
                    }catch(\PDOException $e){
                        echo $e->getMessage();
                        return false;
                    }
                
                return true;
                }
                return false;
            }
    */
}
