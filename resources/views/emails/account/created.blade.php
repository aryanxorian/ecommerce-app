@component('mail::message')
# Welcome to Ecommerce App

Your account was successfully Created

@component('mail::panel')
You can now Login into your Account.
@endcomponent

@component('mail::button', ['url' => '', 'color' => 'success'])
Login Here
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
