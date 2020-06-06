<?php

namespace App\Http\Controllers\Paidbook;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paidbook;

class PaidbookCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['client.credentials'])->only(['index']);
        $this->middleware(['auth:api'])->except(['index']);
        $this->middleware(['can:delete,paidbook'])->only(['destroy']);
        $this->middleware(['can:update,paidbook'])->only(['update']);

    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paidbook $paidbook,Category $category)
    {
        $paidbook->categories()->syncWithoutDetaching($category->id);
        return $this->showAll($paidbook->categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paidbook $paidbook , Category $category)
    {
        if (!$paidbook->categories()->find($category->id)) {
           return $this->showMessage(['message'=>'this catgory is not related to this product'],409); 
        }
        $paidbook->categories()->detach($category->id);
        return $this->showAll($paidbook->categories);
        
   }
}
