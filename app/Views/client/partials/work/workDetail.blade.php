@extends('client.layouts.layout')

@section('content')
<div class="container col-8 mt-5">
    <span class="col-7 fs-34 fw-bold">Designing Dashboards with usability in mind</span>
    <div>
        <p class="d-flex mt-4 mb-4">
            <span class="text-date">
                <span class="text-white fs-5 mx-2 fw-bold">2020</span>
            </span>
            <a class="fs-30 text-secondary text-decoration-none fs-5 mx-4" href="#">Dashboard, User Experience Design</a>
        </p>
        <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
    </div>
    <div class="d-flex align-items-center justify-content-center mt-5 mb-5">
        <img src="{{ asset('img/detail1.png') }}" width="100%" height="100%">
    </div>
    <div class="fs-30 fw-500">Heading 1</div>
    <div class="fs-24 fw-500 mt-2">Heading 2</div>
    <p class="mt-3">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrudamet.</p>
    <div class="d-flex align-items-center justify-content-center mt-5 mb-5">
        <img src="{{ asset('img/detail2.png') }}" width="100%" height="100%">
    </div>
    <div class="d-flex align-items-center justify-content-center mt-5 mb-5">
        <img src="{{ asset('img/detail3.png') }}" width="100%" height="100%">
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
