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
    <div class="mb-4 px-5">
        {{-- add category button --}}
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Create Category</a>
    </div>


    <div class="px-5">
        <table class="table">
            <thead>

                <tr>
                    <th>#</th>
                    {{-- <th>Image</th> --}}
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Description</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @forelse ($categories as $category)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <th>{{ $i }}</th>
                        {{-- <th>{{$category->image}}</th> --}}
                        <th>{{ $category->name }}</th>
                        <th>{{ $category->parent_id }}</th>
                        <th>{{ $category->description }}</th>
                        <th>{{ $category->status }}</th>
                        <th>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-success">Edit</a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </th>
                    </tr>
                @empty
                    <tr aria-colspan="7" class="text-center">
                        There are no categories
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
{{-- end content --}}
