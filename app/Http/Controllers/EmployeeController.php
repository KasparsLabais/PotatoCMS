<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

/*    public function __construct()
    {
        $this->middleware("auth");
    }*/

    public function index(){
        $companies = Companies::all(); //could use select as we need only id / name
        $emp = Employees::paginate(10);
        return view("auth.employees", ["employees" => $emp, "companies" => $companies]);
    }



    public function addEmployee(Request $request){

        $request->validate([
            "first_name" => "required|max:80",
            "last_name" => "required|max:80",
            "company_id" => "required|integer",
            "email" => "nullable|email|max:120",
            "phone" => "nullable|max:35",
        ]);

        try {
            $req = $request->all();
            Employees::create($req);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array("message" => $e->getMessage()));
        }

        return redirect()->back();
    }

    public function getEmployee($id) {
        //we need get champions
        $payload = Employees::where("employee_id", "=", $id)->first();
        $companies = Companies::all();
        $response = [
            "id" => $id,
            "payload" => $payload,
            "companies" => $companies
        ];

        return view("auth.editor.employee")->with("response", $response);
    }

    public function updateEmployee(Request $request, $id) {
        $request->validate([
            "first_name" => "required|max:80",
            "last_name" => "required|max:80",
            "company_id" => "required|integer",
            "email" => "nullable|email|max:120",
            "phone" => "nullable|max:35",
        ]);

        try {

            $req = $request->all();
            Employees::where("employee_id", "=", $id)->update([
                "first_name" => $req["first_name"],
                "last_name" => $req["last_name"],
                "company_id" => $req["company_id"],
                "email" => $req["email"],
                "phone" => $req["phone"]
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array("message" => $e->getMessage()));
        }

        return redirect()->back();
    }

    public function deleteEmployee($id) {
        try {
            Employees::where("employee_id", "=", $id)->delete();
        } catch (\Exception $e) {
            return response()->json(array("error"=> 1, "message" => $e->getMessage()), 500);
        }

        return;
    }

}
