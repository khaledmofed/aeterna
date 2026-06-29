{{-- Pass $langs (array) and $tabPrefix (string) from parent --}}
<ul class="nav nav-pills gap-1 mb-3 flex-wrap" role="tablist">
  @foreach($langs as $locale => $lang)
  <li class="nav-item" role="presentation">
    <button class="nav-link {{ $locale === 'en' ? 'active' : '' }}"
            data-bs-toggle="pill"
            data-bs-target="#{{ $tabPrefix }}-{{ str_replace('-','_',$locale) }}"
            type="button" role="tab">
      {{ $lang['flag'] }} {{ $lang['name'] }}
    </button>
  </li>
  @endforeach
</ul>
