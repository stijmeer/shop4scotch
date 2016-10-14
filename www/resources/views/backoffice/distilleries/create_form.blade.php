{{--{!! Form::model($distillery, ['route' => ['backoffice.distilleries.store']]) !!}--}}
<fieldset>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label($name = 'distilleries_name', $value = 'Name', $options = [
            'class' => 'control-label',
        ]) !!}
        {!! Form::text($name = 'distilleries_name', $value = null, $options = [
            'class' => 'form-control',
            'id' => 'distilleries_name',
            'placeholder' => 'Name of the distillery',
        ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label($name = 'distilleries_description', $value = 'Description', $options = [
            'class' => 'control-label',
        ]) !!}
        {!! Form::textarea($name = 'distilleries_description', $value = null, $options = [
            'class' => 'form-control',
            'id' => 'distilleries_description',
            'rows' => '5',
            'placeholder' => 'Description of the distillery',
        ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label($name = 'regions', $value = 'Region', $options = [
            'class' => 'control-label',
        ]) !!}
        <br>
        {!! Form::select($name = 'regions', $value = $region, $options = [
            'class' => 'form-control',
            'id' => 'regions',
            'name' => 'regions[]',
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