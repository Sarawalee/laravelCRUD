<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = movie::all();
        return view('movie.index', compact('movies'));
    }

    /**
     * Show search page.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('movie.search');
    }

    /**
     * Get search result.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchresult(Request $request)
    {
        $response = Http::get('http://www.omdbapi.com', [
            'apiKey' => '32f246bc',
            's' => $request->title,
            'page' => 1
        ]);
        $movies = $response->json();
        // print_r($result);
        return view('movie.search', compact('movies'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'title' => $request->title,
            'year' => $request->year,
            'imdbId' => $request->imdbid,
            'type' => $request->type,
            'poster' => $request->poster
        );

        Movie::create($data);

        return response()->json(['success'=>'Insert movie success!!!.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = array(
            'title' => $request->title,
            'year' => $request->year,
            'imdbId' => $request->imdbid,
            'type' => $request->type
        );

        Movie::updateOrCreate(['id' => $request->mid], $data); 
        
        return redirect('/movie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Movie::find($id)->delete();
        return redirect('/movie');
    }
}
