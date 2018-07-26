<a href="#" data-toggle="modal" data-target="#addAttribute" class="btn btn-success add">
  Přidat parametr
</a>

@include('backend.catalog.products.components.modal_addAttribute')


<table class="table">
  <thead>
    <tr>
      <th scope="col">Název</th>
      <th scope="col">Hodnota</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="attributesProduct" class="ajaxContent">
    @include(Request::route()->getController()->getPath().'.components.attributes')
  </tbody>
</table>
