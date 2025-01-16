@extends('admin.layout.master')

@section('admin_content')
    <div class="page-wrapper">

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="page-header d-print-none">
                        <div class="container-xl">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    <h2 class="page-title">
                                        Create New Post
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "{{ session('success') }}",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        </script>
                    @endif

                    <!-- Page body -->
                    <div class="page-body">
                        <div class="container-xl">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <form action="{{ route('blog.store') }}" method="POST" class="card"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                        placeholder="Title of the blog">
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">slug</label>
                                                    <input type="text" class="form-control" name="slug"
                                                        placeholder="slug">
                                                </div>
                                                <div class="mb-3">
                                                    <div class="form-label">Category</div>
                                                    <select class="form-select" name="category_id">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Content <span
                                                            class="form-label-description">56/100</span></label>
                                                    <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="form-label">Upload  Image</div>
                                                    <input type="file" class="form-control" id="imageInput" name="image" id="imageInput"/>
                                                </div>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label">Image Preview</label>
                                                    <div>
                                                        <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; max-height: 300px; display: none; border: 1px solid #ccc; padding: 5px;">
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="card-footer text-end">
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-link">Cancel</a>
                                                <button type="submit" class="btn btn-primary ms-auto">Create Post</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>


    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>

@endsection
