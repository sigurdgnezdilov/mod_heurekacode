<ul>
@foreach($childs as $child)
	@if (!isset($category) || $child->id <> $category->id)
		<li class="{{ isset($item) && $item->category_id == $child->id ? 'active focused' : '' }}">
      <input type="radio" name="category_id" value="{{ $child->id }}" {{ isset($item) && $item->category_id == $child->id ? 'checked' : '' }}>
      <label>{{ $child->lang->name }}</label>
				@if(count($child->childs))
	          @include('backend/catalog/products/components/tree', ['childs' => $child->childs])
	      @endif
		</li>
	@endif
@endforeach
</ul>
