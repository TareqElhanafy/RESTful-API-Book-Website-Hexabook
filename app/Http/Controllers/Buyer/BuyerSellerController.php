<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerSellerController extends Controller
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
        $sellers=$buyer->transactions()->with('paidbook.seller')
        ->get()
        ->pluck('paidbook.seller')
        ->unique()
        ->values();
        return$this->showAll($sellers);
    }

}
