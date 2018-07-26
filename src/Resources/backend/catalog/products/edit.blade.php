@extends('layouts.admin')

@section('content')
    <form action="{{ route(Request::route()->getController()->getPath().'.update', ['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
      {{ method_field('PATCH') }}
      @csrf

      <input type="hidden" id="product_id" value="{{ $item->id }}">


      @include('backend.components.headers.edit_header')

      <div class="tabs">
        <div class="container">
          <ul class="nav" role="tablist">
            <li class="nav-item active">
              <a class="nav-link" href="#tab1" data-toggle="tab">Hlavní</a>
            </li>
            <li class="nav-item variantable" style="{{ $item->type == 2 ? '' : 'display: none;' }}">
              <a class="nav-link" href="#tab2" data-toggle="tab">Varianty</a>
            </li>
            <li class="nav-item novariant" style="{{ $item->type == 1 ? '' : 'display: none;' }}">
              <a class="nav-link" href="#tab3" data-toggle="tab">Sklad</a>
            </li>
            <li class="nav-item novariant" style="{{ $item->type == 1 ? '' : 'display: none;' }}">
              <a class="nav-link" href="#tab4" data-toggle="tab">Ceník</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tab5" data-toggle="tab">Štítky</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tab6" data-toggle="tab">Související produkty</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tab7" data-toggle="tab">SEO</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tab8" data-toggle="tab">Parametry</a>
            </li>
          </ul>

        </div>
      </div>

      <div class="container">
        @include('backend.components.errors')
      </div>

      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab1">
          @include(Request::route()->getController()->getPath().'.components.form_main')
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
          @include(Request::route()->getController()->getPath().'.components.form_variants')
        </div>
        <div role="tabpanel" class="tab-pane" id="tab3">
          @include(Request::route()->getController()->getPath().'.components.form_stores')
        </div>
        <div role="tabpanel" class="tab-pane" id="tab4">
          @include(Request::route()->getController()->getPath().'.components.form_prices')
        </div>
        <div role="tabpanel" class="tab-pane" id="tab5">
          @include(Request::route()->getController()->getPath().'.components.form_tags')
        </div>
        <div role="tabpanel" class="tab-pane" id="tab6">
          @include(Request::route()->getController()->getPath().'.components.form_related')
        </div>
        <div role="tabpanel" class="tab-pane" id="tab7">
          @include(Request::route()->getController()->getPath().'.components.form_seo')
        </div>
        <div role="tabpanel" class="tab-pane" id="tab8">
          @include(Request::route()->getController()->getPath().'.components.form_attributes')
        </div>
      </div>
    </form>
@endsection
