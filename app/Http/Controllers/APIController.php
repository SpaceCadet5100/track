<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{

    function insert(Request $request)
    {
        if (!$this->authenticate($request->key)) return 'false';
        if($this->checkIfExist($request->recipient) == false){
            return 'false';
        }else{
            $package = new Package();
            $accrecipient = $this->getUser($request->recipient);
            $package->recipient_id = $accrecipient->id;
            $package->recipient_address_id = $this->makeAddress($request->FirstnameRecipient, $request->LastnameRecipient, $request->RecipientCountry, $request->RecipientStreetName, $request->RecipientHouseNumber, $request->RecipientPostalCode, $request->RecipientCity);
            $package->sender_address_id = $this->makeAddress($request->FirstnameSender, $request->LastnameSender, $request->SenderCountry, $request->SenderStreetName, $request->SenderHouseNumber, $request->SenderPostalCode, $request->SenderCity);
            $package->EmailRecipient = $request->recipient;
            $package->EmailSender = $request->sender;
            $package->email_recipient= $request->recipient;
            if($this->checkIfExist($request->sender)) {
                $accsender = $this->getUser($request->sender);
                $package->sender_id = $accsender->id;
            }
            if($package->save()){
                return $package->id;
            }else{
                return 'false';
            }
        }
    }

    function ChangeStatus(Request $request){
        if (!$this->authenticate($request->key)) return 'false';
        $status = null;
        switch ($request->status) {
            case 'signed up':
                $status = 'signed up';
                break;
            case 'printed':
                $status = 'printed';
                break;
            case 'delivered':
                $status = 'delivered';
                break;
            case 'sorting centre':
                $status = 'sorting centre';
                break;
            case 'on the way':
                $status = 'on the way';
                break;
            }
            if($status != null && $this->packageExist($request->packageID)){
                DB::table('packages')->where('id', $request->packageID)->update(['status'=>$status]);
                return 'true';
            }else{
                return 'false';
            }
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

    public function getUser($email){
        return DB::table('users')->select('id')->where('email', $email)->first();
    }

    public function checkIfExist($email){
        if($email != null){

            $user = DB::table('users')->where('email', $email)->first();

            if ($user === null) {
                return false;
            }else{
                return true;
            }
        }
    }

    public function getAddress(int $senderID)
    {
        $addressID = DB::table('addresses')->where('user_id', $senderID)->first();
            return $addressID->id;
    }

    private function packageExist(int $packageID)
    {
        $package = DB::table('packages')->where('id', $packageID)->first();
        if($package == null){
            return false;
        }else{
            return true;
        }
    }

    private function authenticate($key){
	    try{User::where('email', '=', base64_decode($key))->firstOrFail(); 
		    return true;
	    }
	    catch (\Exception $e){
		 return false; 
	    }
    }
}
