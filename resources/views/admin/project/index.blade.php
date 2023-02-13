@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista Projects</div>

                <div class="card-body">
                    <ul>
                    @foreach ($projects as $project)
                    <li>
                    <a href="{{route('admin.projects.show', $project->id)}}">{{$project->name}}</a>
                    </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection