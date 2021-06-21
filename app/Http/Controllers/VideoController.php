<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Owenoj\LaravelGetId3\GetId3;
use Webpatser\Uuid\Uuid;

use App\Models\Vacancy;
use App\Models\Video;

class VideoController extends Controller
{
    public function store(Request $request) {

        $vacancy = Vacancy::with('users')->where('code', '=', $request->code)->first();
        $code = $vacancy->code;
        $file_code = Uuid::generate();

        $file_name =  $request->filename . '_';
        $video_path = $request->file('file')->storeAs('public/videos', $file_name . $file_code . '.webm');

        // dit veranderen naar de video die ook gekoppeld is aan de user
        $db_video = Video::where('path', '=', "http://127.0.0.1:8000/storage/videos/" . $file_name . $code . '.webm')->first();

        // check if entry already exists
        if ($db_video !== null ) {
            $db_video->delete();
        }

        // analyse video
        $track = new GetId3(request()->file('file'));
        $duration = $track->getPlaytime();
        $size = round($request->file('file')->getSize() / (1024*1024), 1);

        // saving video entry in db 
        $video = new Video;
        $video->path = "http://127.0.0.1:8000/storage/videos/" . $file_name . $file_code . '.webm';
        $video->size = $size;
        $video->duration = $duration;
        $video->save();

        return response()->json([
            'message' => 'video succesfully saved',
            'path' => "http://127.0.0.1:8000/storage/videos/" . $file_name . $file_code . '.webm',
            'db' => $db_video,

        ], 200);

    }
}
