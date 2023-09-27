@extends('client.layouts.layout')

@section('content')
<div class="container col-8 mt-5">
    <span class="fs-44 fw-bold">Work</span>
    <div class="mt-5 activeList">
        @for ($i = 0; $i < 4; $i++)
            <div class="col-12 d-flex border-bottom">
                <div class="col-3">
                    <img class="rounded" src="{{ asset('img/rectangle3.png') }}" width="90%" height="91%">
                </div>
                <div class="col-9 d-flex align-items-center">
                    <div>
                        <a class="fs-30 fw-bold text-dark text-decoration-none" href="{{ route('blog.workDetail', ['id' => 1]) }}">Designing Dashboards</a>
                        <p class="d-flex mt-2 mb-2">
                            <span class="text-date">
                                <span class="text-white fs-5 mx-2 fw-bold">2020</span>
                            </span>
                            <a class="fs-30 text-secondary text-decoration-none fs-5 mx-4" href="#">Dashboard</a>
                        </p>
                        <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var elementToModify = document.getElementById("isActiveWork");
        if (elementToModify) {
            elementToModify.classList.add("isActive");
        }
    });
</script>
@endsection
