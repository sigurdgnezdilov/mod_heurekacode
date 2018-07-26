<!-- Modal -->
<form action="{{ route(Request::route()->getController()->getPath().'.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Přidat {{ Request::route()->getController()->getSingle4Name() }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12">
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
                    <input class="form-control" type="text" name="name_{{ $element->id }}" value="{{ old('name_'.$element->id) }}" />
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
            <div class="form-group col select">
              <label>Typ produktu </label>
              <select id="variantable" name="type" class="form-control">
                <option value="1">Samostatný produkt</option>
                <option value="2">Produkt s variantami</option>
                {{-- <option value="3">Produkt je varianta</option> --}}
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Uložit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
        </div>
      </div>
    </div>
  </div>
</form>
