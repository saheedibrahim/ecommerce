@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Settings')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Settings</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Settings
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="pd-20 card-box">
    @livewire('admin-settings')
</div>


@endsection

@push('scripts')
<script>
    $('input[type="file"][name="site_logo"][id="site_logo"]').ijaboViewer([
        preview: '#site_logo_image_preview',
        imageShape: 'rectangular',
        allowedExtensions: ['png', 'jpg'],
        onErrorShape: function(message, element){
            alert('message');
        },
        onInvalidType: function(message, element){
            alert(message);
        },
        onSuccess: function(message, element){}
    ]);

    // $('#change_site_logo_form').on('submit', function(e){
    //     e.preventDefault();
    //     var form = this;
    //     var formdata = new FormData(form);
    //     var inputFileVal = $(form).find('input[type="file"][name="site_logo"]').val();

    //     if (inputFileVal.length > 0) {
    //          $.ajax([
    //             url: $(form).attr('action'),
    //             method: $(form).attr('method'),
    //             data: formdata,
    //             processData: false,
    //             dataType: 'json',
    //             contentType: false,
    //             beforeSend: function(){
    //                 toastr.remove();
    //                 $(form).find('span.error-text').text('');
    //             },
    //             success: function(response){
    //                 if (response.status == 1) {
    //                     toastr.success(response.msg);
    //                     $(form)[0].reset();
    //                 } else {
    //                     toastr.error(response.msg);
    //                 }
    //             }
    //          ]);
    //     } else {
    //         $(form).find('span.error-text').text('Please, select logo image file. PNG file type is recommended');
    //     }
    // });

    $('#change_site_logo_form').on('submit', function(e){
    e.preventDefault();
    var form = this;
    var formdata = new FormData(form);
    var inputFileVal = $(form).find('input[type="file"][name="site_logo"]').val();

    if (inputFileVal.length > 0) {
         $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: formdata,
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function(){
                toastr.remove();
                $(form).find('span.error-text').text('');
            },
            success: function(response){
                if (response.status == 1) {
                    toastr.success(response.msg);
                    $(form)[0].reset();
                    // Update the image preview if needed
                    $('#site_logo_image_preview').attr('src', response.new_image_path);
                } else {
                    toastr.error(response.msg);
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
                if(xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(prefix, val) {
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                }
            }
         });
    } else {
        $(form).find('span.site_logo_error').text('Please, select logo image file. PNG file type is recommended');
    }
});

$('input[type="file"][name="site_favicon"][id="site_favicon"]').ijaboViewer([
        preview: '#site_favicon_image_preview',
        imageShape: 'square',
        allowedExtensions: ['png'],
        onErrorShape: function(message, element){
            alert('message');
        },
        onInvalidType: function(message, element){
            alert(message);
        },
        onSuccess: function(message, element){}
]);

$('#change_site_favicon_form').on('submit', function(e){
    e.preventDefault();
    var form = this;
    var formdata = new FormData(form);
    var inputFileVal = $(form).find('input[type="file"][name="site_favicon"]').val();

    if (inputFileVal.length > 0) {
         $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: formdata,
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function(){
                // toastr.remove();
                $(form).find('span.error-text').text('');
            },
            success: function(response){
                if (response.status == 1) {
                    toastr.success(response.msg);
                    $(form)[0].reset();
                    // Update the image preview if needed
                    // $('#site_logo_image_preview').attr('src', response.new_image_path);
                } else {
                    toastr.error(response.msg);
                }
            },
            // error: function(xhr, status, error) {
            //     // Handle errors
            //     if(xhr.responseJSON && xhr.responseJSON.errors) {
            //         $.each(xhr.responseJSON.errors, function(prefix, val) {
            //             $(form).find('span.'+prefix+'_error').text(val[0]);
            //         });
            //     }
            // }
         });
    } else {
        $(form).find('span.error_text').text('Please, select favicon image file. PNG file type is recommended');
    }
</script>
@endpush