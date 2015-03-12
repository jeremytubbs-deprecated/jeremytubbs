@extends('app')

@section('content')
<div class="uk-container uk-container-center">
{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'uk-form uk-width-medium-1-1']) !!}
	<div class="uk-form-row">
		<input class="uk-width-medium-1-2" type="text" name="title" value="{{$post->title}}" placeholder="Title"/>
		<div class="uk-form-icon uk-float-right">
			<i class="uk-icon-calendar"></i>
			<input type="text" name="published_at" placeholder="Publication Date" value="{{$post->published_at}}" data-uk-datepicker="{weekstart:0, format:'YYYY-MM-DD'}">
		</div>
	</div>
	<div class="uk-form-row uk-margin-bottom">
		<textarea data-uk-htmleditor="{markdown:true}" name="markdown">{{$post->markdown}}</textarea>
	</div>
	<div class="uk-form-row">
		{!! Form::select('tag_list[]', $tags, $post->tagList, ['id' => 'tag-list', 'class' => 'uk-width-medium-1-2 uk-margin-bottom', 'multiple']) !!}
		<div class="uk-clearfix uk-float-right">
			<a class="uk-button uk-button-link" data-uk-toggle="{target:'#meta'}"><i class="uk-icon-cog"></i></a>
			<button class="uk-button" type="submit" name="status" value="0">Save Draft</button>
			<button class="uk-button" type="submit" name="status" value="1">Publish</button>
		</div>
	</div>
	<div id="meta" class="uk-hidden">
		<div class="uk-form-row">
			<input type="file" name="file">
		</div>
		<div class="uk-form-row uk-width-medium-1-2">
			<label class="uk-form-label">Summary</label>
			<div class="uk-form-controls">
				<input type="text" name="summary" value="{{$post->summary}}">
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
		$('#tag-list').select2({
			tags: true,
			placeholder: 'Select some tags...'
		});
	</script>
@endsection
