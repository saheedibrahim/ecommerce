@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @livewire('admin-categories-subcategories-list')
@endsection