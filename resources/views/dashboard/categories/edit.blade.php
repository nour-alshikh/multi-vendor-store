@extends('layout.dashboard')

{{-- title --}}
@section('title', 'Edit Category')
{{-- end title --}}

{{-- breadcrumb --}}
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Edit Category</li>
@endsection
{{-- breadcrumb --}}

{{-- content --}}
@section('content')
    <div class="px-5">
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('dashboard.categories._form')
        </form>
    </div>
@endsection
{{-- end content --}}
