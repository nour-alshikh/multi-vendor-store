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
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Category Name</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ $category->name }}">
            </div>
            <div class="mb-3">
                <label for="parent_id">Parent Category</label>
                <select id="parent_id" name="parent_id" class="form-control">
                    <option value="">Parent Category</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="status">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active"
                        @checked($category->status == 'active') />
                    <label class="form-check-label" for="flexRadioDefault1">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="archived"
                        @checked($category->status == 'archived')>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Archived
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $category->description }}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
{{-- end content --}}
