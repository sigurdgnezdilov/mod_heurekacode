@forelse ($item->related as $related)
  <tr class="item">
    <td>{{ $related->lang->name }}</td>
    <td>
      <div class="table-buttons">
        <ul>
          <li class="smazat">
            <button type="button" class="removeRelated" data-id="{{ $item->id }}" data-related="{{ $related->id }}" onclick="return confirm('Opravdu chcete smazat tento záznam?')">Smazat</button>
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
