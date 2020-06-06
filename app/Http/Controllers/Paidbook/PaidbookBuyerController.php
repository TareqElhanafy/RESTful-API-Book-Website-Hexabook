<?php

namespace App\Http\Controllers\Paidbook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paidbook;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class PaidbookBuyerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Paidbook $paidbook)
    {
        if (Gate::denies('admin-user')) {
            throw new AuthorizationException('This action is unauthorized'); 
                   }
        $buyers=$paidbook->transactions()->with('buyer')
        ->get()
        ->pluck('buyer')
        ->unique('id')
        ->values();

        return $this->showAll($buyers);
    }

}
