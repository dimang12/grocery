@extends('layouts.app')

@section('title','- Main category')


@section('content')
<ul class="row">
    <li class="col-12  list-unstyled">
        <h3 class="title pb-lg-4 mb-lg-4 border-bottom">
            Main Sections
        </h3>
    </li>
    @foreach ($categories as $cate)
    <li class="list-unstyled col-3">
        <a href="{{route('category')}}/{{$cate->id}}" class="btn btn-outline-primary w-100">
            {{ $cate->category_name}}
        </a>
    </li>
    @endforeach
</ul>
<category-manager :initial-categories="{{$categories}}"></category-manager>
@endsection