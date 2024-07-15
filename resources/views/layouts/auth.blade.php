@extends('layouts.master')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/x-icon">
    <title> {{ $title }} </title>
@endpush