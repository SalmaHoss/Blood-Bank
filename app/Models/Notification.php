<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'body');

    public function donationRequest()
    {
        return $this->belongsTo('DonationRequest');
    }

}
