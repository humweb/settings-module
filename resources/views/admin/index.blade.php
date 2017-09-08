@section('content')
    {!! Form::open(['route' => ['post.admin.settings.save', $module]]) !!}
    <div class="card card-default">
        <div class="card-header">
            <button type="submit" class="btn btn-sm btn-primary tip pull-right" title="Save"><i class="fa fa-check"></i></button>
            <h5>Settings for <span class="label">{{ ucfirst($module) }}</span></h5>
        </div>
        <div class="card-body">
            {!! $settingsSchema->buildForm() !!}
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection