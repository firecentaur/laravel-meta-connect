<div class="table-responsive-sm">
    <table class="table table-striped" id="quizzes-table">
        <thead>
            <tr>
                <th>Userid</th>
        <th>Avatar Name</th>
        <th>Course</th>
        <th>Name</th>
        <th>Intro</th>
        <th>Timeopen</th>
        <th>Timeclose</th>
        <th>Timelimit</th>
        <th>Canredoquestions</th>
        <th>Attempts</th>
        <th>Questionsperpage</th>
        <th>Shuffleanswers</th>
        <th>Grade</th>
        <th>Password</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($quizzes as $quiz)
            <tr>
                <td>{{ $quiz->userid }}</td>
            <td>{{ $quiz->avatar_name }}</td>
            <td>{{ $quiz->course }}</td>
            <td>{{ $quiz->name }}</td>
            <td>{{ $quiz->intro }}</td>
            <td>{{ $quiz->timeopen }}</td>
            <td>{{ $quiz->timeclose }}</td>
            <td>{{ $quiz->timelimit }}</td>
            <td>{{ $quiz->canredoquestions }}</td>
            <td>{{ $quiz->attempts }}</td>
            <td>{{ $quiz->questionsperpage }}</td>
            <td>{{ $quiz->shuffleanswers }}</td>
            <td>{{ $quiz->grade }}</td>
            <td>{{ $quiz->password }}</td>
                <td>
                    {!! Form::open(['route' => ['quizzes.destroy', $quiz->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('quizzes.show', [$quiz->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('quizzes.edit', [$quiz->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>