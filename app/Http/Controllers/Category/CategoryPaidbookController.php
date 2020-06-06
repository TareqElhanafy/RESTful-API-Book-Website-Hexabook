<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryPaidbookController extends Controller
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
    public function index(Category $category)
    {
        $paidbooks=$category->paidbooks;
        return $this->showAll($paidbooks);
    }

}
