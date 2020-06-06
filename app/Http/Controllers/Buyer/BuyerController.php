<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class BuyerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('can:view,buyer')->only(['show']);

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
        $buyers=Buyer::has('transactions')->get();
        return $this->showAll($buyers);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buyer=Buyer::has('transactions')->findOrFail($id);
        return $this->showAll($buyer);
    }

    


}
