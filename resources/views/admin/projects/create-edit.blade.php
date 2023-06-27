@extends('layouts.app')

@section('content')

<div class="container w-75">

    @if($errors->any())
        <div class=" mt-5 alert alert-danger" role="alert">
            <h4 >
                Ops, pay attention to these fields
            </h4>
            <ul>
                @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>

    @endif


    <form class="mt-5" action="{{$route}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method($method)

        <div class="mb-3">
            {{--Name text input --}}

            <label for="name" class="form-label">
                <strong>{{$action}} Name</strong>
            </label>
            <div class="input-group">
                <input
                  value="{{old('name', $project?->name)}}"
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  aria-describedby="basic-addon3 basic-addon4">
            </div>
        </div>
        <div class="mb-3">
            {{--Type select --}}

            <label for="type" class="form-label">
                <strong>{{$action}} Type</strong>
            </label>
            <select class="form-select" name="type_id" aria-label="Default select example">
                <option value="">Choose the type</option>
                @foreach ($types as $type)

                <option
                  value="{{$type->id}}"
                  @if ($type->id == old('type_id', $project?->type?->id))
                    selected
                  @endif>
                  {{$type?->name}}
                </option>
                @endforeach

              </select>
        </div>
        <div class="mb-3">
            {{--Purpose text input --}}

            <label for="purpose" class="form-label">
                <strong>{{$action}} Purpose</strong>
            </label>
            <div class="input-group">
                <input
                  value="{{old('purpose', $project?->purpose)}}"
                  type="text"
                  class="form-control"
                  id="purpose"
                  name="purpose">
            </div>
        </div>
        <div class="mb-3">
            {{--Description text input --}}

            <label for="description" class="form-label">
                <strong>{{$action}} Description</strong>
            </label>

                <textarea
                  type="text"
                  class="form-control"
                  id="description"
                  name="description"
                  aria-describedby="basic-addon3 basic-addon4">

                  {{old('description', $project?->description)}}

                </textarea>
                <script>
                    ClassicEditor
                        .create( document.querySelector( '#description' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>

        </div>
        <div class="mb-3">
            {{--Technologies text input --}}

            <p>
                <strong>{{$action}} Technologies</strong>
            </p>
            <div class="input-group">

                <div role="group" aria-label="Basic radio toggle button group">
                    @foreach ($technologies as $technology)
                        <input
                        type="checkbox"
                        class="btn-check"
                        name="technologies[]"
                        id="btnradio{{$technology->id}}"
                        value="{{$technology->id}}"
                        autocomplete="off"
                        @if($project?->technologies->contains($technology->id))
                            checked
                        @elseif(in_array($technology->id, old('technologies', [])) )
                            checked
                        @endif
                        >

                        <label class="btn btn-outline-dark ms-4 my-3" for="btnradio{{$technology->id}}">
                            {{$technology->name}}
                        </label>
                    @endforeach

            </div>
        </div>
        <div class="mb-3">
            {{--Repository text input --}}

            <label for="repository" class="form-label">
                <strong>{{$action}} Repository</strong>
            </label>
            <div class="input-group">
                <input
                  value="{{old('repository', $project?->repository)}}"
                  type="text"
                  class="form-control"
                  id="repository"
                  name="repository"
                  aria-describedby="basic-addon3 basic-addon4">
            </div>
        </div>
        <div class="mb-3">
            {{-- team members text input --}}

            <label for="team_members" class="form-label">
                <strong>Add team members</strong>
            </label>
            <div class="input-group">
                <input
                  value="{{old('team_members', $project?->team_members)}}"
                  type="text"
                  class="form-control"
                  id="team_members"
                  name="team_members"
                  aria-describedby="basic-addon3 basic-addon4">
            </div>
        </div>
        <div class="mb-3">
            {{-- Project Manager text input --}}

            <label for="project_manager" class="form-label">
                <strong>{{$action}} Project Manager</strong>
            </label>
            <div class="input-group">
                <input
                  value="{{old('project_manager', $project?->project_manager)}}"
                  type="text"
                  class="form-control"
                  id="project_manager"
                  name="project_manager"
                  aria-describedby="basic-addon3 basic-addon4">
            </div>
        </div>
        <div class="mb-3 pm-image-input">
            {{-- Project Screen text input --}}

            <label for="image" class="form-label">
                <strong>{{$action}} Project Screenshot</strong>
            </label>

                <input
                  value="{{old('project_manager', $project?->project_manager)}}"
                  type="file"
                  class="form-control"
                  id="image"
                  name="image"
                  aria-describedby="basic-addon3 basic-addon4">

        </div>
        <div class="mb-3">
            {{-- is_done checkbox --}}
            <label for="is_done" class="form-label">
                <strong>Completed</strong>
            </label>
            <div class="input-group">
                <label class="mx-2" for="is_done">
                    Yes
                </label>

                    <input
                    @if ($project?->is_done == 1)
                        checked
                    @endif
                      value="1"
                      type="radio"
                      id="is_done"
                      name="is_done"
                      aria-describedby="basic-addon3 basic-addon4">
            </div>
            <div class="input-group">

                <label class="mx-2" for="is_done">
                    No
                </label>

                <input
                @if ($project?->is_done == 0)
                    checked
                @endif
                  value="0"
                  type="radio"
                  id="is_done"
                  name="is_done"
                  aria-describedby="basic-addon3 basic-addon4">
            </div>
        </div>

        <div class="text-center my-5">
            <button type="submit" class="btn btn-dark">

                {{ $action }} {{ "$project?->name"}}
            </button>
        </div>
    </form>

</div>
@endsection
