<!-- Modal -->
  <div class="modal" id="addAttribute" tabindex="-1" role="dialog" aria-labelledby="addAttribute" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nová hodnota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Parametr</label>
              <select class="attributeGroupId" class="form-control">
                @foreach (App\Models\Catalog\AttributeGroup::all() as $attribute)
                  <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Hodnota</label>
              <input class="form-control" id="newAttribute" type="text" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="addAttributeProductSubmit" data-id="{{ $item->id }}">Vytvořit hodnotu</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ZRUŠIT</button>
        </div>
      </div>
    </div>
  </div>
