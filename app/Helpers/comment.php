<?php


use App\Models\comment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (!function_exists('createComment')) {

    function createComment()
    {

        if (Cache::has('comment-count')) {
            Cache::forget('comment-count');
        }

        $commentCount = Cache::remember('comment-count', 60, function () {
            return Comment::where('readed', '0')->count();
        });

        return $commentCount;
    }
}


if (!function_exists('comment')) {

    function comment()
    {
        if (!Cache::has('comment-count')) {
            createComment();
        }

        $comment = Cache::get('comment-count');
        $comment = $comment>0 ? $comment : "";

        return $comment;
    }
}
