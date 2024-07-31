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
    <form action="/posts/update/<?php echo e($posts->id); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <ul>
            <li>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo e($posts->title); ?>">
            </li>
            <li>
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="<?php echo e($posts->slug); ?>">
            </li>
            <li>
                <label for="description">description</label>
                <input type="text" id="description" name="description" value="<?php echo e($posts->description); ?>">
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
</html><?php /**PATH D:\CRUD app Laravel Flutter\backend\resources\views/blog/edit.blade.php ENDPATH**/ ?>