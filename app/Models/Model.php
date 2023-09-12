<?php

namespace App\Models;

use App\Providers\Database;

class Model
{
    protected $db;

    public function __construct(){
        $this->db = new Database();
    }


}