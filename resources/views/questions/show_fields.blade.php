<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $question->name }}</p>
</div>

<!-- Questiontext Field -->
<div class="form-group">
    {!! Form::label('questiontext', 'Questiontext:') !!}
    <p>{{ $question->questiontext }}</p>
</div>

<!-- Questiontextformat Field -->
<div class="form-group">
    {!! Form::label('questiontextformat', 'Questiontextformat:') !!}
    <p>{{ $question->questiontextformat }}</p>
</div>

<!-- Generalfeedback Field -->
<div class="form-group">
    {!! Form::label('generalfeedback', 'Generalfeedback:') !!}
    <p>{{ $question->generalfeedback }}</p>
</div>

<!-- Generalfeedbackformat Field -->
<div class="form-group">
    {!! Form::label('generalfeedbackformat', 'Generalfeedbackformat:') !!}
    <p>{{ $question->generalfeedbackformat }}</p>
</div>

<!-- Defaultmark Field -->
<div class="form-group">
    {!! Form::label('defaultmark', 'Defaultmark:') !!}
    <p>{{ $question->defaultmark }}</p>
</div>

<!-- Penalty Field -->
<div class="form-group">
    {!! Form::label('penalty', 'Penalty:') !!}
    <p>{{ $question->penalty }}</p>
</div>

<!-- Qtype Field -->
<div class="form-group">
    {!! Form::label('qtype', 'Qtype:') !!}
    <p>{{ $question->qtype }}</p>
</div>

<!-- Length Field -->
<div class="form-group">
    {!! Form::label('length', 'Length:') !!}
    <p>{{ $question->length }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $question->created_by }}</p>
</div>

<!-- Modified By Field -->
<div class="form-group">
    {!! Form::label('modified_by', 'Modified By:') !!}
    <p>{{ $question->modified_by }}</p>
</div>

