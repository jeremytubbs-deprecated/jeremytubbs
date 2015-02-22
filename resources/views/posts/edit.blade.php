@extends('app')

@section('ngApp')
<body ng-app="postsApp">
@endsection

@section('content')
	post edit
@endsection

@section('styles')
	<link href="/css/posts/codemirror.css" rel="stylesheet">
@endsection

@section('scripts')
	<script src="/js/angular/angular.js"></script>
	<script src="/js/apps/postsApp.js"></script>
	<script src="/js/posts/codemirror.js"></script>
	<script src="/js/posts/ui-codemirror.js"></script>
	<script src="/js/posts/commonmark.js"></script>
@endsection