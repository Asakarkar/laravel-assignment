<h1>Book List</h1>
<table border="1">
    <tr>
        <th>Title</th><th>Author</th><th>Pages</th><th>Published</th><th>Available</th>
    </tr>
    @foreach($books as $book)
    <tr>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->pages }}</td>
        <td>{{ $book->published_date }}</td>
        <td>{{ $book->is_available ? 'Yes' : 'No' }}</td>
    </tr>
    @endforeach
</table>