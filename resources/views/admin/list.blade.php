@section('content')
    <div class="card card-default">
        <div class="card-header">
            Settings
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                @foreach($modules as $module)
                    <tr>
                        <td>{{ title_case($module) }}</td>
                        <td class="text-right">
                            <a href="{!! route('get.admin.settings.module',[$module]) !!}" class="btn btn-xs btn-primary">Settings</a>
                        </td>
                    </tr>
                @endforeach    
                </tbody>
            </table>
        </div>
    </div>
@endsection