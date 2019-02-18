<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{

    protected $table = "companies";
    protected $primaryKey = "company_id";

    protected $fillable = [
        "name", "email", "logo", "website"
    ];

    public function employee() {
        $this->hasMany("App\Employees", "company_id");
    }

}
