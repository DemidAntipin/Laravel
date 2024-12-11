<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    public function index() {
        $books = Book::with('author')->get();
	return view('books.index', compact('books'));
    }

    public function show(Book $book) {
        // $book = Book::where('id', $id)->firstOrFail();

        // $book->author()->first();
        $book->load('author');

        return view('books.show', compact('book'));
    }

    public function create() {
        $book = new Book;
	$authors = Author::all();
        return view('books.create', compact("book", "authors"));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:256',
            'cost' => ['required'],
	    'author_id' => ['required','exists:authors,id']
        ], [
            'name.required' => 'Алё дэни, введи имя балваниус',
            'name.min' => 'А побольше нельзя?',
        ]);


        $book = Book::create($request->all());

        return redirect()->route('show_book', $book->id);
    }

    public function edit($id) {
	$book = Book::findOrFail($id);
	$authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);
	$request->validate([
            'name' => 'required|max:256',
            'cost' => ['required'],
	    'author_id' => ['required','exists:authors,id']
        ], [
            'name.required' => 'Алё дэни, введи имя балваниус',
            'name.min' => 'А побольше нельзя?',
        ]);
	$book->fill($request->all());
	$book->save();
	return redirect()->route('show_book', $book->id);
    }

    public function delete(Book $book) {
        $book->delete();

        return redirect()->route('books');
    }
}
