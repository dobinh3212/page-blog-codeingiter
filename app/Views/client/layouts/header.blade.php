<nav class="navbar navbar-light hide-tag col-10 d-flex justify-content-end fw-bold fs-5 mb-5">
    <a class="nav-link text-dark" id="isActive" href="{{ route('/') }}">Dashboard</a>
    <a class="nav-link text-dark" id="isActiveBlog" href="{{ route('blog.blog') }}">Blog</a>
    <a class="nav-link text-dark" id="isActiveWork" href="{{ route('blog.work') }}">Works</a>
    <a class="nav-link text-dark" href="#">Contacts</a>
</nav>

<div class="collapse hide-navbar" id="navbarToggleExternalContent">
    <div class="bg-white d-flex justify-content-center">
        <div class="fw-bold fs-5">
            <a class="nav-link text-dark" href="{{ route('/') }}">Dashboard</a>
            <a class="nav-link text-dark" href="{{ route('blog.blog') }}">Blog</a>
            <a class="nav-link text-dark" href="{{ route('blog.work') }}">Works</a>
            <a class="nav-link text-dark" href="#">Contacts</a>
        </div>
    </div>
</div>

<nav class="navbar navbar-dark hide-navbar d-flex justify-content-end">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
