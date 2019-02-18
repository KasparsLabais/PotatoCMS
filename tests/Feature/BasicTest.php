<?php

namespace Tests\Feature;

use App\Companies;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicTest extends TestCase
{

    public function testHasAdmin() {
        /*
         * We can see if seeder has been done
         */
        $this->assertDatabaseHas("users", ["email" => "admin@admin.com"]);
    }

    public function testCompany() {

        $data = [
            'name' => "amazing",
            'email' => "email@email.com",
        ];

        /*
         * TODO: Should use factory
         */

        $company = Companies::create($data);

        $this->assertEquals($data["name"], $company["name"]);
        $this->assertEquals($data["email"], $company["email"]);

        Companies::where("company_id", "=", $company["company_id"])->delete();
    }

}
