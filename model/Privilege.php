<?php

class ModelPrivilege extends CRUD{
    protected $table = 'privileges';
    protected $primaryKey = 'privileges_id';
    protected $fillable = ['privileges'];
}

?>