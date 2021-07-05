<?php

namespace App\Repositories;
use Illuminate\Http\Request;
interface ShortCodeRepositoryInterface{
    public function all();
    public function create(Request $request);
    public function get($code);
    public function shortCodeExist($code);

}