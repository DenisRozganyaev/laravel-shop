<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\ICommentsRepository;

class CommentsRepository implements ICommentsRepository
{
    public function create(Comment $comment, string $model, int $id): Comment|bool
    {
        if (!class_exists($model)) {
            throw new \Exception("{$model} doesn't exists");
        }

        $model = new $model;
        $model = $model->find($id);
        return $model->comments()->save($comment);
    }
}
