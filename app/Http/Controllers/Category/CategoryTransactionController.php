<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class CategoryTransactionController extends Controller
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
    public function index(Category $category)
    {
      if (Gate::denies('admin-user')) {
        throw new AuthorizationException('This action is unauthorized'); 
               }
      $transactions=$category->paidbooks()->whereHas('transactions')
      ->with('transactions')
        ->get()
        ->pluck('transactions');

        return $this->showAll($transactions);
    }

}
