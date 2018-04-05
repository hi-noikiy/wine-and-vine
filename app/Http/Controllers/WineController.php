<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;

class WineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|Collection
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return Wine::all();
        }

        $wines = Wine::paginate(config('wine-and-vine.data.pagination'));

        return view('pages.wines.index')
            ->with(['wines' => $wines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wine  $wine
     * @return Response|array
     */
    public function show(Wine $wine)
    {
        if (request()->expectsJson()) {
            return [
                'id' => $wine->id,
                'name' => $wine->name,
                'year' => $wine->year,
                'short_description' => $wine->short_description,
                'description' => $wine->description,
                'slug' => $wine->slug,
                'quantity_in_stock' => $wine->quantity_in_stock,
            ];
        }

        return view('pages.wines.show', ['wine' => $wine]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wine  $wine
     * @return Response
     */
    public function edit(Wine $wine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wine  $wine
     * @return Response
     */
    public function update(Request $request, Wine $wine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wine  $wine
     * @return Response
     */
    public function destroy(Wine $wine)
    {
        //
    }
}
