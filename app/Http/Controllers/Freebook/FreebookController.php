<?php

namespace App\Http\Controllers\Freebook;

use App\Freebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FreebookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['client.credentials'])->only(['index','show']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freebooks=Freebook::all();
        return $this->showAll($freebooks);
    }


  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Freebook $freebook)
    {
        return $this->showOne($freebook);
    }

}
