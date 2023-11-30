<x-mail::message>

<h1 class="text-center">{{ $mailData['title'] }}</h1>

{!! $mailData['description'] !!}

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
