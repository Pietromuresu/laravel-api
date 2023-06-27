@extends('layouts.app')


@section('content')

<div class="container w-75">
    <h1>Technologies</h1>

<div class="container mt-5">
    <div class="input-group mb-3">
        <form class="d-flex" action="{{route('admin.technologies.store')}}" method="POST">
            @csrf
            <input type="text" class="form-control" placeholder="Add new Technologies" name="name" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary " type="submit" id="button-addon2">Add</button>
        </form>
        </div>

        @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
        @endif

    <table class="table w-75">
        <thead>
          <tr>

            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
            <tr>

                <td>
                    <form
                      action="{{ route('admin.technologies.update', $technology) }}"
                      method="POST"
                      id="edit_technologies_form{{$technology->id}}">

                      @csrf
                      @method('PUT')


                      <input class="border-0" name="name" type="text" value="{{$technology->name}}">

                    </form>
                </td>
                <td class="pm-buttons-container">

                    <button onclick="updateTechnology({{$technology->id}})" class="btn pm-bg-dark text-white">
                        Save
                    </button>

                    <form
                    class="d-inline"
                    method="POST"
                    action="{{route('admin.technologies.destroy', $technology)}}"
                    onsubmit="return confirm('if you delete it will be lost forever')">
                    @csrf
                    @method('DELETE')
                        <button type="submit"  class="btn pm-bg-red text-white" >
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>


<script>
    function updateTechnology(id){
        const form = document.getElementById('edit_technologies_form' + id);
        form.submit();

    }

</script>


</div>
@endsection

