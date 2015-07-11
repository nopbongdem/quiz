@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
    	{!! HTML::script('/assets/clone-section-of-form/js/clone-form-td.js') !!}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        	{!! Form::open(['url' => 'admin/chapter/ads', 'role'=>'form', 'id' => 'bookForm' ]) !!}
                <div id="entry1" class="clonedInput">
                    <h2 id="reference" name="reference" class="heading-reference">Entry #1</h2>
                    <div class="form-group">

					    <div class="row">
							<div class="col-xs-4">
								{!! Form::label('story_id', trans('labels.story')) !!}
					    		{!! Form::select('story_id', $stories, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
					    		<small class="text-danger">{{ $errors->first('story_id') }}</small>
					    	</div>
					    	<div class="col-xs-2">
								{!! Form::label('vol', trans('Volume')) !!}
		                      	{!! Form::text('vol', null, array('class' => 'form-control', 'placeholder' => 'Vol number')) !!}
								<small class="text-danger">{{ $errors->first('vol') }}</small>
		                    </div>
		                    <div class="col-xs-2 pull-right">
		                    	{!! Form::submit(trans('labels.save'), array('class' => 'btn btn-info', 'name'=>'save')) !!}
		                    </div>
					    </div>
					</div>

                    <div class="form-group">
                    	<label for="chapter">Chapter</label>
	                    <div class="row">
							<div class="col-xs-4">
		                      	{!! Form::text('name', null, array('class' => 'form-control', 'name'=>'name[]', 'placeholder' => 'Chapter name')) !!}
		                    </div>
		                    <div class="col-xs-2">
		                      	{!! Form::text('chapter', null, array('class' => 'form-control', 'name'=>'chapter[]', 'placeholder' => 'Chapter')) !!}
		                    </div>
		                    <div class="col-xs-2">
		                      	{!! Form::text('start', null, array('class' => 'form-control', 'name'=>'start[]', 'placeholder' => 'Start')) !!}
		                    </div>
		                    <div class="col-xs-2">
		                      	{!! Form::text('end', null, array('class' => 'form-control', 'name'=>'end[]', 'placeholder' => 'End')) !!}
		                    </div>
		                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<button type="button" class="btn btn-default btn-sm addButton" data-template="clone">{!! FA::icon('plus') !!}</button>
		                    </div>
	                  	</div>
	                </div>
                    <div class="form-group hide" id="cloneTemplate">
						<label for="chapter">Chapter</label>
	                    <div class="row">
							<div class="col-xs-4">
		                      	{!! Form::text('name', null, array('class' => 'form-control', 'name'=> 'names', 'placeholder' => 'Chapter name')) !!}
		                    </div>
		                    <div class="col-xs-2">
		                      	{!! Form::text('chapter', null, array('class' => 'form-control', 'name'=> 'chapters', 'placeholder' => 'Chapter')) !!}
		                    </div>
		                    <div class="col-xs-2">
		                      	{!! Form::text('start', null, array('class' => 'form-control', 'name'=> 'starts', 'placeholder' => 'Start')) !!}
		                    </div>
		                    <div class="col-xs-2">
		                      	{!! Form::text('end', null, array('class' => 'form-control', 'name'=> 'ends', 'placeholder' => 'End')) !!}
		                    </div>
		                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<button type="button" class="btn btn-danger btn-sm removeButton">{!! FA::icon('trash') !!}</button>
		                    </div>
	                  	</div>
	                </div>
				</div>
			{!! Form::close() !!}
        </div>
	</div>
@stop


@section('style')
{!! HTML::style('/assets/formvalidation/dist/css/formValidation.css') !!}
{!! HTML::style('/assets/select2-4.0.0/dist/css/select2.min.css') !!}
@stop


@section('script')
{!! HTML::script('/assets/formvalidation/dist/js/formValidation.js') !!}
{!! HTML::script('/assets/formvalidation/dist/js/framework/bootstrap.js') !!}
{!! HTML::script('/assets/select2-4.0.0/dist/js/select2.min.js') !!}

<script type="text/javascript">

	var titleValidators = {
        row: '.col-xs-4',   // The title is placed inside a <div class="col-xs-4"> element
        validators: {
            notEmpty: {
                message: 'The title is required'
            }
        }
    },
    priceValidators = {
        row: '.col-xs-2',
        validators: {
            notEmpty: {
                message: 'The price is required'
            },
            numeric: {
                message: 'The price must be a numeric number'
            }
        }
    },
	bookIndex = 0;

	$('#bookForm')
	.formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	'story_id': priceValidators,
        	'vol': priceValidators,
            'name[]': titleValidators,
            'chapter[]': priceValidators,
            'start[]': priceValidators,
            'end[]': priceValidators
        }
    })
    // Add button click handler
    .on('click', '.addButton', function() {

        bookIndex++;
        var $template = $('#cloneTemplate'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .attr('data-clone-index', bookIndex)
                            .insertBefore($template);

        // Update the name attributes
        $clone
            .find('[name="names"]').attr('name', 'name[' + bookIndex + ']').end()
            .find('[name="chapters"]').attr('name', 'chapter[' + bookIndex + ']').val(parseInt($('[name="chapter[]"]').val()) + bookIndex).end()
            .find('[name="starts"]').attr('name', 'start[' + bookIndex + ']').end()
            .find('[name="ends"]').attr('name', 'end[' + bookIndex + ']').end();

        $('#bookForm')
            .formValidation('addField', 'name[' + bookIndex + ']', titleValidators)
            .formValidation('addField', 'chapter[' + bookIndex + ']', priceValidators)
            //.formValidation('addField', 'start[' + bookIndex + ']', priceValidators)
            .formValidation('addField', 'end[' + bookIndex + ']', priceValidators);

    })

    // Remove button click handler
    .on('click', '.removeButton', function() {
        var $row  = $(this).parents('.form-group'),
            index = $row.attr('data-clone-index');

        // Remove element containing the fields
        $('#bookForm')
            .formValidation('removeField', $row.find('[name="name[' + index + ']"]'))
            .formValidation('removeField', $row.find('[name="chapter[' + index + ']"]'))
            //.formValidation('removeField', $row.find('[name="start[' + index + ']"]'))
            .formValidation('removeField', $row.find('[name="end[' + index + ']"]'));

        $row.remove();
    });
/*
        $('.addButton').on('click', function() {
            var index = $(this).data('index');
            if (!index) {
                index = 1;
                $(this).data('index', 1);
            }
            index++;
            $(this).data('index', index);

            var template     = $(this).attr('data-template'),
                $templateEle = $('#' + template + 'Template'),
                $row         = $templateEle.clone().removeAttr('id').insertBefore($templateEle).removeClass('hide'),
                $el          = $row.find('input').eq(0).attr('name', template + '[]');
            //$('#defaultForm').formValidation('addField', $el);

            // Set random value for checkbox and textbox
            if ('checkbox' == $el.attr('type') || 'radio' == $el.attr('type')) {
                $el.val('Choice #' + index)
                   .parent().find('span.lbl').html('Choice #' + index);
            } else {
                $el.attr('placeholder', '' + index);
            }

            $row.on('click', '.removeButton', function(e) {
                //$('#defaultForm').formValidation('removeField', $el);
                $row.remove();
            });
        });
*/



	$('.select2').select2();

</script>
@stop