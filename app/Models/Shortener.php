<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Cipher;
class Shortener extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_code', 'long_url'
    ];

    public function setLongUrlAttribute($value){
        $cipher = new Cipher();
        $val = json_encode(["value" => $value]);
        $this->attributes['long_url'] = $cipher->encrypt($val);
    }


    public function getLongUrlAttribute($value){
        $cipher = new Cipher();
        return json_decode($cipher->decrypt($value))->value;
    }

    public function format(){
        return [
            'id' => $this->id,
            'long_url' => $this->long_url,
            'short_code' => $this->short_code,
            'created_at' => $this->created_at,
            'short_url' => request()->getHttpHost().'/'.$this->short_code,
        ];
    }

}
