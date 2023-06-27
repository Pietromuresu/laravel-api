@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="pm-show-heading d-flex justify-content-between">

        <h1 class="mb-5">
            {{ $project->name }}
        </h1>
        @if ($project->is_done )
        <h4 class="text-success text-center mx-5 mt-3">
            <i class="fa-solid fa-check"></i>
            Completed
        </h4>
        @else
        <h4 class="text-danger text-center mx-5 mt-3">
            <i class="fa-sharp fa-solid fa-record-vinyl" style="color: #dd2727;"></i>
            Work in progress...
        </h4>
        @endif
    </div>
    <div>
        <span class="badge bg-success">{{$project->type?->name}}</span>
    </div>

    <div class="">

        <h4 class="mt-4">
            <i class="fa-brands fa-github"></i>
            Git Repository:
        </h4>
        <p>
            <a target="_blank" href="{{ $project->repository }}">
                {{ $project->repository }}
            </a>
        </p>


        {{-- Project Screenshot --}}

        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="">
                <div class="">
                    <img width="1000px"  src="{{asset('storage/' . $img_path)}}" alt="{{$project->name}} screenshot">
                </div>

              </div>
            </div>
          </div>

          <button class="border-0 bg-white" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
            <img  height="400px" src="{{asset('storage/' . $img_path)}}" alt="{{$project->name}} screenshot">
          </button>



        <h4 class="mt-4">
            Project Manager:
        </h4>
        <p>
            {{ $project->project_manager }}
        </p>


        <h3 class="mt-4">
            Purpose:
        </h3>
        <p>
            {{ $project->purpose }}
        </p>



        <h3 class="mt-4">
            Team:
        </h3>
        <p>
            {{ $project->team_members }}
        </p>


        <h3 class="mt-4">
            Technologies:
        </h3>
        <p>
            @foreach ($project->technologies as $technology)
            <div class="badge bg-dark fs-6">
                {{ $technology?->name }}
            </div>
            @endforeach
        </p>


        <h3 class="mt-4">
            Description:
        </h3>
        <p>
            {!! $project->description !!}
        </p>

    </div>

    <div class="pm-buttons-container text-center my-5">
        <div class="btn pm-bg-dark ">
            <a
              class="text-white text-decoration-none"
              href="{{route('admin.projects.edit', $project)}}">
                Modify
            </a>
        </div>
        <div class="btn pm-bg-red ms-3" >
            <form
              method="POST"
              action="{{route('admin.projects.destroy', $project)}}"
              onsubmit="return confirm('If you confirm, {{ $project->name }} will be deleted forever')">
                @csrf
                @method('DELETE')

                <button
                  type="submit"
                  class="bg-transparent border-0 p-0 text-white">
                    Delete
                </button>
            </form>
        </div>
    </div>

</div>
@endsection

