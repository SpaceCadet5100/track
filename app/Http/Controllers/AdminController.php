<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Package;
use http\Client\Curl\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Picqer\Barcode\BarcodeGeneratorHTML;

class AdminController extends Controller
{
    protected $dates = [
        'pick_up_time',
        'checkDate',
        '$checkDate'
    ];
	public function index(){
		return view('admin');
	}


    public function pickUpPlanSystem() {
        $packages = Package::all()->where('sender_id', '=', Auth::id());
        $ValidPackages = [];
        foreach ($packages as $package){
         if($package->status != 'delivered' && $package->status != 'on the way' && $package->status != 'printed'){
             array_push($ValidPackages, $package);
         }
        }
        return view('pickUpPlanSystem')->with('packages', $ValidPackages);
    }

    public function changePickUp(Request $request) {
        if (count((array)$request->package) == 0) abort(404);
        $array = [];
        foreach($request->package as $id) {
            $packages = Package::find($id);
            array_push($array, $packages);
        }
        return view('changePickUp')->with('packages', $array);
    }
    public function ConfirmPickUpChange(Request $request)
    {
        $carbon = Carbon::now();
        $carbon = $carbon->addDays(1);
        $carbon = $carbon->addHour(9);

            $validated = $request->validate([
                'Country' => 'bail|required',
                'Srteetname' => 'required',
                'housenumber' => 'required|integer|min:1',
                'postalcode' => 'required|required|regex:/\b\d{4} [a-zA-Z]{2}\b/',
                'Country' => 'required',
                'City' => 'required',
                'Date' => 'required|after_or_equal:' . date($carbon),
            ]);

        foreach($request->package as $id) {
            $packages = Package::find($id);
            $idAddress = $this->makeAddress($this->getFirstname($packages->recipient_address_id), $this->getlastname($packages->recipient_address_id),$request->Country, $request->Srteetname, $request->housenumber, $request->postalcode, $request->City);
            $packages->recipient_address_id = $idAddress;
            $packages->pick_up_time = $request->Date;
            $packages->save();
        };
        $packagesss = Package::all()->where('sender_id', '=', Auth::id());

        return view('pickUpPlanSystem')->with('packages', $packagesss);
    }

    public function makeAddress($Fistname, $Lastname, $country, $StreetName, $HouseNumber, $PostalCode, $City){
        $Query = DB::table('addresses')
            ->where('country', '=',$country)
            ->where('street_name', '=',$StreetName)
            ->where('house_number', '=',$HouseNumber)
            ->where('postal_code', '=',$PostalCode)
            ->where('city', '=',$City)
            ->where('firstname', '=', $Fistname)
            ->where('lastname', '=', $Lastname)
            ->first();
        if($Query != null){
            $address = $Query;
        }else{
            $address = new Address();
            $address->country = $country;
            $address->street_name = $StreetName;
            $address->house_number = $HouseNumber;
            $address->postal_code = $PostalCode;
            $address->city = $City;
            $address->firstname = $Fistname;
            $address->lastname = $Lastname;
            $address->save();
        }
        return $address->id;
    }

    private function getFirstname(int $recipientAddress_id)
    {
        $address = DB::table('addresses')->where('id', $recipientAddress_id)->first();
       return $address->firstname;
    }
    private function getlastname(int $recipientAddress_id)
    {
        $address = DB::table('addresses')->where('id', $recipientAddress_id)->first();
        return $address->lastname;
    }

}
