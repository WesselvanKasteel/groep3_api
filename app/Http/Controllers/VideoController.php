<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Owenoj\LaravelGetId3\GetId3;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    private function publishVideo() {  
        // try {

        //     $user = User::where('id', '=', auth()->user()->id)->first();

        //     $file = str_replace('videos/', '', $user->videos[0]->path);

        //     $current_path = 'videos/' . $file;
        //     $move_path = 'public/videos/' .  $file;

        //     Storage::move($current_path, $move_path);

        //     $video = Video::where('path', '=', $current_path)->first();
        //     $video->update(array('path' => $move_path));

        //     return response()->json([
        //         'path' => 'http://127.0.0.1:8000/storage/videos/' . $file,
        //     ], 201);

        // } catch (\Throwable $th) {

        //     return response()->json([
        //         'message' => 'Something went wrong while publishing video.'
        //     ], 400);

        // }
    }

    public function store(Request $request)
    {
        $intro = new GetId3(request()->file('intro'));
        $length = $intro->getPlaytime();
        $size = round($request->file('intro')->getSize() / (1024*1024), 1);
        $extension = $request->file('intro')->extension();
        $result = $request->file('intro')->storeAs('videos', 'intro' . '' . '.' . $extension);

        Video::create([
            'name' => '1',
            'size' => $size,
            'length' => $length,
            'path' => $result,
        ]);

        $this->publishVideo();

        return response()->json([
            'Video successfully updated!' => $result,
            'User:' => auth()->user(),
        ]);
    }
}
