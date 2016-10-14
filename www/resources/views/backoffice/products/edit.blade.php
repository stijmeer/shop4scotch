@extends('layouts.app')

@section('header')
    {{--bootstrap select--}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($product, [
                    'method' => 'put',
                    'route' => ['backoffice.products.update', $product->id],
                ]) !!}

            {{-- modals for suggestions, distilleries and taxes --}}
            <?php $items = ["suggestions", "distilleries", "taxes"]; ?>
            @foreach ($items as $item)
                <div class="modal fade" id="{{ "modal_" . $item }}" tabindex="-1" role="dialog" aria-labelledby="modal_Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">{{ "Add new " . $item . "." }}</h4>
                            </div>
                            <div class="modal-body">
                                @include('backoffice.' . $item . '.create_form')
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary pull-left">Add</button>
                                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Product input panel --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit {{ $product->name }}
                    {!! link_to_route($name = 'backoffice.products.index', $title = 'Cancel', $parameters = null, $attributes = [
                        'class' => 'pull-right',
                    ]) !!}
                </div>
                <div class="panel-body">

                    {{--general information--}}
                    <fieldset>
                        <legend id="legend">{{ $product->name }}</legend>

                        <div class="form-group col-md-12{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label($name = 'name', $value = 'Name', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::text($name = 'name', $value = null, $options = [
                                'class' => 'form-control',
                                'id' => 'name',
                                'placeholder' => 'Name of the product',
                                'required' => '',
                            ]) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label($name = 'description', $value = 'Description', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::textarea($name = 'description', $value = null, $options = [
                                'class' => 'form-control',
                                'id' => 'description',
                                'rows' => '5',
                                'placeholder' => 'Description for the product',
                                'required' => '',
                            ]) !!}
                        </div>
                    </fieldset>
                    <br>

                    {{-- Data --}}
                    <fieldset>
                        <legend>Data</legend>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'price', $value = 'Price (excl. BTW)', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            <div class="input-group">
                                {!! Form::number($name = 'price', $value = null, $options = [
                                    'class' => 'form-control',
                                    'id' => 'price',
                                    'placeholder' => 'Price for the product',
                                    'step' => '0.1',
                                ]) !!}
                                <span class="input-group-addon">&euro;</span>
                                <div class="input-group-btn">
                                    <button type="button" id="subtractBTW" class="btn btn-warning">&ndash; 21&percnt;</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'age', $value = 'Age', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::number($name = 'age', $value = null, $options = [
                                'class' => 'form-control',
                                'id' => 'age',
                                'placeholder' => 'Age of the product',
                                'required' => '',
                                'step' => '1',
                            ]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'volume', $value = 'Volume', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            <div class="input-group">
                                {!! Form::number($name = 'volume', $value = null, $options = [
                                    'class' => 'form-control',
                                    'id' => 'age',
                                    'placeholder' => 'Volume of the product',
                                    'required' => '',
                                    'step' => '1',
                                ]) !!}
                                <span class="input-group-addon">cl</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'color', $value = 'Color', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::text($name = 'color', $value = null, $options = [
                                'class' => 'form-control',
                                'id' => 'color',
                                'placeholder' => 'Color of the product',
                                'required' => '',
                            ]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'smell', $value = 'Smell', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::text($name = 'smell', $value = null, $options = [
                                'class' => 'form-control',
                                'id' => 'smell',
                                'placeholder' => 'Smell of the product',
                                'required' => '',
                            ]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'taste', $value = 'Taste', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::text($name = 'taste', $value = null, $options = [
                                'class' => 'form-control',
                                'id' => 'taste',
                                'placeholder' => 'Taste of the product',
                                'required' => '',
                            ]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'alcohol_percentage', $value = 'Alcohol Percentage', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            <div class="">
                                <div class="input-group">
                                    {!! Form::number($name = 'alcohol_percentage', $value = null, $options = [
                                        'class' => 'form-control',
                                        'id' => 'alcohol_percentage',
                                        'placeholder' => 'Alcohol percentage of the product',
                                        'step' => '0.1',
                                    ]) !!}
                                    <span class="input-group-addon">% vol</span>
                                </div>

                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'packaging', $value = 'Packaging', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            {!! Form::select($name = 'packaging', [
                                '0' => 'None',
                                '1' => 'Box',
                                '2' => 'Case',
                                '3' => 'Crate',
                            ], $value = null, $options = [
                                'class' => 'form-control',
                                'id' => 'packaging',
                                'required' => '',
                                'data-live-search' => 'true',
                            ]) !!}
                        </div>
                    </fieldset>
                    <br>

                    {{--Meta Data--}}
                    <fieldset id="metadata">
                        <legend>Metadata</legend>

                        <div class="form-group col-md-12">
                            {!! Form::label($name = 'suggestions', $value = 'Suggestion', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            <br>
                            {!! Form::select($name = 'suggestions', $value = $suggestion, $options = [
                                'class' => 'form-control',
                                'id' => 'suggestions',
                                'required' => '',
                                'name' => 'suggestions[]',
                            ]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'distilleries', $value = 'Distillery', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            <br>
                            {!! Form::select($name = 'distilleries', $value = $distillery, $options = [
                                'class' => 'form-control',
                                'id' => 'distilleries',
                                'required' => '',
                                'name' => 'distilleries[]',
                            ]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label($name = 'taxes', $value = 'Tax', $options = [
                                'class' => 'control-label',
                            ]) !!}
                            <br>
                            {!! Form::select($name = 'taxes', $value = $tax, $options = [
                                'class' => 'form-control',
                                'id' => 'taxes',
                                'required' => '',
                                'name' => 'taxes[]',
                            ]) !!}
                        </div>

                    </fieldset>
                    <br>

                </div>
                <div class="panel-footer">
                    {!! Form::submit($value = 'Save', $options = [
                        'class' => 'btn btn-primary',
                    ]) !!}
                    {!! link_to_route($name = 'backoffice.products.index', $title = 'Cancel', $parameters = null, $attributes = [
                        'class' => 'pull-right',
                    ]) !!}
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('footer')
    {{--bootstrap select--}}
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

    {{--custom scripts--}}
    <script type="text/javascript">

        // Show product name in title
        var inputfield = document.getElementById('name');
        inputfield.onkeyup = function () {
            document.getElementById('legend').innerHTML = "Changed Product: " + inputfield.value;
        };

        // Subtract btw from price
        $('#subtractBTW').click(function () {
            $priceInput = $('#price');
            $priceNew = $priceInput.val() * 0.79;
            $priceRounded = $priceNew.toFixed(3);
            $priceInput.val($priceRounded);
        });

        $(document).ready(function () {
            // Add new option "create new" to suggestion, distillery and tax
            $.each(['suggestions', 'distilleries', 'taxes', 'regions'], function (index, value) {
                $item = $('#' + value);

                // Add option groups to suggestions, distilleries and taxes lists + show respective modals
                if (value != 'regions') {
                    $item.wrapInner('<optgroup label="Existing" class="existing"></optgroup>');
                    $item.prepend('<optgroup label="Add New" class="new"><option value="0">Add new ' + value + '</option></optgroup>');

                    // React when "create new" is selected
                    $('select#' + value).change(function () {
                        console.log('input changed');
                        if ($(this).val() == 0) {
                            $options = {
                                'show': 'true',
                                'backdrop': 'true',
                                'keyboard': 'false'
                            };
                            $('#modal_' + value).modal($options);// Shows the correct modal
                            $('select#' + value).selectpicker('val', '-1');// reset the input in case no new item was added
                        }
                    });

                    // Add new item to drop down list
                    $('#modal_' + value + ' button.btn-primary').click(function () {
                        //Remove previous alert if present
                        $('#modal_' + value + ' .alert').remove();

                        //Set Validation rules
                        var a = 0; var b = 0;
                        a += ( jQuery.trim($('#' + value + '_name').val()).length > 0)? 1 : 0; b += 1;
                        a += ( jQuery.trim($('#' + value + '_description').val()).length > 0)? 1 : 0; b += 1;
                        if (value == 'distilleries') {
                            a += ( $('#regions').val() > 0 )? 1:0; b += 1;
                        }

                        // Check validation rules
                        if(a == b) {
                            console.log('success');
                            $name = $('#' + value + '_name').val();
                            $existingGroup = $('#' + value + ' .existing');
                            // Remove dummy content from list if present
                            $existingGroup.find('.dummy').remove();
                            $key = parseInt($existingGroup.children().last().attr('value')) + 1;
                            console.log($key);

                            // Add item to list
                            $existingGroup.append('<option value="' + $key + '" class="dummy">' + $name + '</option>');

                            // Update list
                            $('#' + value).selectpicker('refresh');

                            // Select new entry
                            $('#' + value).selectpicker('val', $key);
                            $('#' + value).val($key);

                            // Close modal
                            $('#modal_' + value).modal('hide');

                        } else {
                            console.log('fail');
                            $('#modal_' + value + ' fieldset').prepend('<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Looks like you didn&apos;t fill everything in.</div>')
                        }

                    });
                }

                // Make suggestions and distilleries searchable
                $item.selectpicker({
                    liveSearch:true,
                    liveSearchNormalize:true,
                    liveSearchStyle:'contains',
                    width:'100%'
                });
            });
        });
    </script>
@endsection