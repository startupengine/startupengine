<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function addPost() {
        return view('app.research.add');
    }

    public function saveResearchItem(Request $request) {
        $researchitem = new \App\ResearchItem();
        $researchitem->url = $request->input('url');
        $researchitem->user_id = \Auth::user()->id;
        $researchitem->save();
        return redirect ('/app/research');
    }

    public function saveResearchCollection(Request $request) {
        $researchitem = new \App\ResearchCollection();
        $researchitem->name = $request->input('name');
        $researchitem->user_id = \Auth::user()->id;
        $researchitem->save();
        return redirect ('/app/research');
    }

    public function saveResearchFeed(Request $request) {
        $researchfeed= new \App\ResearchFeed();
        $researchfeed->url = $request->input('url');
        $researchfeed->user_id = \Auth::user()->id;
        $researchfeed->save();
        return redirect ('/app/research');
    }
}
