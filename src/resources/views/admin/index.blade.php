@section('content')
    {!! Form::open(['route' => ['post.admin.settings.save', $module]]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            <button type="submit" class="btn btn-sm btn-primary tip pull-right" title="Save"><i class="fa fa-check"></i></button>
            <h4>Settings for <span class="label">{{ ucfirst($module) }}</span></h4>
        </div>
        <div class="panel-body">
            {!! $settingsSchema->buildForm() !!}
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection