<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Shortener;
use App\Helpers\Cipher;
use DB;
use App\Models\UrlModel;
class ShortCodeRepository implements ShortCodeRepositoryInterface{

    protected $cipher;
    public function __construct(Cipher $cipher){
        $this->cipher = $cipher;
    }
    public function all(){
        $shortLinks = Shortener::latest()->get()->map->format();
        return $shortLinks;
    }


    public function create($request){

        $request->validate([
            'long_url' => 'required|url'
        ]);
        $input['long_url'] = $request->long_url;
        $input['short_code'] = $this->generateUniqueCode();
        $data = "";
        //Check if url exist
        $check = UrlModel::where('long_url', $input['long_url'])->first();
        if(!$check){
            $data = Shortener::create($input);
            if($data){
                $url = new UrlModel();
                $url->shortener_id = $data->id;
                $url->long_url = $input['long_url'];
                $url->save();
            }
        }
        else{
            $data = $check->shortener;
        }
        return $data->format();
    }

    public function get($code){
        return Shortener::where('short_code', $code)
            ->first()
            ->map
            ->format();
    }

    function generateUniqueCode() {
        $code = \Str::Random(6);
        return ($this->shortCodeExist($code)) ? generateUniqueCode() : $code;
    }

    public function shortCodeExist($code){
        return Shortener::whereShortCode($code)->exists();
    }

}