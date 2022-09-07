<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

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
        'name',
        'conent',
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

    public function posts()
    {
        return $this->belongsTo(Post::class, 'foreign_key');
    }
}
