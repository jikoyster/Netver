@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Upload Company Documents</strong></h3>
                </div>
            </div>
            <form method="post" action="{{ route('company-document.save') }}"
                  enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                {{ csrf_field() }}
                <div class="dz-message">
                    <div class="col-xs-12">
                        <div class="message">
                            <p>Drop files here or Click to Upload</p>
                        </div>
                    </div>
                </div>
                <div class="fallback">
                    <input type="file" name="file" multiple>
                </div>
            </form>
            <div class="col-xs-12 text-center" style="margin-top: 7px;">
                <button type="button" class="btn yellow-gradient" onclick="window.location='<?=route('company-documents')?>'">
                    <strong>Back</strong>
                </button>
            </div>
        </div>
    </div>
 
    {{--Dropzone Preview Template--}}
    <div id="preview" style="display: none;">
 
        <div class="dz-preview dz-file-preview">
            <div class="dz-image"><img data-dz-thumbnail /></div>
 
            <div class="dz-details">
                <div class="dz-size"><span data-dz-size></span></div>
                <div class="dz-filename"><span data-dz-name></span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
            <div class="dz-error-message"><span data-dz-errormessage></span></div>

        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/dropzone/dropzone.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
        var total_photos_counter = 0;
        Dropzone.options.myDropzone = {
            acceptedFiles: 'application/pdf',
            uploadMultiple: true,
            parallelUploads: 1,
            maxFilesize: 16,
            previewTemplate: document.querySelector('#preview').innerHTML,
            addRemoveLinks: true,
            dictRemoveFile: 'Remove file',
            dictFileTooBig: 'Image is larger than 16MB',
            timeout: 10000,
         
            init: function () {
                this.on("removedfile", function (file) {
                    $.post({
                        url: '/company-documents/images-delete',
                        data: {id: file.previewElement.querySelector("[data-dz-name]").innerHTML, _token: $('[name="_token"]').val()},
                        dataType: 'json',
                        success: function (data) {
                            total_photos_counter--;
                            $("#counter").text("# " + total_photos_counter);
                        }
                    });
                });
            },
            success: function (file, done) {
                file.previewElement.querySelector("[data-dz-name]").innerHTML = done.filename;
                total_photos_counter++;
                $("#counter").text("# " + total_photos_counter);
            }
        };
    });
</script>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/assets/dropzone/dropzone.css')}}">
<style type="text/css">
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #fff;
}
.container-check {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}.container-check input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* On mouse-over, add a grey background color */
.container-check:hover input ~ .checkmark {
    background-color: #fff;
}

/* When the checkbox is checked, add a blue background */
.container-check input:checked ~ .checkmark {
    background-color: #fff;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container-check input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container-check .checkmark:after {
    left: 7px;
    top: 2px;
    width: 10px;
    height: 17px;
    border: solid #000;
    border-width: 0 5px 5px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.page-heading {
    margin: 20px 0;
    color: #666;
    -webkit-font-smoothing: antialiased;
    font-family: "Segoe UI Light", "Arial", serif;
    font-weight: 600;
    letter-spacing: 0.05em;
}
 
#my-dropzone .message {
    font-family: "Segoe UI Light", "Arial", serif;
    font-weight: 600;
    color: #0087F7;
    font-size: 1.5em;
    letter-spacing: 0.05em;
}
 
.dropzone {
    border: 2px dashed #0087F7;
    background: white;
    border-radius: 5px;
    min-height: 300px;
    padding: 90px 0;
    vertical-align: baseline;
}
.dz-error-message {
    margin-top: 13px;
}
</style>
@stop