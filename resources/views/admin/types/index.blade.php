@extends('layouts.app')

@section('content')
<div class="container w-50 mt-5">
    <h1>All Types</h1>
    <div class="input-group mb-3">
        <form class="d-flex" action="{{route('admin.types.store')}}" method="POST">
            @csrf
            <input type="text" class="form-control" placeholder="Add new Type" name="name" aria-describedby="button-addon2">
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
            {{-- <th scope="col">Id</th> --}}
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                {{-- <th scope="row">{{$type->id}}</th>  --}}
                <td>
                    <form
                      action="{{ route('admin.types.update', $type) }}"
                      method="POST"
                      id="edit_type_form{{$type->id}}">

                      @csrf
                      @method('PUT')


                      <input class="border-0" name="name" type="text" value="{{$type->name}}">

                    </form>
                </td>
                <td class="pm-buttons-container ">

                    <button onclick="updateType({{$type->id}})" class="btn pm-bg-dark text-white">
                        Save
                    </button>

                    <form
                    class="d-inline"
                    method="POST"
                    action="{{route('admin.types.destroy', $type)}}"
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
    function updateType(id){
        const form = document.getElementById('edit_type_form' + id);
        form.submit();

    }

</script>
@endsection
