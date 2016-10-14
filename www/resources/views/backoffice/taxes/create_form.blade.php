{{--{!! Form::model($suggestion, ['route' => ['backoffice.suggestions.store']]) !!}--}}
<fieldset>

    <div class="form-group{{ $errors->has('Title') ? ' has-error' : '' }}">
        {!! Form::label($name = 'taxes_name', $value = 'Title', $options = [
            'class' => 'control-label',
        ]) !!}
        {!! Form::text($name = 'taxes_name', $value = null, $options = [
            'class' => 'form-control',
            'id' => 'taxes_name',
            'placeholder' => 'Title of the suggestion',
        ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label($name = 'taxes_description', $value = 'Description', $options = [
            'class' => 'control-label',
        ]) !!}
        {!! Form::textarea($name = 'taxes_description', $value = null, $options = [
            'class' => 'form-control',
            'id' => 'taxes_description',
            'rows' => '5',
            'placeholder' => 'Content of the suggestion',
        ]) !!}
    </div>

</fieldset>
{{--</div>--}}
{{--<div class="modal-footer">--}}
{{--{!! Form::submit($value = 'Save', $options = [--}}
    {{--'class' => 'btn btn-primary pull-right',--}}
{{--]) !!}--}}
{{--{!! link_to_route($name = 'backoffice.products.index', $title = 'Cancel', $parameters = null, $attributes = [--}}
    {{--'class' => 'btn btn-default pull-right',--}}
{{--]) !!}--}}
{{--<button type="button" class="btn btn-default" onclick='cancel' data-dismiss="modal">Cancel</button>--}}
{{--<button type="button" class="btn btn-primary" onclick='save'>Save</button>--}}
{{--{!! Form::close() !!}--}}