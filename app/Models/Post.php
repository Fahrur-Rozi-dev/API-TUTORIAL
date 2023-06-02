<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    
    protected $fillable = [
        'title',
        'text_content',
        'author',
    ];

    public function writter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }  
}
