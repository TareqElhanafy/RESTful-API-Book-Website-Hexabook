<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class SellerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('can:view,seller')->only(['show']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('admin-user')) {
            throw new AuthorizationException('This action is unauthorized'); 
                   }
        $sellers=Seller::has('paidbooks')->get();
        return $this->showAll($sellers);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller=Seller::has('paidbooks')->findOrFail($id);
        return $this->showAll($seller);
    }

}
