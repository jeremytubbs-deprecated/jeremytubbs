<input type="hidden" id="cover_id" name="cover_id" value="">

<div class="uk-grid uk-grid-small uk-margin">
	<div class="uk-width-medium-1-2">
		{!! Form::text('title', null, ['class' => 'uk-width-medium-1-1', 'placeholder' => 'Title'] ) !!}
	</div>
	<div class="uk-width-medium-1-4">
		{!! Form::checkbox('featured', null) !!}
		<label for="featured">Featured</label>
	</div>
	<div class="uk-width-medium-1-4">
		<div class="uk-form-icon uk-float-right">
			<i class="uk-icon-calendar"></i>
			{!! Form::text('published_at', null, ['class' => 'uk-width-medium-1-1', 'data-uk-datepicker' => '{weekstart:0, format:"YYYY-MM-DD"}', 'placeholder' => 'Publication Date'] ) !!}
		</div>
	</div>
</div>

<div class="uk-form-row uk-margin-bottom">
	{!! Form::textarea('markdown', null, [ 'data-uk-htmleditor' => '{markdown:true}'] ) !!}
</div>
<div class="uk-grid uk-grid-small">
	<div class="uk-width-medium-1-2">
	{!! Form::select('tag_list[]', $tags, null, ['id' => 'tag-list', 'class' => 'uk-width-medium-1-1', 'multiple']) !!}
	</div>

	<div class="uk-width-medium-1-4">
	{!! Form::select('category_id', ['' => 'Select a Category'] + $categories, null, ['id' => 'category', 'class' => 'uk-width-medium-1-1']) !!}
	</div>
	<div class="uk-width-medium-1-4">
	{!! Form::select('project_id', ['' => 'Select a Project'] + $projects, null, ['id' => 'project', 'class' => 'uk-width-medium-1-1']) !!}
	</div>
</div>

<div class="uk-grid uk-grid-small">
	<div class="uk-width-medium-1-2">
		{!! Form::textarea('summary', null, ['class' => 'uk-width-medium-1-1', 'placeholder' => 'Summary of post...'] ) !!}
	</div>
	<div class="uk-width-medium-1-2">
		<div class="uk-float-right">
			<button class="uk-button" type="submit" name="published" value="0">Save Draft</button>
			<button class="uk-button" type="submit" name="published" value="1">Publish</button>
		</div>
	</div>
</div>

@section('scripts')
<script src="/js/admin.js"></script>
<script>
$(function(){
	$('#tag-list').select2({
		tags: true,
		placeholder: 'Select some tags...'
	});

	$("#category").select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'Select a catagory...'
	});

	$("#project").select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'Select a project...'
	});

	var token = $('meta[name="csrf-token"]').attr('content');

	var progressbar = $("#progressbar"),
		bar         = progressbar.find('.uk-progress-bar'),
		settings    = {

		params: {
			'_token': token
		},

		param: 'file',

		type: 'json',

		action: '{{ route('covers.store') }}', // upload url

		allow : '*.(jpg|gif|png)', // allow only images

		loadstart: function() {
			bar.css("width", "0%").text("0%");
			progressbar.removeClass("uk-hidden");
		},

		progress: function(percent) {
			percent = Math.ceil(percent);
			bar.css("width", percent+"%").text(percent+"%");
		},

		allcomplete: function(response) {

			bar.css("width", "100%").text("100%");

			setTimeout(function(){
				progressbar.addClass("uk-hidden");
			}, 250);
			// hide upload area
			$("#cover-upload").addClass('uk-hidden');
			$("#cover-show").html("<img src='"+response.src+"'><button id='cover-delete' class='uk-button' data-id='"+response.id+"'>Delete</button>");
			$('input[name="cover_id"]').val(response.id);
		}
	};

	var select = UIkit.uploadSelect($("#upload-select"), settings),
		drop   = UIkit.uploadDrop($("#upload-drop"), settings);

	$('body').on('click','#cover-delete',function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: "DELETE",
			url: "/covers/"+id,
			data: { "_token": token},
		})
		.done(function() {
			$("#cover-show").html('');
			$("#cover-upload").removeClass('uk-hidden');
			$('input[name="cover_id"]').val('');
		});
	});
});
</script>
@endsection