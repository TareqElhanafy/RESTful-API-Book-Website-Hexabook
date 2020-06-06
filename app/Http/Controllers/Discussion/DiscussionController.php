<?php

namespace App\Http\Controllers\Discussion;

use App\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['client.credentials'])->only(['index','show']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions=Discussion::all();
        return $this->showAll($discussions);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return $this->showOne($discussion);
    }

}
