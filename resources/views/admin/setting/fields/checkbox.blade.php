

<div class="form-group m-form__group {{ $errors->has($field['name']) ? ' has-error' : '' }}">

    <label class="m-checkbox">
        <input  type="checkbox" name="{{ $field['name'] }}" value="1" @if(old($field['name'], setting($field['name']))) checked="checked" @endif >{{ $field['label'] }}
        <span></span>
    </label>

    @if ($errors->has($field['name'])) <small class="help-block text-danger">{{ $errors->first($field['name']) }}</small> @endif
</div>



