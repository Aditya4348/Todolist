
@extends('layouts.app')

@section('konten')
    @livewire('Task', ['id' => $id])
@endsection