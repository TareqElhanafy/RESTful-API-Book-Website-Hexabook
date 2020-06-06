<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;

class TransactionCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['client.credentials'])->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $categories=$transaction->paidbook->categories;
        return $this->showAll($categories);
    }

}
