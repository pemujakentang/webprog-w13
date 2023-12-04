{{-- <x-app-layout> --}}
    <h1>{{ $title }} Buku</h1>
    <form action="/books/search" method="post">
        @csrf
        <input type="text" name="q">
        <button type="submit">Search</button>
    </form>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
    <table>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>User</th>
            <th>Tindakan</th>
            <th>Tindakan</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->description }}</td>
                <td>{{ $book->user->name }}</td>
                <td>
                    <a href="/books/{{ $book->id }}/edit">Edit</a>
                </td>
                <td>
                    <form action="/books/{{$book->id}}/delete" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('delete')
                        <button type="submit">DELETE</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
{{-- </x-app-layout> --}}
