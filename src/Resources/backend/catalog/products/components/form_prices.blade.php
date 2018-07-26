<table class="table">
  <thead>
    <th>Cenová skupina</th>
    <th>Nákupní cena</th>
    <th>Prodejní cena</th>
    <th>Akční cena</th>
  </thead>

  <tbody>
    @foreach (App\Models\Catalog\PriceGroup::all() as $element)
      <tr>
        <td>{{ $element->name }}</td>
        <td>
          <input
          class="form-control"
          type="text"
          name="original_prices[{{ $element->id }}]"
          value="{{ old('original_prices['.$element->id.']', isset($item) && !empty($item->prices()->wherePivot("price_group_id", $element->id)->first()) ? $item->prices()->wherePivot("price_group_id", $element->id)->first()->pivot->original_price : "") }}"
          />
        </td>
        <td>
          <input
          class="form-control"
          type="text"
          name="prices[{{ $element->id }}]"
          value="{{ old('prices['.$element->id.']', isset($item) && !empty($item->prices()->wherePivot("price_group_id", $element->id)->first()) ? $item->prices()->wherePivot("price_group_id", $element->id)->first()->pivot->price : "") }}"
          />
        </td>
        <td>
          <input
          class="form-control"
          type="text"
          name="sale_prices[{{ $element->id }}]"
          value="{{ old('sale_prices['.$element->id.']', isset($item) && !empty($item->prices()->wherePivot("price_group_id", $element->id)->first()) ? $item->prices()->wherePivot("price_group_id", $element->id)->first()->pivot->sale_price : "") }}"
          />
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
