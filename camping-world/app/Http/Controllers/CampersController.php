<?php

namespace App\Http\Controllers;

use App\Imports\CamperImport;
use Illuminate\Http\Request;
use App\Models\Camper;
use Maatwebsite\Excel\Facades\Excel;

class CampersController extends Controller
{
    /**
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $campers = Camper::all();
        return view('index', ['campers' => $campers]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function importCSV(Request $request)
    {
        $request->validate([
            'uploadedFile' => 'required|file|mimes:csv'
        ]);
        Excel::import(new CamperImport, $request->file('uploadedFile')->store('temp'));
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchAndFilter(Request $request)
    {
        //todo add validation that also allows for empty strings too
            if(isset($request->direction) && isset($request->column)) {
                switch ($request->direction) {
                    case "asc":
                        $query= Camper::orderBy($request->column);
                        break;
                    case "desc":
                        $query= Camper::orderByDesc($request->column);
                        break;
                    default:
                        $query= Camper::all();
                        break;
                }
                $results = $query->get();
            } else {
                $results = Camper::search($request->term)->get();
            }

            return response()->json([
                'data' => $results
            ]);
    }
}
