@component('mail::message')

@component('mail::panel')
Hey! {{ $client }}. 
@endcomponent

@component('mail::button', ['url' => $link, 'color' => 'success'])
Here is the link to your invoice.
@endcomponent

Thanks,<br>
@endcomponent
