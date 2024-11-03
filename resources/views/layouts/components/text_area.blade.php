@push('head')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css">
@endpush
<div class="text_area">
    <div id="editor">
        @if (isset($information))
            {!!$information!!}
        @endif
    </div>
    <div class="info">
        <input type="hidden" id="information" name="information">
    </div>
     {{-- script import ckeditor5 --}}
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Heading,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font, Image, ImageUpload,FileRepository,SimpleUploadAdapter,ImageResize,ImageResizeEditing,ImageResizeButtons 
        } from 'ckeditor5';

        var data
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                plugins: [Heading,ImageResize, Essentials, Paragraph, Bold, Italic, Font , Image, ImageUpload, FileRepository, SimpleUploadAdapter,ImageResizeEditing,ImageResizeButtons],
                toolbar: [
                    'heading', 'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'insertImage','|' // Thêm nút chèn hình ảnh vào thanh công cụ
                ],
                image: {
                    toolbar: [
                        'imageTextAlternative', // Text alternative for images
                        'imageStyle:full', // Full image style
                        'imageStyle:side' // Side image style
                    ]
                },
                simpleUpload: {
                    // The URL that the images are uploaded to.
                    uploadUrl: './upload',

                    // Enable the XMLHttpRequest.withCredentials property.
                    withCredentials: true,

                    // Headers sent along with the XMLHttpRequest to the upload server.
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') ,
                        Authorization: `Bearer ${localStorage.getItem('jwt')}`
                    }
                },
            })

            .then(editor => {
               data = editor;
            })

            .catch( error => {
                console.error( error );
            });

            function getDataText() {
                return data.getData()
            }

            function setDataText() {
                return data.setData("")
            }

            let element = document.querySelector("#editor");
            do {
                element = element.parentElement
            } while (element && !(element instanceof HTMLFormElement));
            
            element.addEventListener('submit', () => {
                document.querySelector("#information").value = getDataText()
            });
            
            document.querySelector("div.screen").addEventListener('click', function() {
                setDataText()
            });
    </script>
    {{-- script import ckeditor5 --}}
</div>