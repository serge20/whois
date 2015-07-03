<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpWhois\Whois;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

	/**
	 * Who is form
	 *
	 * @return Response
	 */
	public function who(Request $request)
	{
		$tableDomains = [];
		if ($request->isMethod('post')) {
			$input = $request->all();
			$domains = preg_split('/\r\n|[\r\n]/', $input['domains']);
			$tableDomains = [];
			foreach ($domains as $domain) {
				array_push($tableDomains, $this->getWhoIs($domain));
			}
		}

		return view('whois', array('domainList' => $tableDomains));
	}

	/**
	 * Whois function
	 *
	 * @reponse Whois Information
	 */
	private function getWhoIs($domain)
	{
		$whois = new Whois();
		$query = $domain;
		$result = $whois->lookup($query,true);
		$info['email'] = null;
		$info['expires'] = null;
		$info['expires'] = $result['regrinfo']['domain']['expires'];

		foreach ($result['rawdata'] as $rawData) {

			$arr_info = explode(':', $rawData);

			if(!array_key_exists(1,$arr_info)){
				continue;
			}

			if(strpos(strtolower($arr_info[0]), 'registrant email') !== false)
			{
				$info['email'] = $arr_info[1];
				break;
			}

			$info['domain'] = $domain;
		}

		return $info;
	}

}
