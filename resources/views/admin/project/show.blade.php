@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Project</div>

                <div class="card-body">
                    
                    <h1>{{$project->name}}</h1>
                    <p>{{$project->description}}</p>
                    
                    <img src="{{asset('/storage/' . $project->cover_img)}}" class="w-100 d-block">
                    
                    <a>{{$project->github_link}}</a>

                    <div class="card-title">Tecnologie scelte:
                      @foreach ($project->technologies as $technology)
                        <span class="badge rounded-pill text-bg-primary">{{ $technology->tecnologia }}</span>
                      @endforeach
                    </div>

                    <div class="d-flex align-items-center"> 
                        <a href="{{route('admin.projects.edit', $project->id)}}" class="p-3">Modifica</a>
         
                        <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Elimina</button>
                        </form>
                    </div>
                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection