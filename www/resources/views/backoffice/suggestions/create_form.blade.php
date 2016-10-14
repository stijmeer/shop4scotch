{{--{!! Form::model($suggestion, ['route' => ['backoffice.suggestions.store']]) !!}--}}
<fieldset>

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::label($name = 'suggestions_name', $value = 'Title', $options = [
            'class' => 'control-label',
        ]) !!}
        {!! Form::text($name = 'suggestions_name', $value = null, $options = [
            'class' => 'form-control',
            'id' => 'suggestions_name',
            'placeholder' => 'Title of the suggestion',
        ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label($name = 'suggestions_description', $value = 'Content', $options = [
            'class' => 'control-label',
        ]) !!}
        {!! Form::textarea($name = 'suggestions_description', $value = null, $options = [
            'class' => 'form-control',
            'id' => 'suggestions_description',
            'rows' => '5',
            'placeholder' => 'Content of the suggestion',
        ]) !!}
    </div>

</fieldset>

{{--{!! Form::submit($value = 'Save', $options = [--}}
    {{--'class' => 'btn btn-primary',--}}
{{--]) !!}--}}
{{--{!! link_to_route($name = 'backoffice.products.index', $title = 'Cancel', $parameters = null, $attributes = [--}}
    {{--'class' => 'pull-right',--}}
{{--]) !!}--}}

{{--{!! Form::Close() !!}--}}