{{-- jquery/addVariant.js -> #variants(form_variants.blade.php) --}}
@forelse ($item->childs as $variant)
  <tr class="item">
    {{-- <td><input type="checkbox" class="check" data-id="{{ $item->id }}"></td> --}}
    <td>{{ $variant->id }}</td>
    <td>{{ $variant->lang->name }}</td>
    <td>
      <span class="box">
        <img src="{{ !empty($variant->image[0]->path) ? Storage::disk(config('ls.disk'))->url(App\Models\Admin\AdminSection::where('route', 'backend.catalog.products')->first()->prefix.'/'.$variant->id.'/90x90'.$variant->image[0]->path) : '/img/noimage.png' }}" />
      </span>
    </td>
    <td>
      <div class="form-row">
        <div class="col-md-5 select">
          <select class="form-control showBySelect" data-type="stores">
            @foreach (App\Models\Catalog\Store::all() as $element)
              <option value="{{ $element->id }}">{{ $element->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-7">
          @foreach (App\Models\Catalog\Store::all() as $element)
            <input class="form-control itemToShow" style="{{ $element->id > 1 ? 'display: none;' : '' }}" data-type="stores" data-id="{{ $element->id }}" type="text" name="stores[{{ $element->id }}]" value="{{ old('stores['.$element->id.']', isset($variant) && !empty($variant->stores()->wherePivot("store_id", $element->id)->first()) ? $variant->stores()->wherePivot("store_id", $element->id)->first()->pivot->quantity : "") }}" />
          @endforeach
        </div>
      </div>
    </td>
    <td>
      <div class="form-row">
        <div class="col-md-5 select">
          <select class="form-control showBySelect" data-type="prices">
            @foreach (App\Models\Catalog\PriceGroup::all() as $element)
              <option value="{{ $element->id }}">{{ $element->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-7">
          @foreach (App\Models\Catalog\PriceGroup::all() as $element)
            <input class="form-control itemToShow" style="{{ $element->id > 1 ? 'display: none;' : '' }}"  data-type="prices" data-id="{{ $element->id }}" type="text" name="prices[{{ $element->id }}]" value="{{ old('prices['.$element->id.']', isset($variant) && !empty($variant->prices()->wherePivot("price_group_id", $element->id)->first()) ? $variant->prices()->wherePivot("price_group_id", $element->id)->first()->pivot->price : "") }}" />
          @endforeach
        </div>
      </div>
    </td>
    <td>
      <label class="switch">
        <input type="checkbox" class="changeStatus" data-column="active" data-id="{{ $variant->id }}" data-catalog="Catalog\Product" {{ $variant->active == 1 ? 'checked' : '' }}>
        <span class="slider"></span>
      </label>
    </td>
    <td>
      <div class="table-buttons">
        <ul>
          <li class="editovat"><a href="{{ route('backend.catalog.products.edit', ['id' => $variant->id]) }}">Editovat</a></li>
          <li class="duplikovat"><a href="{{ route('backend.catalog.products.duplicate', ['id' => $variant->id]) }}">Duplikovat</a></li>
          <li class="smazat">
            <button type="button" class="removePart" data-api="removeVariant" data-container="variants" data-id="{{ $variant->id }}" data-parent_id="{{ $item->id }}" onclick="return confirm('Opravdu chcete smazat tento záznam?')">Smazat</button>
          </li>
        </ul>
      </div>
    </td>
  </tr>
@empty
    <tr>
      <td colspan="100">Žádné záznamy</td>
    </tr>
@endforelse
