@extends('layouts.headprofile')

@section('titulo')
{{ $post->titulo }}
@endsection

@push('styles')

@section('contenido')
 <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="">
@endsection