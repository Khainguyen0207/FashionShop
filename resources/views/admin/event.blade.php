@extends('layouts.admin')
@push('head')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script> --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />
    <script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.umd.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/categorys.css') }}">
    <style>
        .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused), .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            min-height: 200px;
        }
    </style>
@endpush
@section('overview')
<div id="addCategory" >
    <div class="screen" onclick="clickAddCategory(event)"></div>
    <form action="{{route('categories.store')}}" id="addCategoryForm" enctype="multipart/form-data" class="my-animation"  method="POST">
        @csrf
            <div class="header">
                <h2 class="tittle">Sự kiện</h2>
            </div>
            <div class="container">
                <div class="information-product" style="margin-bottom: 10px;">
                    <p style="font-size: 20px; padding: 5px 0px">Tiêu đề</p>
                    <input type="text" name="name_category" class="input" placeholder="Tên danh mục của bạn" spellcheck="false" required>
                </div>
                <div>
                    <p style="font-size: 20px; padding: 5px 0px">Thông tin sự kiện</p>
                    <textarea name="content" id="editor"></textarea>
                    <button id="getTextButton" style="display: none"></button>
                <script>
                    let editorInstance;
                    ClassicEditor
                        .create(document.querySelector('#editor'))
                        .then(editor => {
                            editorInstance = editor; // Store the editor instance
                        })
                        .catch(error => {
                            console.error(error);
                        });

                        document.getElementById('getTextButton').addEventListener('click', () => {
                            const data = editorInstance.getData(); // Get the editor content
                            console.log(data);
                        });
                </script>
                <script>
                    const {
                        ClassicEditor,
                        Essentials,
                        Bold,
                        Italic,
                        Font,
                        Paragraph
                    } = CKEDITOR;
        
                    ClassicEditor
                        .create( document.querySelector( '#editor' ), {
                            plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                            toolbar: [
                                'undo', 'redo', '|', 'bold', 'italic', '|',
                                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                            ]
                        } )
                        .then( /* ... */ )
                        .catch( /* ... */ );
                </script>
            </div>
            </div>
            <div class="footer" style="margin-top: 10px;">
                <button type="submit" class="btn-add btn" onclick="document.getElementById('getTextButton').click()"></button>
                <button type="submit" onclick="clickAddCategory(event)" class="btn-close btn"><i class="fa-solid fa-xmark"></i> Hủy</button>
            </div>
    </form>
</div>
    <div class="overview">
        <div id="header">
            <h1>Sự kiện shop</h1>
        </div>
        <div class="tool-bar">
            <div class="function">
                <a href="/" onclick="clickAddCategory(event)"> <i class="fa-solid fa-plus"></i> Sự kiện mới </a>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script src="{{asset('assets/admin/js/event.js')}}"></script>
@endpush