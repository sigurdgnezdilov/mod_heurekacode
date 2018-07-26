<table class="table">
  <thead>
    <tr>
      <th scope="col">Název</th>
      <th scope="col">Aktivní</th>
    </tr>
  </thead>
  <tbody id="sortable">
  @foreach (App\Models\Catalog\Tag::all() as $tag)
    <tr class="item">
      <td>{{ $tag->name }}</td>
      <td>
        <label class="switch">
          <input type="checkbox" name="tags[]" value="{{ $tag->id }}"  {{ !is_null($item->tags()->where('id', $tag->id)->first()) ? 'checked' : '' }}>
          <span class="slider"></span>
        </label>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
