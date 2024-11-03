import {
        ClassicEditor,
        Heading,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font, 
        Image, 
        ImageUpload,
        FileRepository,
        SimpleUploadAdapter,
        ImageResize,
        ImageResizeEditing,
        ImageResizeButtons 
    } from 'ckeditor5';
var data;
ClassicEditor
    .create(document.querySelector('#editor'), {
        plugins: [Heading, ImageResize, Essentials, Paragraph, Bold, Italic, Font, Image, ImageUpload, FileRepository, SimpleUploadAdapter, ImageResizeEditing, ImageResizeButtons],
        toolbar: [
            'heading', 'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
            'insertImage', '|'
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
            withCredentials: true,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                Authorization: `Bearer ${localStorage.getItem('jwt')}`
            }
        },
    })
