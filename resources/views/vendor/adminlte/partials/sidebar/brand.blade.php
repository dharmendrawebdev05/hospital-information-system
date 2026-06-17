@php
    $setting = setting();
@endphp

<a href="{{ url('/') }}" class="brand-link">

    {{-- LOGO --}}
    <img
        src="{{ $setting && $setting->logo
            ? asset('storage/'.$setting->logo)
            : asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}"

        class="brand-image img-circle elevation-3"
        style="opacity:.9; height:35px; width:35px; object-fit:cover;"
        alt="Hospital Logo"
    >

    {{-- HOSPITAL NAME --}}
    <span class="brand-text font-weight-light">
        {{ $setting->hospital_name ?? 'Hospital OS Core' }}
    </span>

</a>