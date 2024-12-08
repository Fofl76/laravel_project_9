<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::paginate(6);
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'date' => 'date',
            'name' => 'required|min:5|max:100',
            'desc' => 'required|min:5'
        ]);
        $article = new Article;
        $article -> date = $request-> date;
        $article -> name = $request-> name;
        $article -> desc = $request-> desc;
        $article -> user_id = 1;
        if ($article->save())
        return redirect('/article')->with('status', 'Update succsess!');
    else
        return redirect('')->route('article.edit', ['article' => $article->id])->with('status', 'Update failed! Please try again.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $comments = Comment::where('article_id',$article->id)->get();
        $user = User::findOrFail($article -> user_id);
        return view('article.show', ['article' => $article, 'user' => $user, 'comments'=>$comments]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('article.update', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request -> validate([
            'date' => 'date',
            'name' => 'required|min:5|max:100',
            'desc' => 'required|min:5'
        ]);
        $article -> date = $request-> date;
        $article -> name = $request-> name;
        $article -> desc = $request-> desc;
        $article -> user_id = 1;
        if ($article->save()) return redirect('/article')->with('status','Update success');
        else return redirect()->route('article.index')->with('status','Update don`t success'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->delete())
        return redirect('/article')->with('status', value: 'Delete succsess!');
    else
        return redirect('')->route('article.show', ['article' => $article->id])->with('status', 'Delete failed! Please try again.');
    }
}
