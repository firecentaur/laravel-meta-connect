<div class="table-responsive-sm">
    <table class="table table-striped" id="slobjects-table">
        <thead>
            <tr>
                <th>Uuid</th>
        <th>Owner</th>
        <th>Name</th>
        <th>Description</th>
        <th>Group</th>
        <th>Type</th>
        <th>Slurl</th>
        <th>Active</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($slobjects as $slobjects)
            <tr>
                <td>{{ $slobjects->UUID }}</td>
            <td>{{ $slobjects->owner }}</td>
            <td>{{ $slobjects->name }}</td>
            <td>{{ $slobjects->description }}</td>
            <td>{{ $slobjects->group }}</td>
            <td>{{ $slobjects->type }}</td>
            <td>{{ $slobjects->slurl }}</td>
            <td>{{ $slobjects->active }}</td>
                <td>
                    {!! Form::open(['route' => ['slobjects.destroy', $slobjects->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('slobjects.show', [$slobjects->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('slobjects.edit', [$slobjects->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>