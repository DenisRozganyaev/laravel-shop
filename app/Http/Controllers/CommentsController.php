<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Repositories\Contracts\ICommentsRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, ICommentsRepository $repository)
    {
        $comment = new Comment();
        $comment->body = $request->get('body');
        $comment->user()->associate($request->user());

        $repository->create(
            $comment,
            $request->get('model_class'),
            $request->get('model_id')
        );

        return redirect()->back();
    }

    public function reply(Request $request, ICommentsRepository $repository)
    {
        $comment = new Comment();
        $comment->body = $request->get('body');
        $comment->parent_id = $request->get('parent_id');
        $comment->user()->associate($request->user());

        $repository->create(
            $comment,
            $request->get('model_class'),
            $request->get('model_id')
        );

        return redirect()->back();
    }
}
