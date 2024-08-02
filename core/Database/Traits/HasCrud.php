<?php

namespace Core\Database\Traits;

trait HasCrud
{
    protected function setFillables()
    {
        $fillables = [];
        foreach ($this->fillable as $attributes) {
            if (isset($this->$attributes)) {
                array_push($fillables, $attributes . "=?");
                $this->setValue($attributes, $this->$attributes);
            }
        }
        return implode(', ', $fillables);
    }

    protected function insert()
    {
        $this->setSql("insert into {$this->table} set" . $this->setFillables() .
            $this->create_at . "=Now();");
            $this->excuteQuery();
            $this->resetQuery();
    }

    protected function update()
    {
        $this->setSql("insert into {$this->table} set" . $this->setFillables() .
            $this->update_at . "=Now();");
            $this->setWhere("and ", $this->primaryKey." =? ");
            $this->setValue("and ",$this->primaryKey, $this->{$this->primaryKey});
            $this->excuteQuery();
            $this->resetQuery();
    }
}
