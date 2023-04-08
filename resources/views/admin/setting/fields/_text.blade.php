


<div class="form-group m-form__group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}" >{{ $field['label'] }}:</label>
    <input type="{{ $field['type'] }}"
           name="{{ $field['name'] }}"
           value="{{ old($field['name'], setting($field['name'])) }}"
           id="{{ $field['name'] }}"
           placeholder="{{ $field['label'] }}"
           class="form-control m-input {{ array_get( $field, 'class') }}">

    @if ($errors->has($field['name'])) <small class="help-block text-danger">{{ $errors->first($field['name']) }}</small> @endif
</div>