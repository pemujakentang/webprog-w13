<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::all();
        $title = "INDEX";

        return view('books.index', ['books' => $books, 'title' => $title]);
    }

    public function admin()
    {
        //
        $books = Book::all();
        $title = "ADMIN INDEX";

        return view('books.admin', ['books' => $books, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (Auth::user()) {

            if(!Gate::allows('create-book')){
                abort('403');
            }

            $validData = $request->validate([
                'title' => 'required',
                'description' => 'required'
            ]);

            // $validData['user_id'] = Auth::id();
            // $validData['user_id'] = Auth::user()->id;
            $validData['user_id'] = auth()->user()->id;

            // dd($validData);
            Book::create($validData);
            return redirect('/books');
            
        }else{
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
        if(!Gate::allows('update-book', $book)){
            return 'BUKU INI BUKAN PUNYAMU';
        }else{
            return view('books.edit', ['book'=>$book]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
        if (Auth::user()) {

            $validData = $request->validate([
                'title' => 'required',
                'description' => 'required'
            ]);

            // dd($validData);
            $book->update($validData);
            return redirect('/books');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        // dd($book);
        if (auth()->user()->role_id == 1) {
            $book->delete();
            return redirect('/admin/books');
        }else{
            return redirect('/books');
        }
        
    }
}
