<?php

namespace App\Http\Controllers\Paidbook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paidbook;
use PDORow;

class PaidbookController extends Controller
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
        $paidbooks=Paidbook::all();
        return $this->showAll($paidbooks);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Paidbook $paidbook)
    {
        return $this->showOne($paidbook);
    }

}
