@forelse ($item->attributes as $attribute)
  <tr class="item">
    <td>{{ $attribute->group->name }}</td>
    <td>{{ $attribute->name }}</td>
    <td>
      <div class="table-buttons">
        <ul>
          <li class="smazat">
            <button type="button" class="removePart" data-api="removeAttributeProduct" data-container="attributesProduct" data-id="{{ $attribute->id }}" data-parent_id="{{ $item->id }}" onclick="return confirm('Opravdu chcete smazat tento záznam?')">Smazat</button>
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
