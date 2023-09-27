@extends('client.layouts.layout')

@section('content')
<div class="container">
    <div class="body flex-grow-1 px-5">
        <div class="card-body d-flex justify-content-center">
            <div class="mb-3 col-7">
                <span class="fs-34 fw-bold">{{$post->title}}</span>
                <div>
                    <p class="d-flex mt-4">
                        <span class="text-date">
                            <span class="text-white fs-5 mx-2 fw-bold">{{$post['created_at']->format('Y')}}</span>
                        </span>
                        @foreach ($post->categorys as $category)
                        @if($category->type == 1)
                        <a class="text-secondary text-decoration-none fs-5 ms-2" href="{{ route('blog.blog') . '?' . http_build_query(['category' => $category->name]) }}">{{$category->name}}, </a>
                        @endif
                        @endforeach
                    </p>
                    <p class="d-flex mt-2 mb-4">
                        @foreach ($post->categorys as $category)
                        @if($category->type == 2)
                        <a style="color:#2b77e7" class="text-decoration-none ms-1" href="{{ route('blog.blog') . '?' . http_build_query(['tag' => $category->name]) }}">#{{$category->name}}&nbsp</a>
                        @endif
                        @endforeach
                    </p>
                </div>
                {!! $post->content !!}
            </div>
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
