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
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($post->title); ?></td>
                <td><?php echo e($post->slug); ?></td>
                <td><?php echo e($post->description); ?></td>
                <td><img style="width: 50px" src="http://127.0.0.1:8000/storage/post-images/<?php echo e($post->image); ?>" alt="" srcset=""></td>
                <td>
                    <a href="/posts/edit/<?php echo e($post->id); ?>">Edit</a> || 
                    <form action="/posts/delete/<?php echo e($post->id); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH D:\CRUD app Laravel Flutter\backend\resources\views/blog/index.blade.php ENDPATH**/ ?>