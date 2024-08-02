<?php

namespace Core\Database\ORM;

use Core\Database\Traits\HasAttributes;
use Core\Database\Traits\HasCrud;
use Core\Database\Traits\HasQueryBuilder;

abstract class Model 
{
    use HasQueryBuilder;
    use HasAttributes;
    use HasCrud;


    protected $table;

    protected $fillable = [];

    protected $hidden = [];

    protected $casts = [];

    protected $primaryKey = 'id';

    protected $createdAt = 'created_at';

    protected $updatedAt = 'updated_at';

    protected $deleteAt = null;

    protected $collection = [];


}