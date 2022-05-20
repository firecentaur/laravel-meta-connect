<div class="table-responsive-sm">
    <table class="table table-striped" id="slObjects-table">
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
        @foreach($slObjects as $slObject)
            <tr>
                <td>{{ $slObject->UUID }}</td>
            <td>{{ $slObject->owner }}</td>
            <td>{{ $slObject->name }}</td>
            <td>{{ $slObject->description }}</td>
            <td>{{ $slObject->group }}</td>
            <td>{{ $slObject->type }}</td>
            <td>{{ $slObject->slurl }}</td>
            <td>{{ $slObject->active }}</td>
                <td>
                    {!! Form::open(['route' => ['slObjects.destroy', $slObject->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('slObjects.show', [$slObject->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('slObjects.edit', [$slObject->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>