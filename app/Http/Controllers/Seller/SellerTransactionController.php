<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class SellerTransactionController extends Controller
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
    public function index(Seller $seller)
    {
      if (Gate::denies('admin-user')) {
        throw new AuthorizationException('This action is unauthorized'); 
               }
      $transactions=$seller->paidbooks()->whereHas('transactions')->with('transactions')
      ->get()
      ->pluck('transactions')
      ->collapse();
      return $this->showAll($transactions);
    }

}
