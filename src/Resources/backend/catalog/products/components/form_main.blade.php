<h2>Základní údaje</h2>
<div class="form-row">
  <div class="form-group col-md-4">
    <label>Název</label>
    <div class="language-box-input">
      <div class="radio-lang">
        @foreach (App\Models\General\Lang::all() as $element)
          <input
          id="lang{{ $element->id }}"
          class="click-and-show"
          type="radio"
          data-id="{{ $element->id }}"
          data-type="lang"
          {{ $element->id == 1 ? 'checked' : '' }}
          >
          <label
          for="lang{{ $element->id }}">
            <img src="/img/{{ $element->code }}.png" alt="CZ">
            {{ $element->code }}
          </label>
        @endforeach
      </div>
      @foreach (App\Models\General\Lang::all() as $element)
        <div class="click-and-show-container" data-id="{{ $element->id }}" data-type="lang">
          <input class="form-control" type="text" name="name_{{ $element->id }}" value="{{ old('name_'.$element->id, isset($item) && !empty($item->detail()->where("lang_id", $element->id)->first()) ? $item->detail()->where("lang_id", $element->id)->first()->name : "") }}" />
        </div>
      @endforeach
    </div>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-12">
      <label>Kategorie</label>
      <div class="select_parent_tree" style="overflow-x: hidden; height: 200px;">
        @include('backend/catalog/products/components/tree', ['childs' => App\Models\Catalog\Category::whereNull('parent_id')->get()])
      </div>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-3 select">
    <label>Typ produktu </label>
    <select id="variantable" name="type" class="form-control">
      <option value="1" {{ $item->type == 1 ? 'selected' : '' }}>Samostatný produkt</option>
      <option value="2" {{ $item->type == 2 ? 'selected' : '' }}>Produkt s variantami</option>
      {{-- <option value="3">Produkt je varianta</option> --}}
    </select>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-2">
    <label for="name">code heureka</label>
    <input
            class="form-control"
            type="text"
            name="codeheureka"
            value="{{ old('codeheureka', isset($item) ? $item->codeheureka : "") }}"
    >
  </div>
</div>
{{-- <div class="form-row isvariant" style="display: none;">
  <div class="form-group col-md-2">
    <label for="parent_id">Rodičovský produkt</label>
    <div class="info-content"><img src="/img/info.svg" alt="Informace">
      <div class="content">
        Zadejte název, nebo ID produktu, pro který je tento produkt jeho variantou.
      </div>
    </div>
    <input
    class="form-control"
    type="text"
    name="parent_id"
    value="{{ old('parent_id', isset($item) ? $item->parent_id : "") }}"
    >
  </div>
</div> --}}

<div class="form-inline">
  <label class="switch">
    <input
    type="checkbox"
    name="active"
    value="1"
    {{ old('active') ? "checked" : "" }}
    {{ isset($item) && $item->active == 1 ? "checked" : "" }}
    >
    <span class="slider"></span>
  </label>
  <label>Aktivní</label>
</div>

<hr />

<h2>Popis produktu</h2>

<div class="form-row">
  <div class="form-group col language-box-input no-input">
    <div class="radio-lang">
      @foreach (App\Models\General\Lang::all() as $element)
        <input
        id="lang1{{ $element->id }}"
        class="click-and-show"
        type="radio"
        data-id="{{ $element->id }}"
        data-type="lang"
        >
        <label
        for="lang1{{ $element->id }}">
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
      <div class="form-group col-md-12">
        <label>Krátky popis</label>
        <textarea
        class="form-control"
        type="text"
        id="editor{{ $element->id }}"
        name="description_short_{{ $element->id }}"
        rows="4"
        >
        {{ old('description_short_'.$element->id, isset($item) && !empty($item->detail()->where("lang_id", $element->id)->first()) ? $item->detail()->where("lang_id", $element->id)->first()->description_short : "") }}
        </textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-12">
        <label>Dlouhý popis</label>
        <textarea
        class="form-control"
        type="text"
        id="editor_1_{{ $element->id }}"
        name="description_{{ $element->id }}"
        rows="8"
        >
        {{ old('description_'.$element->id, isset($item) && !empty($item->detail()->where("lang_id", $element->id)->first()) ? $item->detail()->where("lang_id", $element->id)->first()->description : "") }}
        </textarea>
      </div>
    </div>

  </div>
@endforeach

<hr />

<h2>Fotogalerie</h2>

<div class="form-row">
  <div class="form-group col-md-12">
    <label>Logo</label>
    <div class="logo-upload">
      @foreach ($item->image as $image)
          <div class="imageContainer">
            <img src="{{ !empty($image->path) ? Storage::disk(config('ls.disk'))->url(App\Models\Admin\AdminSection::where('route', Request::route()->getController()->viewDirPath)->first()->prefix.'/'.$item->id.'/200x200'.$image->path) : '/img/noimage.png' }}" />
            <button type="button" class="showImage"></button>
            <button type="button" class="deleteImage" data-id="{{ $image->id }}"></button>
            <label><input type="radio" name="images" class="changeMainImage" data-catalog="Catalog\Product" data-catalog_id="{{ $item->id }}" data-id="{{ $image->id }}" {{ $image->main == 1 ? 'checked' : '' }} /></label>
          </div>
      @endforeach
      <div id="images-container" class="ajaxContent"></div>

      <div>
        <input name="images[]" type="file" data-catalog="Catalog\Product" data-catalog_id="{{ $item->id }}" data-catalog="Catalog\Product" class="addImageContainer" value="Přidat" multiple>
      </div>

    </div>

  </div>
</div>

<hr />

<h2>Doplňující údaje</h2>

<div class="form-row">
  <div class="form-group col-md-3 select special">
    <label>Výrobce</label>
    <select class="select2" name="manufacturer_id" class="form-control">
      <option value="0">Žádný</option>
      @foreach (App\Models\Catalog\Manufacturer::all() as $manufacturer)
        <option value="{{ $manufacturer->id }}" {{ isset($item) && $item->manufacturer_id == $manufacturer->id  ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
      @endforeach
    </select>
  </div>
</div>
