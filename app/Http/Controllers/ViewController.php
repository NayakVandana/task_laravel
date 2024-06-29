<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
class ViewController extends Controller
{
  

    public function view()
    {
        try {
            $client = new Client();
            $url = 'http://devapi.hidoc.co:8080//TrendingPastCases/PastCases';
    
            $response = $client->post($url, [
                'form_params' => [
                    'action' => 'getTrendingCasesCP',
                    'userId' => 586,
                    'lastCount' => 0,
                    'searchKeyword' => 'Cance'
                ]
            ]);
    
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
    
            if (!empty($data['TrendingCasesCP'])) {
                session()->flash('success', 'Data retrieved successfully');
                return redirect()->route('home')->with('data', $data);
            } else {
                session()->flash('error', 'No data found');
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
            return redirect()->route('home');
        }
    }
    
 
    
}