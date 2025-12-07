<x-mail::message>
# Nový dotaz z webu Chata Jana

**Jméno:** {{ $data['name'] }}<br>
**Email:** {{ $data['email'] }}<br>
**Telefon:** {{ $data['phone'] ?? 'Neuvedeno' }}

## Zpráva:

{{ $data['message'] }}

<x-mail::button :url="config('app.url')">
Přejít na web
</x-mail::button>

S pozdravem,<br>
{{ config('app.name') }}
</x-mail::message>
