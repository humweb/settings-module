@section('content')
    {!! Form::open(['route' => ['post.admin.settings.save', $module]]) !!}
    <div class="card card-default">
        <div class="card-header">
            <button type="submit" class="btn btn-xs btn-primary tip float-right" title="Save">
                <i class="fa fa-check"></i></button>
            <span>{{ ucfirst($module) }}</span> Settings
        </div>
        <div class="card-body">
            {!! $settingsSchema->buildForm() !!}
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection