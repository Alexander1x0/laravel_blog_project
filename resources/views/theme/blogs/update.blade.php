@extends('theme.master')

@section('title', 'Edit Blog')

@section('content')
    @include('theme.partial.hero', ['title' => $blog->name])
    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('updateBlogStatus'))
                        <div class="alert alert-success">
                            {{ session('updateBlogStatus') }}
                        </div>
                    @endif
                    <form action="{{ route('blogs.update', ['blog' => $blog]) }}" class="form-contact contact_form"
                        method="post" id="contactForm" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input class="form-control border" name="name" value="{{ $blog->name }}" id="name"
                                type="text" placeholder="Enter your name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <input class="form-control border" name="image" id="name" type="file">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <select name="category_id" id="">
                                <option value="">Select Category</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $blog->category_id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <textarea class="w-100 border" name="description" placeholder="Enter your blog title" rows="5">{{ $blog->description }}
                            </textarea>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                </div>
                <div class="form-group text-center text-md-right mt-3">
                    <button type="submit" class="button button--active button-contactForm">Update</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
