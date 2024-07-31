<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create</title>
</head>
<body>
    <h1>Create</h1>
    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <ul>
            <li>
                <label for="title">Title</label>
                <input type="text" id="title" name="title">
            </li>
            <li>
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug">
            </li>
            <li>
                <label for="description">description</label>
                <input type="text" id="description" name="description">
            </li>
            <li>
                <label for="image">Image</label>
                <input type="file" id="image" name="image" accept="image/*">
            </li>
            <li>
                <Button type="submit">Submit</Button>
            </li>
        </ul>
    </form>
</body>
</html>