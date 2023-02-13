@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">Modifica Project</div>

                <div class="card-body">
                    <form action="{{route('admin.projects.update', $project->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{$project->name}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text-area" class="form-control" name="description" value="{{$project->description}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cover Img</label>
                            <input type="file" class="form-control" name="cover_img" value="{{$project->cover_img}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">GitHub Link</label>
                            <input type="text" class="form-control" name="github_link" value="{{$project->github_link}}">
                        </div>

                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection