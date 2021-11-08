@extends('client.layouts.master')
@section('content')
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
      @include('client.includes.sidebar')
      
      <!-- partial -->
      @include('client.includes.settings')
    </div>
@endsection