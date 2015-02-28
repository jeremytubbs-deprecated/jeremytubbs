@extends('app')

@section('ngApp')
<body ng-app="postsApp">
@endsection

@section('content')
{!! Form::open(array('route' => ['posts.store'], 'method' => 'POST', 'role' => 'form')) !!}
<div class="container-fluid" ng-controller="EditorController">
	<div class="row">
		<div class="col-md-12">
			<input class="form-control" type="text" name="title" placeholder="Title"/>
		</div>
	</div>
	<div class="row editor-info">
		<div class="col-md-12">
			<div class="pull-right"><span ng-bind="countOf(editor.text)"></span> Words</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 editor">
			<textarea class="form-control" name="commonmark" ng-model="editor.text" ui-codemirror ui-codemirror-opts="editorOptions"></textarea>
		</div>
		<div class="col-md-6 preview">
			<div class="editor-output" ng-bind-html="editor.text | commonmark"></div>
		</div>
	</div>
</div>
@endsection

@section('footer')
<div class="footer-menu">
	<div class="container-fluid">
		<div class="row" ng-controller="FooterController" ng-init="init('Save Draft', false)">
			<div class="col-md-8" style="margin-top: 13px; height: 19px;">
				<div class="form-group">
				{!! Form::select('tags[]', $tags, null, ['id' => 'tag-list', 'class' => 'form-control', 'multiple']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="btn-group pull-right dropup">
					<button type="submit" class="btn btn-danger" ng-show="submitStatus"><span ng-bind="submitText"></span></button>
					<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" ng-show="submitStatus">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<button type="submit" class="btn btn-info" ng-hide="submitStatus"><span ng-bind="submitText"></span></button>
					<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" ng-hide="submitStatus">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#" ng-click="updateSubmit('Publish'); submitStatus = !submitStatus">Publish</a></li>
						<li><a href="#" ng-click="updateSubmit('Save Draft'); submitStatus = !submitStatus">Save Draft</a></li>
					</ul>
				</div>
				<input type="hidden" name="status" id="status" value="@{{ submitStatus }}"/>
			</div>
		</div>
	</div>
</div>
<div class="footer-lower">
	<div class="container-fluid">
 		Meta Fields and Uploads
 	</div>
</div>
{!! Form::close() !!}
@endsection

@section('styles')
	<link href="/css/posts/codemirror.css" rel="stylesheet">
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.3/css/select2.min.css" rel="stylesheet">
@endsection

@section('scripts')
	<script src="/js/angular/angular.js"></script>
	<script src="/js/apps/postsApp.js"></script>
	<script src="/js/posts/codemirror.js"></script>
	<script src="/js/posts/ui-codemirror.js"></script>
	<script src="/js/posts/commonmark.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.3/js/select2.min.js"></script>
	<script>
		$('#tag-list').select2({
			tags: true
		});
	</script>
@endsection