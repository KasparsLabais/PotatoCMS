<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Mail\MailTrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CompaniesController extends Controller
{

/*    public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        $companies = Companies::paginate(10);
        return view('auth.companies')->with("companies", $companies);
    }

    public function addCompany(Request $request) {

        $valid = $request->validate([
            "name" => "required|max:100",
            "email" => "nullable|unique:companies|max:120",
            "logo" => "nullable|image|dimensions:min_width=100,min_height=100",
            "website" => "nullable|max:150"
        ]);

        $comp = new Companies();
        $comp->name = $request->get("name");

        if($request->get("email") != "") {
            $comp->email = $request->get("email");
        }

        if($request->get("website") != "") {
            $comp->website = $request->get("website");
        }

        $img = $_FILES["logo"];

        if($img["error"] == 0) {

            $temp = $img["tmp_name"];
            $name = $this->getImageName($img, $request->get("name"));


            move_uploaded_file($temp,public_path()."/img/".$name);
            $comp->logo = $name;
        }

        $comp->save();
        $this->sendEmailNotification( $request->get("name"));

        return redirect("/companies");
    }

    public function getCompany($id) {
        //we need get champions
        $payload = Companies::where("company_id", "=", $id)->first();
        $response = [
            "id" => $id,
            "payload" => $payload
        ];

        return view("auth.editor.company")->with("response", $response);
    }

    public function updateCompany(Request $request, $id) {

        $valid = $request->validate([
            "name" => "required|max:100",
            "email" => "nullable|max:120",
            "logo" => "nullable|image|dimensions:min_width=100,min_height=100",
            "website" => "nullable|max:150"
        ]);


        //check email because it is bad
        if($request->get("email") != "") {
            $email = Companies::where("email", "=", $request->get("email"))->where("company_id", "!=", $id)->first();

            if($email) {
                return redirect()->back()->withErrors(array("email" => "Email should be unique"));
            }

        }

        $edited = [
            "name" => $request->get("name"),
            "email" => $request->get("email"),
            "website" => $request->get("website"),
        ];

        $img = $_FILES["logo"];

        if($img["error"] == 0) {

            $temp = $img["tmp_name"];
            $name = $this->getImageName($img, $request->get("name"));


            move_uploaded_file($temp,public_path()."/img/".$name);
            $edited["logo"] = $name;
        }

        Companies::where("company_id", "=", $id)->update($edited);
        return redirect("/companies");
    }

    public function deleteCompany($id) {
        //we need delete company

        try {
            Companies::where("company_id", "=", $id)->delete();
        } catch (\Exception $e) {
            return response()->json(array("error"=> 1, "message" => $e->getMessage()), 500);
        }

        return;
    }

    private function getImageName($img, $name) {

        $imgArr = explode(".", $img["name"]);
        $ext = strtolower(end($imgArr));

        $name = bin2hex($name);  //fake name
        return $name.".".$ext;
    }

    private function sendEmailNotification($name) {
        Mail::to("admin@admin.com")->send(new MailTrap($name));
    }



}
