<?php

namespace Core\Database\Traits;
use Core\Database\DBConnection\DBConnection;

trait HasQueryBuilder
{
    private $sql = '';
    //select * from users where ... orderBy ... ASC limit 3
    private $where = [];
    private $orderBy = [];
    private $limit = [];
    private $values = [];
    private $bindingValues = [];
    
    protected function getSql()
    {
        return $this->sql;
    }

    protected function setSql(string $sql)
    {
        $this->sql = $sql;
    }

    protected function resetSql()
    {
        $this->sql = "";
    }
    protected function setWhere($oterator, $condition)
    {
        $a = ['operator' => $oterator, 'condition' => $condition];
        array_push($this->where, $a);    
    }
    protected function resetWhere()
    {
        $this->where = [];
    }
    protected function setOrderBy($key, $experssion)
    {
        array_push($this->orderBy, $key . ' ' .$experssion);
    }
    protected function resetOrderBy()
    {
       $this->orderBy = [];
    }
    protected function setLimit($from, $number)
    {
        $this->limit['from'] = $from;
        $this->limit['number'] = (int) $number;
    }
    protected function resetLimit()
    {
      unset($this->limit['from']);
      unset($this->limit['number']);
    }

    protected function setValue($attribute, $value)
    {
        $this->values[$attribute] = $value;
        array_push($this->bindingValues, $value);
    }

    protected function resetValues()
    {
        $this->values = [];
        $this->bindingValues = [];
    }

    protected function resetQuery()
    {
        $this->resetSql();
        $this->resetWhere();
        $this->resetValues();
        $this->resetLimit();
        $this->resetOrderBy();
    }

    protected function excuteQuery()
    {
        $query = "";
        $query .= $this->sql;

        if(!empty($this->where)){
            $whereQuery = "";
            foreach($this->where as $where){
                $whereQuery == "" ? $whereQuery .= $where['condition'] : $whereQuery .= ' '.$where['operation'] ." ". $where['condition']; 
            }
            $query .= " where ".$whereQuery;
        }

        if(!empty($this->orderBy)){
            $query .= 'order by '. implode(',', $this->orderBy);

        }

        if(!empty($this->limit)){
            $query .= 'limit '.$this->limit['number'].' offset '. $this->limit['offset'];

        }
        $query .= " ;";
        $pdoInstance = DBConnection::getDBConnectionInstance();
        $statement = $pdoInstance->prepare($query);
        
        //where id > 10 and id =20 and cat_id = 2
        //$this->value = [id=>]

        if(sizeof($this->bindingValues) > sizeof($this->vlaues)){
            sizeof($this->bindingValues) > 0 ? $statement->execute($this->bindingValues) : $statement->execute();
        }else{
            sizeof($this->values) > 0 ? $statement->execute($this->values) : $statement->execute();
        }
        return $statement;
    }
}