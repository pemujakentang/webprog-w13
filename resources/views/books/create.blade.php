<x-app-layout>
    <h1>Create New Book</h1>
    <form action="/books/new" method="post">
        @csrf
        <p>Judul:</p>
        <input type="text" name="title" id="">
        <br>
        <p>Keterangan:</p>
        <textarea name="description" id=""></textarea>
        <br>
        <button type="submit">Submit</button>
    </form>
</x-app-layout>