@foreach($available_locales as $language => $locale)
    @if ($locale !== $current_locale)
        <a href="{{ route('language.switch', $locale) }}" class="nav-link">{{ $language }}</a>
    @endif
@endforeach
