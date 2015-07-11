@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
    	{!! Html::script('/assets/clone-section-of-form/js/clone-form-td.js') !!}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        	{!! Form::open(['url' => 'admin/question', 'role'=>'form', 'id' => 'bookForm' ]) !!}

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            {!! Form::label('question', trans('labels.question')) !!}
                            {!! Form::textarea('question', null, array('class' => 'form-control', 'rows' => 5)) !!}
                            <small class="text-danger">{{ $errors->first('question') }}</small>
                        </div>
                        <div class="col-md-5 col-lg-5">
                            {!! Form::label('category_id', trans('labels.category')) !!}
                            {!! Form::select('category_id', $category, null, ['class' => 'form-control select2']) !!}
                            <small class="text-danger">{{ $errors->first('category_id') }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('image', trans('labels.image')) !!}
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="input-group">
                                <a href="http://fakeanh.com/filemanager/dialog.php?type=1&field_id=image&crossdomain=1&akey={!! Config::get('core.filemanager_key') !!}" class="input-group-addon iframe-btn">{!! FA::icon('image') !!}</a>
                                {!! Form::text('image', null, array('class' => 'form-control', 'id' => 'image')) !!}
                                <small class="text-danger">{{ $errors->first('image') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="entry1" class="clonedInput">
                    <h2 id="reference" name="reference" class="heading-reference">Quiz</h2>
                    <div class="form-group">
                    	<label for="chapter">Quiz</label>
	                    <div class="row">
                            <div class="col-xs-6">
                                {!! Form::text('value', null, array('class' => 'form-control', 'name'=>'value[]', 'placeholder' => 'Đáp án')) !!}
                            </div>
		                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<button type="button" class="btn btn-default btn-sm addButton" data-template="clone">{!! FA::icon('plus') !!}</button>
		                    </div>
	                  	</div>
	                </div>
                    <div class="form-group hide" id="cloneTemplate">
						<label for="chapter">Option </label>
	                    <div class="row">
		                    <div class="col-xs-6">
                                {!! Form::text('value', null, array('class' => 'form-control', 'name'=>'values', 'placeholder' => 'Đáp án')) !!}
                            </div>
		                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<button type="button" class="btn btn-danger btn-sm removeButton">{!! FA::icon('trash') !!}</button>
		                    </div>
	                  	</div>
	                </div>
				</div>

                <div class="form-group">
                    {!! Form::label('answer', trans('labels.answer')) !!}
                    <div class="row">
                        <div class="col-md-2 col-lg-2">
                            {!! Form::text('answer', null, array('class' => 'form-control')) !!}
                            <small class="text-danger">{{ $errors->first('answer') }}</small>
                        </div>
                    </div>
                </div>
                <div class="">
                    {!! Form::reset(trans('labels.reset'), ['class'=>'btn btn-warning']) !!}
                    {!! Form::submit(trans('labels.add'), array('class' => 'btn btn-info ')) !!}
                </div>
			{!! Form::close() !!}
        </div>
	</div>
@stop


@section('style')
{!! Html::style('/assets/formvalidation/dist/css/formValidation.css') !!}
{!! Html::style('/assets/select2-4.0.0/dist/css/select2.min.css') !!}
{!! Html::style('/assets/fancyapps-fancyBox/source/jquery.fancybox.css') !!}
@stop


@section('script')
{!! Html::script('/assets/formvalidation/dist/js/formValidation.js') !!}
{!! Html::script('/assets/formvalidation/dist/js/framework/bootstrap.js') !!}
{!! Html::script('/assets/select2-4.0.0/dist/js/select2.min.js') !!}
{!! Html::script('/assets/fancyapps-fancyBox/source/jquery.fancybox.js') !!}
{!! Html::script('/assets/fancyapps-fancyBox/source/jquery.fancybox.pack.js') !!}

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
                message: 'The field is required'
            },
            numeric: {
                message: 'Field must be a numeric number'
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
            'value[]': titleValidators,
            'answer': priceValidators,
            'question': titleValidators
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

        $clone
            .find('[name="values"]').attr('name', 'value[]').end();

        $('#bookForm')
            .formValidation('addField', 'value[]', titleValidators);

    })

    // Remove button click handler
    .on('click', '.removeButton', function() {
        var $row  = $(this).parents('.form-group'),
            index = $row.attr('data-clone-index');

        // Remove element containing the fields
        $('#bookForm')
            .formValidation('removeField', $row.find('[name="value[' + index + ']"]'));

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



	$('.select2').select2({
        placeholder: "Chooie a category",
        allowClear: true
    });


    $('.iframe-btn').fancybox({
        'width'     : 900,
        'height'    : 600,
        'type'      : 'iframe',
        'autoScale'     : false
    });

    function OnMessage(e){
        var event = e.originalEvent;
        if(event.data.sender === 'responsivefilemanager'){
            if(event.data.field_id){
                var fieldID=event.data.field_id;
                var url=event.data.url;
                $('#'+fieldID).val(url).trigger('change');
                $.fancybox.close();

                $(window).off('message', OnMessage);
            }
        }
    }

    $('.iframe-btn').on('click',function(){
        $(window).on('message', OnMessage);
    });

</script>
@stop