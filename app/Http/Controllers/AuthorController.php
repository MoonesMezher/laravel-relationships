<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::with('books')->get();

        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());

        if ($request->has('book_ids')) {
            $author->books()->attach($request->book_ids);
        }
        return response()->json($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author->load('books');

        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        if ($request->has('book_ids')) {
            $author->books()->sync($request->book_ids);
        }

        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->books()->detach();
        $author->delete();

        return response()->json($author, 204);
    }
}
