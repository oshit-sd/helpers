<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use App\Traits\ApiResponseTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use UploadTrait, ApiResponseTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['image' => 'mimes:jpg,png,jpeg|file']);
        try {
            $image = $request->file('image');
            $data['image'] = !empty($image) ? $this->upload($image, 'popup') : null;

            // Popup::create($data);
            return $this->sendResponse([], 200, 'Create Successfully!');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Popup $popup)
    {
        $data = $request->validate(['image' => 'mimes:jpg,png,jpeg|file']);
        try {
            $image = $request->file('image');
            $data['image'] = !empty($image) ? $this->upload($image, 'popup', $popup->image) : $this->oldFile($popup->image);

            // $popup->update($data);
            return $this->sendResponse([], 200, 'Update Successfully!');
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage(), 500);
        }
    }
}
