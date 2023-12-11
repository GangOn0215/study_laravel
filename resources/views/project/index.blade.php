@extends('layouts/layout')

@section('link')
    @vite('resources/css/project/project.css')
@endsection

@section('content')
    <section class="project-container">
        <div class="items">
            <a href="/todos">
                todos
            </a>
        </div>
        <div class="items tiktok">
            <a href="/tiktok">
                tiktok
            </a>
        </div>
        <div class="items">
            <a href="/instagram">
                instagram
            </a>
        </div>
        <div class="items">4</div>

        <div class="items">1</div>
        <div class="items">2</div>
        <div class="items">3</div>
        <div class="items">4</div>
    </section>
@endsection
