<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;

class TransactionSellerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('can:view,transaction')->only(['index']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $seller=$transaction->paidbook->seller;
return $this->showOne($seller);
    }

}
