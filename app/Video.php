<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    public function metadata()
    {
        return $this->hasOne(VideoMetadata::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
