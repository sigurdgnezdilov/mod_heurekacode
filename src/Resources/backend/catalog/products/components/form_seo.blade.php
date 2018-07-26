<div class="form-row">
  <div class="form-group col language-box-input no-input">
    <div class="radio-lang">
      @foreach (App\Models\General\Lang::all() as $element)
        <input
        id="seo-desc-lang{{ $element->id }}"
        class="click-and-show"
        type="radio"
        name="seo-desc-lang"
        data-id="{{ $element->id }}"
        data-type="lang"
        {{ $element->id == 1 ? 'checked' : '' }}
        >
        <label
        for="seo-desc-lang{{ $element->id }}">
          <img src="/img/{{ $element->code }}.png" alt="CZ">
          {{ $element->code }}
        </label>
      @endforeach
    </div>
  </div>
</div>

@foreach (App\Models\General\Lang::all() as $element)
  <div class="click-and-show-container" data-id="{{ $element->id }}" data-type="lang">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label>SEO Popis</label>
        <input
        class="form-control"
        type="text"
        name="seo_description_{{ $element->id }}"
        value="{{ old('seo_description_'.$element->id, isset($item) && !empty($item->seo()->where("lang_id", $element->id)->first()) ? $item->seo()->where("lang_id", $element->id)->first()->description : "") }}"
        >
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label>Klíčová slova</label>
        <input
        class="form-control"
        type="text"
        name="seo_keywords_{{ $element->id }}"
        value="{{ old('seo_keywords_'.$element->id, isset($item) && !empty($item->seo()->where("lang_id", $element->id)->first()) ? $item->seo()->where("lang_id", $element->id)->first()->keywords : "") }}"
        >
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label>SEO titulek</label>
        <input
        class="form-control"
        type="text"
        name="seo_title_{{ $element->id }}"
        value="{{ old('seo_title_'.$element->id, isset($item) && !empty($item->seo()->where("lang_id", $element->id)->first()) ? $item->seo()->where("lang_id", $element->id)->first()->title : "") }}"
        >
      </div>
    </div>
  </div>
@endforeach
