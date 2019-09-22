<?php

namespace App\Services;

use App\Video;

class VideoService
{
    /**
     * Update video metadata
     *
     * @param Video $video
     * @param array $data
     * @return boolean
     */
    public function updateMetadata(Video $video, $data)
    {
        $video->metadata()->update([
            'viewers' => $data['viewers'],
            'size' => $data['size']
        ]);

        return true;
    }

    /**
     * Get video metadata
     *
     * @param Video $video
     * @return array
     */
    public function getMetadata(Video $video)
    {
        $video = $video->load('user', 'metadata');

        return [
            'size' => $video->metadata->size,
            'viewers' => $video->metadata->viewers,
            'created_by' => $video->user->username
        ];
    }
}
