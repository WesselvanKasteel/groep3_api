<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Owenoj\LaravelGetId3\GetId3;
use Webpatser\Uuid\Uuid;

use App\Models\Vacancy;
use App\Models\Video;
use App\Models\User;

use Illuminate\Support\Facades\Storage;

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
        $size = round($request->file('file')->getSize() / (1024*1024), 1);

        // saving video entry in db 
        $video = new Video;
        $video->path = "http://127.0.0.1:8000/storage/videos/" . $file_name . $file_code . '.webm';
        $video->size = $size;
        $video->save();

        return response()->json([
            'message' => 'video succesfully saved',
            'path' => "http://127.0.0.1:8000/storage/videos/" . $file_name . $file_code . '.webm',
            'db' => $db_video,

        ], 200);

    }

    public function updateProfile(Request $request) {

        $id = auth()->user()->id;
        $user = User::with('videos')->where('id', $id)->first();

        $user_video_id = null;

        foreach ($user->videos as $video) {;
            if (str_contains($video->path, 'intruduction')) {
                $user_video_id = $video->id;
            }
        }

        if ($user_video_id !== null) {
            $user->videos()->detach($user_video_id);

            $old_video = Video::where('id', '=', $user_video_id)->first();
            $old_video->delete();

            Storage::delete(str_replace('http://127.0.0.1:8000', '', $old_video->path));
        }

        $file_code = Uuid::generate();
        $video_path = $request->file('file')->storeAs('public/videos', 'intruduction_' . $file_code . '.webm');

        // analyse video 
        $track = new GetId3(request()->file('file'));
        $size = round($request->file('file')->getSize() / (1024*1024), 1);

        // saving video entry in db 
        $video = Video::create([
            'id' => Uuid::generate(),
            'path' => "http://127.0.0.1:8000/storage/videos/" . 'intruduction_' . $file_code . '.webm',
            'size' => $size,
        ]);

        $user->assignVideo($video);

        return response()->json([
            'message' => 'video succesfully saved',
            'path' => "http://127.0.0.1:8000/storage/videos/" . 'intruduction_' . $file_code  . '.webm',
        ], 200);
    }
}
