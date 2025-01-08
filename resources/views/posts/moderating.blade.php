<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    @extends('layout')

    @section('content')
        <h1 class="mb-4">Suspicious Posts</h1>

    <!-- Кнопка для создания нового поста -->
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-4">Create New Post</a>

@if ($posts->count() > 0)
    <div class="post-list">
        @foreach ($posts as $post)
            <div class="post-item" style="border: 1px solid #ccc; margin-bottom: 15px; padding: 15px; border-radius: 5px; position: relative;">
                <!-- Кнопки редактирования и удаления -->
                <div class="post-actions" style="position: absolute; top: 10px; right: 10px; display: flex; gap: 5px;">
                    <!-- Кнопка редактирования -->
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-pencil-alt"></i> <!-- Иконка карандаша -->
                    </a>

                    <!-- Кнопка удаления -->
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this post?')" style="display:inline;">
                            <i class="fas fa-times"></i> <!-- Иконка крестика -->
                        </button>
                    </form>
                </div>

                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p> <!-- Предполагается, что у вас есть поле 'content' для текста поста -->

                <!-- Кнопка публикации/снятия с публикации -->
                <div class="post-publish-action">
                        <form action="{{ route('posts.check', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">Publish</button>
                        </form>
                        <form action="{{ route('posts.unpublish', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                        </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No published posts found.</p>
@endif
    @endsection
</body>
</html>
