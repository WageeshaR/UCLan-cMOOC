@extends('layouts.frontend.index')
@section('content')
<!-- content start -->
    <div class="container-fluid p-0 home-content">
        <!-- banner start -->
        <div class="subpage-slide-blue">
            <div class="container">
                <h1>Error</h1>
            </div>
        </div>
        <!-- banner end -->

         <!-- breadcrumb start -->
            <div class="breadcrumb-container">
                <div class="container">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Error</li>
                  </ol>
                </div>
            </div>
        
        <!-- breadcrumb end -->
        
        
        <article class="container not-found-block">
            <div class="row">
               <div class="col-12 not-found-col">
                    <span><b><span class="blue">ERROR</span></b></span>
                    <h3>Sorry! This page isn't tested fully. You may want to go back or to home.</h3>
                    <a href="{{ route('home') }}" class="btn btn-ulearn-cview mt-3">Go to homepage</a>
               </div>
            </div>
        </article>
    </div>    
        
    <!-- content end -->
@endsection