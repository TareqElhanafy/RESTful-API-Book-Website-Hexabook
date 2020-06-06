<?php

namespace App\Http\Controllers\Paidbook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UserCreated;
use App\Paidbook;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PaidbookBuyerTransactionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('can:purchase,buyer')->only(['store']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Paidbook $paidbook,User $buyer)
    {
        $rules=[
            'quantity'=>'required|integer|min:1'
        ];

        $this->validate($request,$rules);
        
        if (!$paidbook->isAvailable()) {
            return $this->errorResponse(['error'=>'this product is not available !'],409);
        }
       
        if (!$buyer->isVerified()) {
            return $this->errorResponse(['error'=>'you are  not verified'],409);

        }
        if (!$paidbook->seller->isVerified()) {
            return $this->errorResponse(['error'=>'sorry the owner is restricted'],409);

        }
     
        if ($request->quantity > $paidbook->quantity) {
            return $this->errorResponse(['error'=>'sorry the product is limited'],409);
        }
        
       return DB::transaction(function() use ($request,$paidbook,$buyer){

            $paidbook->quantity-=$request->quantity;
            $paidbook->save();
            $transaction=Transaction::create([
                'buyer_id'=>$buyer->id,
                'paidbook_id'=>$paidbook->id,
                'quantity'=>$request->quantity
            ]);
            return $this->showOne($transaction);
        });


    }

 
}
