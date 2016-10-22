<script type="text/javascript">
C.ready(function(){
    $('#{{ $id }}-fileupload').fileupload({
        url: '{{ route('media.upload') }}',
        formData:{
            bucket:'{{ $bucketName }}',
            name:'{{ $fieldName . ($maxFiles ? '[]' : '') }}',
            max:{{ ($maxFiles ? '\''.$maxFiles.'\'' : 'false') }}
        },
        dataType: 'json',
        done: function (e, uploaded) {
            @if ($maxFiles) 
                Collejo.image.lazyLoad($('#{{ $id }}-files').prepend(uploaded.result.data.partial).find('img'));
            @else
                Collejo.image.lazyLoad($('#{{ $id }}-files').empty().prepend(uploaded.result.data.partial).find('img'));
            @endif
            $('#{{ $id }}-progress').fadeOut('fast', function(){
                 $('#{{ $id }}-progress .progress-bar').css('width','0%');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#{{ $id }}-progress').fadeIn('fast');
            $('#{{ $id }}-progress .progress-bar').css('width',progress + '%');
        }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    $('#{{ $id }}-progress').hide();

    $('.delete-img').on('click', function(e){
        e.preventDefault();
        $(this).parent('.block').remove();
    });
});
</script>

<div class="file-uploader large{{ $maxFiles ? '' : ' single' }}">
    <div class="upload-block">
        <span class="fileinput-button">
            <i class="fa fa-upload"></i>
            <input id="{{ $id }}-fileupload" type="file" name="file"{{ $maxFiles ? ' multiple=""' : '' }}>
        </span>

        <div id="{{ $id }}-progress" class="progress">
            <div class="progress-bar progress-bar-primary"></div>
        </div>
    </div>

    <div id="{{ $id }}-files" class="uploaded-files">
        @if($maxFiles)
            @foreach($model->$relationship as $media)
                @include('media::partials.file', ['media' => $media])
            @endforeach
        @else
            @include('media::partials.file', ['media' => $model ? $model->$relationship : null])
        @endif
    </div>
</div>