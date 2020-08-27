<?php

namespace App\Http\Controllers\Drive;

use App\FileStore\Drive;
use App\FileStore\MediaFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Drive $drive
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Drive $drive)
    {
        abort_unless($request->user()->can('view', $drive), 403);

        return $this->view('drives.media-files.index', compact('drive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Drive $drive
     * @return void
     */
    public function create(Drive $drive)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Drive $drive
     * @return void
     */
    public function store(Request $request, Drive $drive)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return void
     */
    public function show(Drive $drive, MediaFile $mediaFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return void
     */
    public function edit(Drive $drive, MediaFile $mediaFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return void
     */
    public function update(Request $request, Drive $drive, MediaFile $mediaFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Drive $drive
     * @param \App\FileStore\MediaFile $mediaFile
     * @return void
     */
    public function destroy(Drive $drive, MediaFile $mediaFile)
    {
        //
    }
}
