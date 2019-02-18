<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = "employees";
    protected $primaryKey = "employee_id";

    protected $fillable = [
        "first_name", "last_name", "company_id", "email", "phone"
    ];


    public function company() {
        $this->hasOne("App\Companies", "company_id");
    }
}
