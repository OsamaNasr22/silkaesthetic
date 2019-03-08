
@extends('blog.layouts.master')

@section('content')
    <header>
        <h5 class="text-center">    <i class="fa fa-chevron-left"></i>
            WE ALWAYS HERE FOR YOU    <i class="fa fa-chevron-right"></i>
        </h5>
        @include('blog.includes.nav')
        <h3 class="text-center">WELCOME</h3>
    </header>
    <main>
       <our-work v-bind:category="{!! $category['id'] !!}"></our-work>
    </main>

@endsection

@section('style')



@endsection
@section('js')

@endsection