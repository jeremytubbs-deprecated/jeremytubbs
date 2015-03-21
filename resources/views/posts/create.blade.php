@extends('app')

@section('content')
<div class="uk-container uk-container-center">

	@include('posts.partials.upload')

	{!! Form::open(['route' => ['posts.store'], 'method' => 'POST', 'role' => 'form', 'class' => 'uk-form uk-width-medium-1-1']) !!}
	<div class="uk-form-row">
		<input class="uk-width-medium-1-2" type="text" name="title" placeholder="Title"/>
		<div class="uk-form-icon uk-float-right">
			<i class="uk-icon-calendar"></i>
			<input type="text" name="published_at" placeholder="Publication Date" data-uk-datepicker="{weekstart:0, format:'YYYY-MM-DD'}">
		</div>
	</div>
	<div class="uk-form-row uk-margin-bottom">
		<textarea data-uk-htmleditor="{markdown:true}" name="markdown"></textarea>
	</div>
	<div class="uk-form-row">
		{!! Form::select('tag_list[]', $tags, null, ['id' => 'tag-list', 'class' => 'uk-width-medium-1-2 uk-margin-bottom', 'multiple']) !!}
		<div class="uk-clearfix uk-float-right">
			<a class="uk-button uk-button-link" data-uk-toggle="{target:'#meta'}"><i class="uk-icon-cog"></i></a>
			<button class="uk-button" type="submit" name="published" value="0">Save Draft</button>
			<button class="uk-button" type="submit" name="published" value="1">Publish</button>
		</div>
	</div>
	<div id="meta" class="uk-hidden">
		<div class="uk-form-row uk-width-medium-1-2">
			<label class="uk-form-label">Summary</label>
			<div class="uk-form-controls">
				<input type="text" name="summary">
			</div>
		</div>
	</div>
	{!! Form::close() !!}
</div>
@endsection

@section('styles')
	<link href="/css/admin.css" rel="stylesheet">
@endsection

@section('scripts')
	<script src="/js/admin.js"></script>
	<script>

	$(function(){
		$('#tag-list').select2({
			tags: true,
			placeholder: 'Select some tags...'
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
				$("#cover-show").html("<img src='"+response.src+"'><button id='cover-delete' data-id='"+response.id+"'>Delete</button>");
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
			});
		});
	});

</script>
@endsection