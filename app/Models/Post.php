<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'writer_id',
        'category_id',
        'content',
        'reply',
        'others'
    ];

    // table users
    public function user()
    {
        return $this->belongsTo(Auth::class, 'foreign_key');
    }

    // table category
    public function category()
    {
        return $this->belongsTo(Category::class, 'foreign_key');
    }

    // table comments
    public function comments()
    {
        return $this->hasMany(Comment::class, 'foreign_key');
    }
}
