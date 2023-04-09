<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{
    public function index()
    {
        return view('autocomplete');
    }
    public function fetch(Request $request)
    {
        if($request->get('query')){

            $query = $request->get('query');
            $data = DB::table('countries')
            ->where('country_name', 'LIKE', "%{$query}%")
            ->get();

            if($data->count() > 0){

            $output = '<ul class="dropdown-menu" style="display: block; postition: relative; cursor: pointer;">';

            foreach ($data as $row) {
                $output .= '<li><a class="dropdown-item href="#"">'.$row->country_name.'</a><li>';
            }

            $output .='</ul>';
            echo $output;
        }else{
            $output = '<p class="text-danger ">No data found</p>';
            echo $output;
        }
        }
    }
}
