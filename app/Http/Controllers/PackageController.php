<?php

namespace App\Http\Controllers;

use App\Models\Package;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function index(){
    return view('create-labels');
    }

    public function allPackages(){
       $lc = new LabelController();
       $packages = Package::filter(request(['status', 'time']))->paginate(10);
       $packages = $lc->labelGeneratorWithGuestLink($packages);
       return view('all-packages')->with('packages', $packages);
    }

    public function store(Request $request)
    {
	$validator = Validator::make([], []);
	$validated = $request->validate([
        'api-calls' => 'required',
	    ]);
	
	try{	
	$str_arr = explode(',', $request->input('api-calls'));  
	if(count($str_arr) > 0){
	foreach($str_arr as $call){
		$response = Http::get($call);
		$statusCode = $response->status();
		$responseBody = json_decode($response->getBody(), true);

		if(!is_numeric($responseBody)){
		throw new ErrorException();
		}
	}}}
	catch(\Exception $e){
	$validator->errors()->add(
		'api-call', 'Wrong syntax!');
	return Redirect::back()->withErrors($validator)->withInput();
	}
        return redirect(Route('create-labels'));
    }

    public function outgoingPackages() {

    $lc = new LabelController();
    $packages = Package::where('sender_id', '=', Auth::id())->filter(request(['status', 'time']))->paginate(10);
    $packages = $lc->labelGeneratorWithGuestLink($packages);
    return view('outgoing-packages')->with('packages', $packages);
    }

    public function incomingPackages() {

    $lc = new LabelController();
    $packages = Package::where('recipient_id', '=', Auth::id())->filter(request(['status', 'time']))->paginate(10);
    $packages = $lc->labelGeneratorWithGuestLink($packages);

    return view('incoming-packages')->with('packages', $packages);
    }

    public function guestPackage($id)
    {
    try{
	    $lc = new LabelController();
	    $package = Package::find(base64_decode($id));
	    $package = $lc->labelGenerator($package);
		    return view('package')->with('package', $package);
	    }
		    catch(\Exception $e){
		    abort(404);
	    }
    }
}
