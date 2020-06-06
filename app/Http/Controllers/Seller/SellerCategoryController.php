<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seller;

class SellerCategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('can:view,seller')->only(['index']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $categories=$seller->paidbooks()->with('categories')
        ->get()
        ->pluck('categories')
        ->collapse();

        return $this->showAll($categories);
    }

}
