@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('message_desc', __("Server Error 500. We're not exactly sure what happened, but our servers say something is wrong"))
