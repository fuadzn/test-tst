<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Book::all();
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
        try {
            $book = Book::create($request->all());
            Log::info('Book Created: ', ['book' => $book->id]);

            return response()->json($book, 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request = $request->toArray();
            $book = Book::findOrFail($id);
            $book->update($request);
            Log::info('Book Updated: ', ['book' => $book->id]);

            return response()->json($book);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Book::findOrFail($id)->delete();
            Log::info('Book Deleted: ', ['book' => $id]);

            return response()->json('Data Berhasil Dihapus', 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}