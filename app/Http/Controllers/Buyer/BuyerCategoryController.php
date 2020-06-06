<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerCategoryController extends Controller
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
        $categories=$buyer->transactions()->with('paidbook.categories')
        ->get()
        ->pluck('paidbook.categories')
        ->collapse()
        ->unique()
        ->values();
        return $this->showAll($categories);
    }

}
