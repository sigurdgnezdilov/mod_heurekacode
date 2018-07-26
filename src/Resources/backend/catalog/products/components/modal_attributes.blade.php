
<div class="alert-box" style="display: none;">
    <div class="alert alert-danger" role="alert"></div>
</div>

@foreach (App\Models\Catalog\AttributeGroup::all() as $group)
  <div class="variant">
    <h3>{{ $group->name }}</h3>
    <ul>
      @foreach ($group->attributes as $attribute)
        <li class="addToVariant" data-group="{{ $group->id }}" data-id="{{ $attribute->id }}">{{ $attribute->name }}</li>
      @endforeach
    </ul>
    <div>
      <input class="newAttribute" data-group="{{ $group->id }}" placeholder="Název nové varianty" type="text">
      <button class="addAttribute" type="button" data-type="products" data-group="{{ $group->id }}">Přidat</button>
    </div>
  </div>
@endforeach
