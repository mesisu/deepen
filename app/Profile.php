<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'name' => 'required',
        'body' => 'required',
    );
    
        public function user()
    {
      return $this->belongsTo('App\User');

    }
}
