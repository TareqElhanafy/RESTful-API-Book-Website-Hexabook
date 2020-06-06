<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paidbook;
use App\Seller;
use App\User;
use Illuminate\Support\Facades\Storage;

class SellerPaidbookController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('can:view,seller')->only(['index']);
        $this->middleware('can:edit,seller')->only(['update']);
        $this->middleware('can:delete,seller')->only(['destroy']);
        $this->middleware('can:sale,seller')->only(['store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
            $products=$seller->products;
            return $this->showAll($products);   
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $seller)
    {
        $rules=[
            'name'=>'required',
            'writer_name'=>'required',
            'description'=>'required',
            'quantity'=>'required|integer|min:1',
            'image'=>'required|image',
            'price'=>'required|integer'
            
        ];
        

        $this->validate($request,$rules);
        $data=$request->all();
        $data['image']=$request->image->store('paidbooks');
        $data['available']='0';
        $data['seller_id']=$seller->id;
        $paidbook=Paidbook::create($data);
        return $this->showOne($paidbook);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller,Paidbook $paidbook)
    {
        $rules=[
            'quantity'=>'min:1|integer',
            'image'=>'image',
            'price'=>'required|integer'

        ];

        $this->validate($request,$rules);

        if ($seller->id!==$paidbook->seller_id) {
            return $this->errorResponse(['error'=>'Sorry only tho owner can edit the product'],409);
            }

        $data=$request->only(['name','description','quantity','price','writer_name']);


if ($request->has('available')) {
    $paidbook->available=$request->available;

       if ($paidbook->isAvailable()&&$paidbook->categories->count()==0) {
         return $this->errorResponse(['error'=>'This product has no categories'],409);
  
       }
    }
    if ($request->hasFile('image')) {
        Storage::delete($paidbook->id);
        $image=$request->image->store('paidbooks');
        $data['image']=$image;
    }
    // if ($product->isClean()) {
    //     return $this->errorResponse(['error'=>'please enter the specified data'],409);
    // }

    $paidbook->update($data);
    return $this->showOne($paidbook);

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller ,Paidbook $paidbook)
    {
        if ($seller->id!==$paidbook->seller_id) {
            return $this->errorResponse(['error'=>'Sorry only tho owner can delete the product'],409);
            }
            $paidbook->delete();
         
}
