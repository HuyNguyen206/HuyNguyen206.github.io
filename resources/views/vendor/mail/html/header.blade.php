<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'HiTechShopping')
<img src="{{\Illuminate\Support\Facades\URL::to('/').'/storage/mail/online-shopping.png'}}" class="logo" alt="Shopping Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
