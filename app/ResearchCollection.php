<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchCollection extends Model
{
    public function items() {
        return $this->hasMany('App\ResearchItem');
    }

    public function saveItem(Request $request) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $researchitem = new \App\ResearchItem;
            $researchitem->title = $request->input('title');
            $researchitem->slug = $request->input('slug');
            $researchitem->excerpt = $request->input('excerpt');
            $researchitem->body = $request->input('body');
            $researchitem->status = $request->input('status');
            $researchitem->author_id = \Auth::user()->id;
            if($request->input('status') == null) {
                $researchitem->status = 'DRAFT';
            }
            if($request->input('publish') == "on") {
                $researchitem->status = "PUBLISHED";
            }
            $researchitem->save();
            return redirect('/app/content');
        }

        else { abort(500); }
    }
}
