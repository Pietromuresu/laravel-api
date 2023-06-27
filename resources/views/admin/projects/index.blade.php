@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('deleted'))
        <div class="alert alert-success mt-3">
            {!! session('deleted') !!}
        </div>
    @endif

    <div class="pm-allprojects-heading d-flex justify-content-between container">
        <h1 class="my-4">All projects  </h1>
        <h1 class="text-center align-self-center mx-4 btn-dark btn mt-3">
            <a class="text-white text-decoration-none" href="{{route('admin.projects.create')}}">
                <i class="fa-solid fa-plus"></i>
                Add New
            </a>
        </h1>
    </div>


    <div class="pm-card-wrapper justify-content-center">
        @foreach ($projects as $project)

            @include('admin.projects.partials.card', $project)

        @endforeach
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{$projects->links()}}
    </div>




    </div>
@endsection

