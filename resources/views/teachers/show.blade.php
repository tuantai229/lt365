@extends('layouts.app')

@section('title', $teacher->name . ' - Chi tiết giáo viên | LT365')

@section('content')
    @include('teachers.partials.show-breadcrumb')
    @include('teachers.partials.show-content')
@endsection
