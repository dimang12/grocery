@extends('layouts.app')

@section('title')
Main category
@endsection

@section('content')
<ul class="row">
    @foreach ($categories as $cate)
    <li class="list-unstyled col-3">
        <a href="{{ route('category')}}" class="btn btn-outline-primary w-100">
            {{ $cate->category_name}}
        </a>
    </li>
    @endforeach

</ul>
@endsection