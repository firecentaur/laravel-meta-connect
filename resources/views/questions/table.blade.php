<div class="table-responsive-sm">
    <table class="table table-striped" id="questions-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
        <th>Questiontext</th>
        <th>Questiontextformat</th>
        <th>Generalfeedback</th>
        <th>Generalfeedbackformat</th>
        <th>Defaultmark</th>
        <th>Penalty</th>
        <th>Qtype</th>
        <th>Length</th>
        <th>Created By</th>
        <th>Modified By</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->name }}</td>
            <td>{{ $question->questiontext }}</td>
            <td>{{ $question->questiontextformat }}</td>
            <td>{{ $question->generalfeedback }}</td>
            <td>{{ $question->generalfeedbackformat }}</td>
            <td>{{ $question->defaultmark }}</td>
            <td>{{ $question->penalty }}</td>
            <td>{{ $question->qtype }}</td>
            <td>{{ $question->length }}</td>
            <td>{{ $question->created_by }}</td>
            <td>{{ $question->modified_by }}</td>
                <td>
                    {!! Form::open(['route' => ['questions.destroy', $question->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('questions.show', [$question->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('questions.edit', [$question->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
