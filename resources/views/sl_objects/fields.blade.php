<!-- Uuid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('UUID', 'Uuid:') !!}
    {!! Form::text('UUID', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Owner Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner', 'Owner:') !!}
    {!! Form::text('owner', null, ['class' => 'form-control','maxlength' => 35,'maxlength' => 35,'maxlength' => 35]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Group Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group', 'Group:') !!}
    {!! Form::text('group', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control','maxlength' => 25,'maxlength' => 25,'maxlength' => 25]) !!}
</div>

<!-- Slurl Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slurl', 'Slurl:') !!}
    {!! Form::text('slurl', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', 'Active:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('active', 0) !!}
        {!! Form::checkbox('active', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('slObjects.index') }}" class="btn btn-secondary">Cancel</a>
</div>
