<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\d111811135_news;
use Illuminate\Support\Facades\Validator;

class d111811135_newsController extends Controller
{
    public function index()
    {
        $d111811135_news = d111811135_news::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data d111811135_news',
            'data'    => $d111811135_news
        ], 200);
    }

    public function show($id)
    {
        $d111811135_news = d111811135_news::findOrfail($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Data d111811135_news',
            'data'    => $d111811135_news
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'img_url' => 'required',
            'sub_desc'   => 'required',
            'desc' => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //save to database
        $d111811135_news = d111811135_news::create([
            'title' => $request->title,
            'img_url' => $request->img_url,
            'sub_desc' => $request->sub_desc,
            'desc' => $request->desc

        ]);
        if ($d111811135_news) {
            return response()->json([
                'success' => true,
                'message' => 'd111811135_news Created',
                'data' => $d111811135_news
            ], 201);
        }
    }
    public function update(Request $request, d111811135_news $d111811135_news)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'img_url' => 'required',
            'sub_desc'   => 'required',
            'desc' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $d111811135_news = d111811135_news::findOrFail($d111811135_news->id);
        if ($d111811135_news) {
            $d111811135_news->update([
                'title' => $request->title,
                'img_url' => $request->img_url,
                'sub_desc' => $request->sub_desc,
                'desc' => $request->desc
            ]);
            return response()->json([
                'success' => true,
                'message' => 'd111811135_news Update',
                'data' => $d111811135_news
            ], 200);
        }
    }
    public function destroy($id)
    {
        $d111811135_news = d111811135_news::findOrFail($id);

        if ($d111811135_news) {
            $d111811135_news->delete();
            return response()->json([
                'success' => true,
                'success' => 'd111811135_news Deleted',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'd111811135_news Not Found',
        ], 404);
    }
}
