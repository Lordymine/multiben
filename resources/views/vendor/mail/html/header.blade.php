<tr>
<td class="header">
<a href="https://www.multben.com.br" style="display: inline-block;">
@if (trim($slot) === 'Multben')
<img src="https://www.multben.com.br/img/logo/logo-multben2.png" class="logo" alt="Multben">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
