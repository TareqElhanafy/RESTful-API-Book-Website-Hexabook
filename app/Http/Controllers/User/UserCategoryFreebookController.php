<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\Freebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserCategoryFreebookController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $user,Category $category)
    {
        $rules=[
            'name'=>'required',
            'writer_name'=>'required',
            'description'=>'required',
            'image'=>'required|image',
            
        ];


        $this->validate($request,$rules);
        $data=$request->all();
        $data['image']=$request->image->store('freebooks');
        $data['available']='0';
        $data['user_id']=$user->id;
        $data['category_id']=$category->id;

        $paidbook=Freebook::create($data);
        return $this->showOne($paidbook);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,Freebook $freebook)
    {
        $rules=[
            'image'=>'image',

        ];

        $this->validate($request,$rules);

        if ($user->id!==$freebook->user_id) {
            return $this->errorResponse(['error'=>'Sorry only tho owner can edit the product'],409);
            }

        $data=$request->only(['name','description','writer_name']);


if ($request->has('available')) {
    $freebook->available=$request->available;

       if ($freebook->isAvailable()&&$freebook->categories->count()==0) {
         return $this->errorResponse(['error'=>'This book has no categories'],409);
  
       }
    }
    if ($request->hasFile('image')) {
        Storage::delete($freebook->id);
        $image=$request->image->store('freebooks');
        $data['image']=$image;
    }
    // if ($product->isClean()) {
    //     return $this->errorResponse(['error'=>'please enter the specified data'],409);
    // }

    $freebook->update($data);
    return $this->showOne($freebook);

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user ,Freebook $freebook)
    {
        if ($user->id!==$freebook->user_id) {
            return $this->errorResponse(['error'=>'Sorry only tho owner can delete the book'],409);
            }
            $freebook->delete();
         
}
}
