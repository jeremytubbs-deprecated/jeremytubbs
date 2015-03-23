@if(isset($post->cover_id) && $post->cover_id != 0)
	<div id="cover-show">
		<img src="{{ $post->cover->src }}">
		<button id="cover-delete" class="uk-button" data-id="{{ $post->cover->id }}">Delete</button>
	</div>
@else
	<div id="cover-show"></div>
@endif
<div id="cover-upload" class="{{ (isset($post->cover_id) && ! is_null($post->cover_id)) ? 'uk-hidden' : '' }}">
	<div id="upload-drop" class="uk-placeholder uk-text-center">
		<i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
		Create cover by dragging an image file here or
		<a class="uk-form-file">
			selecting one<input id="upload-select" name="file" type="file">
		</a>.
	</div>

	<div id="progressbar" class="uk-progress uk-hidden">
		<div class="uk-progress-bar" style="width: 0%;">0%</div>
	</div>
</div>