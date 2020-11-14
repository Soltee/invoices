@component('mail::message')
***Invoices***

# Topic : Payment

@component('mail::table')

|      |   |
|:----------|:-------------:|
| ID      | {{ $invoice->generatedId }} |
| Project | {{ $project->name }}  |

@endcomponent

@component('mail::table')

| Name     | Amount  | Total  |
|:----------|:-------------:|------:|
| {{ $project->name }} |  {{  $project->amount }} | {{  $project->amount }} |

@endcomponent

@component('mail::table')

|      |   |
|:----------|:-------------:|
| Subtotal| ${{ $invoice->sub_total }} |  
| Discount | ${{  $invoice->discount ?? 0  }} | 
| Grandtotal |${{  $invoice->grand_total }} |

@endcomponent

Thanks,<br>
@endcomponent
