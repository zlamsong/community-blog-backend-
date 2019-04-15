<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use App\User;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{

    function __construct(){

        return $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get articles
         $articles = Article::orderBy('created_at', 'desc')->paginate(5);

         //return articles as a resource
         return ArticleResource::collection($articles);
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
        // $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;

        // $article->id = $request->input('article_id');
        // $article->title = $request->input('title');
        // $article->image = $request->input('image');
        // $article->body = $request->input('body');

        // if($article->save()){
        //     return new ArticleResource($article);
        // }

        $article = $request->user()->articles()->create($request->all());
        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
         //get a single article
        //  $article = Article::findOrFail($id);

         //return a single article as a resource
         return new ArticleResource($article);
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
    public function update(Request $request, Article $article)
    {
        if($request->user()->id !== $article->user_id){

            return response()->json(['error'=>'unauthorized action'], 401);
        }

        $article->update($request->all());

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // $article = Article::findOrFail($id);
        // if($article->delete()){
        //     return new ArticleResource($article);
        // }

        if(request()->user()->id !== $article->user_id){

            return response()->json(['error'=>'unauthorized action'], 401);
        }
        $article = $article->delete();

        return response()->json(null,200);
    }
}
