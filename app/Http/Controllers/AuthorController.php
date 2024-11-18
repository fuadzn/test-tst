<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Author::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5',
        ]);
        try {
            $author = Author::create($request->all());
            Log::info('Author Created: ', ['author' => $author->id]);

            return response()->json($author, 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);
        return response()->json($author);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request = $request->toArray();
        $author = Author::findOrFail($id);
        $author->update($request);
        Log::info('Author Updated: ', ['author' => $author->id]);

        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Author::findOrFail($id)->delete();
            Log::info('Author Deleted: ', ['author' => $id]);

            return response()->json('Data Berhasil Dihapus', 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function authorBook($id)
    {
        $author = Author::with('book')->findOrFail($id);
        return response()->json($author);
    }
}