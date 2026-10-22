<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['lesson_id', 'title', 'order'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class)->orderBy('order');
    }
}
