<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\Movie as MovieResource;
use App\Http\Resources\MovieCollection;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;
use Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(new MovieCollection(Movie::get()), 200);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->title = $request['title'];
        $movie->description = $request['description'];
        $movie->release_date = $request['release_date'];
        $movie->url = $this->fileUpload($request);
        $movie->user_id = Auth::user()->id;
        $movie->save();

        return response([
            'id' => $movie->id,
            'success' => true
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::where('id', $id)->first();
        if(!$movie){return response(['message' => 'Movie not found!'], 400);}
        return response(new MovieResource($movie), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $movie = Movie::where('id', $id)->first();
         if(!$movie){return response(['message' => 'Movie not found!'], 400);}
         if($request->file('movie_file')){$movie->url = $this->fileUpload($request);}
         if($request['title']){$movie->title = $request['title'];}
         if($request['description']){$movie->description = $request['description'];}
         if($request['release_date']){$movie->release_date = $request['release_date'];}
         $movie->save();
 
         return response(['success' => true], 200); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::where('id', $id)->first();
        if(!$movie){return response(['message' => 'Movie not found!'], 400);}
        $movie->delete();

        return response(['success' => true], 200);
    }

    private function fileUpload($request){
        $user = User::where('id', Auth::user()->id)->first();
        $f_name = str_replace(' ', '_', $user->name);
        $l_name = str_replace(' ', '_', $user->last_name);
        $temp_name = str_replace(' ', '_', time()."_".$user->id);
        $theFileName = $temp_name.'.'.request()->movie_file->getClientOriginalExtension();
    
        $s3 = \Storage::disk('local');
        $filePath = 'movie/'.$user->id.'-'.$f_name.'-'.$l_name.'/'.$theFileName;
        $s3->put($filePath, file_get_contents($request->file('movie_file')), 'public');
        return $filePath;
    }
}
