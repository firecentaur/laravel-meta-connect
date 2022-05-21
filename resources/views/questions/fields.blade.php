<!-- Parent Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent', 'Parent:') !!}
    {!! Form::number('parent', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Questiontext Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('questiontext', 'Questiontext:') !!}
    {!! Form::textarea('questiontext', null, ['class' => 'form-control']) !!}
</div>

<!-- Questiontextformat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('questiontextformat', 'Questiontextformat:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('questiontextformat', 0) !!}
        {!! Form::checkbox('questiontextformat', '1', null) !!}
    </label>
</div>


<!-- Generalfeedback Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('generalfeedback', 'Generalfeedback:') !!}
    {!! Form::textarea('generalfeedback', null, ['class' => 'form-control']) !!}
</div>

<!-- Generalfeedbackformat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('generalfeedbackformat', 'Generalfeedbackformat:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('generalfeedbackformat', 0) !!}
        {!! Form::checkbox('generalfeedbackformat', '1', null) !!}
    </label>
</div>


<!-- Defaultmark Field -->
<div class="form-group col-sm-6">
    {!! Form::label('defaultmark', 'Defaultmark:') !!}
    {!! Form::number('defaultmark', null, ['class' => 'form-control']) !!}
</div>

<!-- Penalty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('penalty', 'Penalty:') !!}
    {!! Form::number('penalty', null, ['class' => 'form-control']) !!}
</div>

<!-- Qtype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qtype', 'Qtype:') !!}
    {!! Form::text('qtype', null, ['class' => 'form-control','maxlength' => 20,'maxlength' => 20]) !!}
</div>

<!-- Length Field -->
<div class="form-group col-sm-6">
    {!! Form::label('length', 'Length:') !!}
    {!! Form::number('length', null, ['class' => 'form-control']) !!}
</div>

<!-- Stamp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stamp', 'Stamp:') !!}
    {!! Form::text('stamp', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Createdby Field -->
<div class="form-group col-sm-6">
    {!! Form::label('createdby', 'Createdby:') !!}
    {!! Form::number('createdby', null, ['class' => 'form-control']) !!}
</div>

<!-- Modifiedby Field -->
<div class="form-group col-sm-6">
    {!! Form::label('modifiedby', 'Modifiedby:') !!}
    {!! Form::number('modifiedby', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>
</div>
