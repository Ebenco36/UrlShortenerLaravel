<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shortener;
use App\Repositories\ShortCodeRepositoryInterface;
class ShortLinkController extends Controller
{

    protected $short_link;
    public function __construct(ShortCodeRepositoryInterface $short_link){
        $this->short_link = $short_link;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = $this->short_link->all();
        return response()->json(['message' => 'Records fetched successfully', 'data' => $shortLinks]);
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->short_link->create($request);
        return response()->json(['success' => 'Shorten Link Generated Successfully!', "data" => $data]);
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $find = $this->short_link->get($code);
        return redirect($find->long_url);
    }

    public function statistics($code)
    {
        $find = $this->short_link->get($code);
        return response()->json(['success' => 'Shorten Link Generated Successfully!', "data" => $find]);
    }
}
