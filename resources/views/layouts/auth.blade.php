@extends('layouts.master')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/x-icon">
    <title> {{ $title }} </title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endpush