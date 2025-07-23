@extends('layouts.app')

@section('title', $center->name . ' - Chi tiết trung tâm luyện thi | LT365')

@section('content')
    @include('centers.partials.show-breadcrumb')
    @include('centers.partials.show-content')
@endsection
