<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CollectionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $collection = new Collection();
        $collection->amount = $request->amount;
        $collection->payment_method = $request->payment_method;
        $collection->user_id = $request->user_id;
        $collection->save();
        return back()->with('success','Item successfully created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $collection = Collection::find($id);
        $collection->delete();
        return back()->with('success','Item successfully deleted');
    }
}
