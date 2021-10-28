@extends('layouts.app')

@section('content')
<admin-menu-editor :categories="{{ $categories }}"></admin-menu-editor>
@endsection