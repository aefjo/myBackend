<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
</head>
<body>
    <h1>INDEX</h1>
    <a href="/posts/create">Add</a>
    <table>
        <thead>
            <tr>
                <th>title</th>
                <th>slug</th>
                <th>description</th>
                <th>image</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->description }}</td>
                <td><img style="width: 50px" src="http://127.0.0.1:8000/storage/post-images/{{ $post->image }}" alt="" srcset=""></td>
                <td>
                    <a href="/posts/edit/{{ $post->id }}">Edit</a> || 
                    <form action="/posts/delete/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>