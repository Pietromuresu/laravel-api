
<div class="pm-card text-black  ">

    <a class="text-decoration-none" href="{{route('admin.projects.show', $project)}}">
        <div class="pm-bg-light-green pm-coloured-stripe">

        </div>

        <div class="pm-card-title position-relative">

            <h4 class="text-dark">{{$project->name}}</h4>
            <span class="d-block">{{$project->type?->name}}</span>

            @foreach ($project->technologies as $technology)
                <span class="badge bg-dark">{{$technology->name}}</span>
            @endforeach
        </div>

        <p class="mt-4">
            {{$project->purpose}}
        </p>
        <h6 class="mt-4 text-dark">
            Project Manager: {{$project->project_manager}}
        </h6>
        <div>
            <h6 class="mt-4 text-dark d-inline">
                Git Repo:
            </h6>
            <a target="_blank" href="{{$project->repository}}">
                Link
            </a>
        </div>
        <p class="mt-4">{!! $project->is_done ? 'Completed <i class="fa-solid fa-check"></i>' : 'In progress... ' !!}</p>

    </a>
</div>

