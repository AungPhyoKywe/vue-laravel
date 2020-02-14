<?php

namespace App\Http\Controllers;

use App\Http\Resources\APIResource;
use App\Post;
use App\postes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpaController extends Controller
{
    public function index()
    {
        return view('spa');
    }

    public function getData()
    {
        $post=Post::paginate(3);
        $articles=APIResource::collection($post);

        return $articles;

    }
    public  function store(Request $request)
    {

        $articles=new Post();
        $articles->name=$request->name;
        $articles->save();

        for($i = 0;$i<count($request->posts);$i++)
        {
            $post=new postes();
            $post->articles_id=$articles->id;
            $post->description=$request->posts[$i]['name'];
            $post->save();
        }

        return response()->json(['message' => $request->posts]);

    }

    public function destroy($id)
    {
             DB::table('articles')
            ->leftJoin('posts','articles.id','=','posts.articles_id')
            ->where('articles.id',$id)->delete();
             postes::where('articles_id',$id)->delete();


        return response()->json(['message' => 'task was delete successful']);
    }
    public function edit($id)
    {
        $post=DB::table('articles')
            ->leftJoin('posts','articles.id','=','posts.articles_id')
            ->where('articles.id',$id)->get();

        return $post;
    }
}
