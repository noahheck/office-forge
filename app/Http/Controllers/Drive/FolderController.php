<?php

namespace App\Http\Controllers\Drive;

use App\FileStore\Drive;
use App\FileStore\Folder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Drive $drive)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Drive $drive)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Drive $drive)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder, Drive $drive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder, Drive $drive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drive $drive, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileStore\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drive $drive, Folder $folder)
    {
        //
    }
}
