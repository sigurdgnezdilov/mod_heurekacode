<div class="form-row">
  <div class="form-group col-md-6 select special">
    <label>Vyberte produkt</label>
    <select class="select2 selectRelated" data-id="{{ $item->id }}" class="form-control">
      <option value=""></option>
      @foreach (App\Models\Catalog\Product::all() as $product)
        <option value="{{ $product->id }}">{{ $product->lang->name }}</option>
      @endforeach
    </select>
  </div>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Název</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="relateds" class="ajaxContent">
    @include(Request::route()->getController()->getPath().'.components.relateds')
  </tbody>
</table>
