@extends('layouts.master')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
    @php
    $header = getHeader();
    @endphp
    @if (isset($header['logo']))
        <link rel="shortcut icon" href="{{ $header['logo'] }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('assets/user/img/box.png') }}" type="image/x-icon">
    @endif
    <title> {{ $title }} </title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endpush