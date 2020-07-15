<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'body');

    public function category()
    {
        return $this->belongsTo('Category');
    }
/*    public function category()
    {
        return $this->belongsTo('Category');
    }
*/
}
