<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();
        $size = $request->query('size');
        $books = $query->get();
        if ($size) {
            $books = $query->paginate($size);
        }

        return BookResource::collection($books);
    }

    /**
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'isbn' => 'required|string|min:3|unique:books',
            'auteur' => 'required|string|min:3',
            'titre' => 'required|string|min:3',
            'price' => 'required|numeric|min:10',
            'discovering_date' => 'required|date_format:"Y-m-d"'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->failed(), 400);
        }

        $book = Book::create($request->all());
        if ($book) {
            return new BookResource($book);
        }

        throw new \Exception('Unexpected Error');
    }

    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function showWithIsbn(string $isbn)
    {
        $book = Book::where('isbn', $isbn)->first();

        if (! $book) {
            return response()->json(['error' => 'isbn'], 400);
        }

        return new BookResource($book);
    }

    /**
     * @throws \Exception
     */
    public function update(Request $request, Book $book)
    {
        $validate = Validator::make($request->all(), [
            'isbn' => 'required|string|min:3|unique:books,' . $book->id,
            'auteur' => 'required|string|min:3',
            'titre' => 'required|string|min:3',
            'price' => 'required|numeric|min:10',
            'discovering_date' => 'required|date_format:"Y-m-d"'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->failed(), 400);
        }

        if ($book->update($request->all())) {
            $book->flash();
            return new BookResource($book);
        }

        throw new \Exception('Unexpected Error');
    }

    /**
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        if ($book->delete()) {
            return ['data' => $book->id];
        }

        throw new \Exception('Unexpected Error');
    }
}
