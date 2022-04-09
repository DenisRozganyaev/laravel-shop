<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());

        $model = $request->get('model_class');
        $model = new $model;
        $model = $model->find($request->get('model_id'));
        $model->comments()->save($comment);

        return back();
    }

    public function reply(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->parent_id = $request->get('parent_id');
        $comment->user()->associate($request->user());

        $model = $request->get('model_class');
        $model = new $model;
        $model = $model->find($request->get('model_id'));
        $model->comments()->save($comment);

        dd($comment);
        return back();
    }
}
