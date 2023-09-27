@extends('client.layouts.layout')

@section('content')
<div class="container col-12">
    <div class="d-flex justify-content-center">
        <div class="col-7">
            <span class="fs-44 fw-bold">Blog</span>
            @foreach($posts as $post)
            <div class="mt-5 border-bottom">
                <a class="fs-30 fw-500 text-dark text-decoration-none" href="{{ route('post.postDetail', ['slug' => $post['slugs']]) }}">{{$post->title}}</a>
                <div class="mb-2 mt-3 d-flex">
                    <span class="me-3">{{$post['created_at']->format('d M Y')}}</span>
                    <span class="me-3">|</span>
                    @foreach ($post->categorys as $category)
                    @if($category->type == 1)
                    <a class="text-secondary text-decoration-none" href="{{ route('blog.blog') . '?' . http_build_query(['category' => $category->name]) }}">{{$category->name}}, &nbsp</a>
                    @endif
                    @endforeach
                </div>
                <p class="w-60">{{$post['description']}}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var elementToModify = document.getElementById("isActiveBlog");
        if (elementToModify) {
            elementToModify.classList.add("isActive");
        }
    });
</script>
@endsection
