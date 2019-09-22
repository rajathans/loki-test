<?php

namespace App\Http\Controllers;

use App\Services\VideoService;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new VideoService;
    }

    /**
     * Get video metadata
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getMetadata(Request $request)
    {
        $video = Video::find($request->video_id);
        if (!$video) {
            return response([
                'status' => false,
                'message' => 'Invalid video id',
                'data'  => []
            ], 400);
        }

        $data = $this->service->getMetadata($video);

        return response([
            'status'    => true,
            'message'   => '',
            'data'      => $data
        ]);
    }

    /**
     * Update video metadata
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateMetadata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video_id'  => 'required|exists:videos,id',
            'size'      => 'required|integer',
            'viewers'   => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response([
                'status'    => false,
                'message'   => 'Invalid request.',
                'data'      => [],
                'errors'    => $validator->errors()
            ]);
        }

        $video = Video::find($request->video_id);
        $this->service->updateMetadata($video, $request->all());

        return response([
            'status'    => true,
            'message'   => 'Successfully updated',
            'data'      => []
        ]);
    }
}
