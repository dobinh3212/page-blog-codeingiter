<div class="mt-5 bg-content mb-5">
    <div class="post container">
        <div class="row mb-5 py-5">
            <div class="col-6 d-flex">
                <p class="fs-4">Recent posts</p>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="nav-link fs-5 d-flex justify-content-end hide-tag" href="{{ route('blog.blog') }}">View all</a>
            </div>
            @foreach ($posts as $post)
            <div class="col-6 d-flex">
                <div class="p-5 bg-white mt-2 custom-text-left">
                    <a class="fs-26 fw-bold text-dark text-decoration-none" href="{{ route('post.postDetail', ['slug' => $post['slugs']]) }}">{{$post['title']}}</a>
                    <div class="mb-3 mt-2">
                        <span class="me-2">{{$post['created_at']->format('d M Y')}}</span>
                        <span class="me-2">|</span>
                        @foreach ($post->categorys as $category)
                        @if($category->type == 1)
                        <a class="text-dark text-decoration-none" href="{{ route('blog.blog') . '?' . http_build_query(['category' => $category->name]) }}">{{$category->name}}, </a>
                        @endif
                        @endforeach
                    </div>
                    <p class="w-60">{{$post['description']}}.</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
