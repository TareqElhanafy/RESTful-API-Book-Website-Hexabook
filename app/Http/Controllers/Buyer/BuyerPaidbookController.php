<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paidbook;

class BuyerPaidbookController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('can:view,buyer')->only(['index']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $paidbooks=$buyer->transactions()->with('paidbook')
        ->get()
        ->pluck('paidbook');
        return $this->showAll($paidbooks);
    }

}
