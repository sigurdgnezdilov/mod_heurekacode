@extends('layouts.admin')

@section('content')
    <form action="{{ route(Request::route()->getController()->getPath().'.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      @include('backend.components.headers.create_header')

      <div class="tabs">
        <div class="container">
          <ul class="nav" role="tablist">
            <li class="nav-item active">
              <a class="nav-link" href="#tab1" data-toggle="tab">Hlavní</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tab2" data-toggle="tab">SEO</a>
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
          @include(Request::route()->getController()->getPath().'.components.form_seo')
        </div>
      </div>
    </form>
@endsection
