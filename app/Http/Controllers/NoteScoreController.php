<?php

namespace App\Http\Controllers;

use App\Models\NoteScore;
use Illuminate\Http\Request;

class NoteScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'star' => 'required',
            'id'=>'required'
        ]);
        NoteScore::create([
            'user_id'=>$request->user()->id,
            'note_id'=>$request->id,
            'score'=>$request->star,
            'time'=>now()
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NoteScore  $noteScore
     * @return \Illuminate\Http\Response
     */
    public function show(NoteScore $noteScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NoteScore  $noteScore
     * @return \Illuminate\Http\Response
     */
    public function edit(NoteScore $noteScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NoteScore  $noteScore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NoteScore $noteScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoteScore  $noteScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(NoteScore $noteScore)
    {
        //
    }
}
