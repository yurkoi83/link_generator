<?php

namespace App\Http\Controllers;


use App\Http\Requests\LinkAddRequest;
use App\Link;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $links = Link::orderBy('id', 'desc')->paginate(10);
        return view('welcome', compact('links'));
    }

    /**
     * @param LinkAddRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addLink(LinkAddRequest $request): \Illuminate\Http\RedirectResponse
    {
        $link = new Link($request->all());
        $link->save();
        return Redirect::to(route('index'));
    }
}
