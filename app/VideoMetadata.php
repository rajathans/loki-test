<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoMetadata extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'video_metadata';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'video_id', 'size', 'viewers',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
