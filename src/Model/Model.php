<?php

namespace App\Model;

use App\Database\QueryBuilder;
use App\Container;

abstract class Model
{
    protected QueryBuilder $qb;
    protected string $table;
    //array de claus-valors
    protected array $data;
    protected array $condition;
    protected int $id;

    public function __construct(array $data = null)
    {
        //nom taula associada i constructor de consultes
        $reflect = new \ReflectionClass($this);
        $this->table = strtolower($reflect->getShortName()) . 's';
        $this->qb = Container::get('query');
        $this->qb->setTable($this->table);
        if ($data) {
            $this->data = $data;
        }
    }

    public function get(): array
    {
        return $this->data;
    }

    function save()
    {
        $this->qb->update($this->table, $this->data, $this->id);
    }

    function persist()
    {
        if ($this->data) {
            try {
                $this->qb->insert($this->data)->exec();
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    function getAll()
    {
        $items = $this->qb->select(['*'])->from($this->table)->exec()->fetch();
        return $items;
    }

    function find($condition)
    {
        $k = array_keys($condition);
        $v = array_values($condition);
        $items = $this->qb->select(['*'])->from($this->table)->where([$k[0] => $v[0]])->exec()->fetch();
        return $items;
    }
}
    //$this->qb->setStmt($this->qb->query($this->qb->getQuery()));