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
<div class="container">
    <div class="post-detail" style="border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>

        <div class="post-timestamp" style="font-size: 0.9em; color: #666;">
            @if($post->published_at)
                {{ \Carbon\Carbon::parse($post->published_at)->format('d M, Y H:i') }}
            @else
                Not published
            @endif
        </div>

        <h3>Comments</h3>
        <div class="comments-section">
            @if($post->comments->count() > 0)
                @foreach ($post->comments as $comment)
                    <div class="comment" style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
                        <strong>{{ $comment->user_name }}:</strong> {{ $comment->content }}
                    </div>
                @endforeach
            @else
                <p>No comments found.</p>
            @endif
        </div>

        <!-- Форма для добавления нового комментария (опционально) -->
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <label for="comment">Add a comment:</label>
                <textarea name="content" id="comment" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

</body>
</html>
