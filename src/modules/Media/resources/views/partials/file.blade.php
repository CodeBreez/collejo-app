@if($media)
<div class="block">
	<img src="{{ $media->url('small') }}" class="img-responsive img-lazy">
	<input type="hidden" name="{{ $fieldName . ($maxFiles ? '[]' : '') }}" value="{{ $media->id }}">
</div>
@endif