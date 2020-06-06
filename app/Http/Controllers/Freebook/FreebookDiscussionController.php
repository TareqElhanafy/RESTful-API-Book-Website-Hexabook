<?php

namespace App\Http\Controllers\Freebook;

use App\Discussion;
use App\Freebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FreebookDiscussionController extends Controller
{
  

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Freebook $freebook)
    {
        $rules=[
            'title'=>'required',
            'content'=>'required',
            
        ];
        $this->validate($request,$rules);

        $data=request()->all();

        $data['freebook_id']=$freebook->id;
        $discussion=Discussion::create($data);
        return $this->showOne($discussion);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        $data=$request->only(['title','content']);
        $data=$request->all();
        $discussion->update($data);
        return $this->showOne($discussion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
        return $this->showOne($discussion);
    }
}
