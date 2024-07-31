<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
</head>
<body>
    <h1>Edit</h1>
    <form action="/posts/update/{{ $posts->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <ul>
            <li>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ $posts->title }}">
            </li>
            <li>
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="{{ $posts->slug }}">
            </li>
            <li>
                <label for="description">description</label>
                <input type="text" id="description" name="description" value="{{ $posts->description }}">
            </li>
            <li>
                <label for="image">Image</label>
                <input type="file" id="image" name="image" accept="image/*">
            </li>
            <li>
                <Button type="submit">Update</Button>
            </li>
        </ul>
    </form>
</body>
</html>