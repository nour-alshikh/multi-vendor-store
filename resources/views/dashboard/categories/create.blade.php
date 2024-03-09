@extends('layout.dashboard')

{{-- title --}}
@section('title', 'Categories')
{{-- end title --}}

{{-- breadcrumb --}}
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection
{{-- breadcrumb --}}

{{-- content --}}
@section('content')
    <div class="px-5">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('dashboard.categories._form')
        </form>
    </div>
@endsection
{{-- end content --}}
