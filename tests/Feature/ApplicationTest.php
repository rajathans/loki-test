<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    /**
     * Test total video size endpoint.
     *
     * @return void
     */
    public function testGetTotalVideoSizeForUser()
    {
        $user = factory(\App\User::class)->create();

        $video1 = $user->videos()->save(factory(\App\Video::class)->make());
        $video1metadata = $video1->metadata()->save(factory(\App\VideoMetadata::class)->make());
        $video2 = $user->videos()->save(factory(\App\Video::class)->make());
        $video2metadata = $video2->metadata()->save(factory(\App\VideoMetadata::class)->make());

        $total_size = $video1metadata->size + $video2metadata->size;

        $response = $this->get('api/users/metrics?username='. $user->username);

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['data' => [
            'total_size' => $total_size
        ]]);
    }

    /**
     * Test get video metadata endpoint.
     *
     * @return void
     */
    public function testGetVideoMetadata()
    {
        $user = factory(\App\User::class)->create();

        $video = $user->videos()->save(factory(\App\Video::class)->make());
        $videometadata = $video->metadata()->save(factory(\App\VideoMetadata::class)->make());

        $response = $this->get('api/videos?video_id='. $video->id);

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['data' => [
            'size' => $videometadata->size,
            'viewers' => $videometadata->viewers,
            'created_by' => $user->username
        ]]);
    }

    /**
     * Test update video endpoint.
     *
     * @return void
     */
    public function testUpdateVideo()
    {
        $user = factory(\App\User::class)->create();

        $video = $user->videos()->save(factory(\App\Video::class)->make());
        $video->metadata()->save(factory(\App\VideoMetadata::class)->make());

        $response = $this->patch('api/videos?video_id='. $video->id, ['size' => 280, 'viewers' => 890]);

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Successfully updated"]);
    }

}
