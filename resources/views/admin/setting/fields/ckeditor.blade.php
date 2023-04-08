


<div class="form-group m-form__group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}" >{{ $field['label'] }}:</label>
    <textarea id="ckeditor_{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control { array_get( $field, 'class') }}" >{{ old($field['name'], setting($field['name'])) }}</textarea>
    @if ($errors->has($field['name'])) <small class="help-block text-danger">{{ $errors->first($field['name']) }}</small> @endif
</div>

<script>

    $(document).ready(function(){
        CKEDITOR.replace('ckeditor_{{ $field['name'] }}',{
            removeButtons: 'Source',
            //startupMode:'source'
        } );
    });
</script>
