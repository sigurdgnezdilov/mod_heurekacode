<!-- Modal -->
  <div class="modal" id="addVariant" tabindex="-1" role="dialog" aria-labelledby="addVariant" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nová varianta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12 d-flex">
              <label>Varianta</label>
              <div id="showVariants">Vyberte parametry</div>
            </div>
          </div>
          <div id="attributes" class="ajaxContent variants">
            @include('backend.catalog.products.components.modal_attributes')
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="addVariantSubmit" class="btn btn-success" data-dismiss="modal">Vytvořit variantu</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ZRUŠIT</button>
        </div>
      </div>
    </div>
  </div>
