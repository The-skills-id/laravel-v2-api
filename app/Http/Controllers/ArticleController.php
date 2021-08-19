<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::select('*')->orderBy('created_at', 'desc')->get();

        if($data)
        {
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'status' => 'fail',
        ], 404);
    }

    public function getArticleById($id)
    {
        $data = Article::where('id', $id)->get();

        if($data != [])
        {
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'status' => 'fail',
        ], 404);
    }
}
