  <a href="#" data-toggle="modal" data-target="#addVariant" class="btn btn-success add">
    Přidat variantu
  </a>

  @include('backend.catalog.products.components.modal_addVariant')

  <table class="table">
    <thead>
      <tr>
        {{-- <th scope="col"><input type="checkbox" class="check_all"></th> --}}
        <th scope="col">ID</th>
        <th scope="col">Varianta</th>
        <th scope="col">Obrázek</th>
        <th scope="col">Sklad</th>
        <th scope="col">Cena</th>
        <th scope="col">Aktivní</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody id="variants" class="ajaxContent">
      @include(Request::route()->getController()->getPath().'.components.variants')
    </tbody>
  </table>
