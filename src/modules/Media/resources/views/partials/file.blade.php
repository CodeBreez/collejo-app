@if($media)
<div class="block">
	<img src="{{ $media->url('small') }}" class="img-responsive img-lazy">
	<input type="hidden" name="{{ $fieldName . ($maxFiles ? '[]' : '') }}" value="{{ $media->id }}">
	<a href="#" class="delete-img" title="Remove"><i class="fa fa-times"></i></a>
</div>
@endif