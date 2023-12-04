<x-app-layout>
    <h1>Create New Book</h1>
    <form action="/books/{{$book->id}}/update" method="post">
        @method('put')
        @csrf
        <p>Judul:</p>
        <input type="text" name="title" id="" value="{{$book->title}}">
        <br>
        <p>Keterangan:</p>
        <textarea name="description" id="">{{$book->description}}</textarea>
        <br>
        <button type="submit">Submit</button>
    </form>
</x-app-layout>