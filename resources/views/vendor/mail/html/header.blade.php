<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<!-- <img src="https://hqgroups.vn/assets/frontend/images/logo.png" class="logo" alt="Logo"> -->
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
