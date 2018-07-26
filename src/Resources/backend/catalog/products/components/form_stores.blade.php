<h2>Skladové zásoby</h2>

<div class="form-row">
  <div class="form-group col language-box-input no-input">
    <div class="radio-lang">
      @foreach (App\Models\Catalog\Store::all() as $element)
        <input
        id="store{{ $element->id }}"
        class="click-and-show"
        type="radio"
        data-id="{{ $element->id }}"
        data-type="store"
        {{ $element->id == 1 ? 'checked' : '' }}
        >
        <label
        for="store{{ $element->id }}">
          {{ $element->name }}
        </label>
      @endforeach
    </div>
  </div>
</div>

@foreach (App\Models\Catalog\Store::all() as $element)
  <div class="click-and-show-container" data-id="{{ $element->id }}" data-type="store">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label>Počet na skladě</label>
        <input class="form-control" type="text" name="stores[{{ $element->id }}]" value="{{ old('stores['.$element->id.']', isset($item) && !empty($item->stores()->wherePivot("store_id", $element->id)->first()) ? $item->stores()->wherePivot("store_id", $element->id)->first()->pivot->quantity : "") }}" />
      </div>
    </div>
  </div>
@endforeach
