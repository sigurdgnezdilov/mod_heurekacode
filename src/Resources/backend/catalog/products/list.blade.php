@extends('layouts.admin')

@section('content')

  @include('backend.components.headers.list_header')

  <form action="{{ route(Request::route()->getController()->getPath().'.list') }}">

    <div class="searching">
      <div class="container">
          <div class="form-row">
            <div class="form-group col-md-10">
              <input type="text" name="name" class="form-control" id="hledani" placeholder="Vyhledejte dle názvu" value="{{ Request::get('name') }}">
              <button type="submit" class="btn hledani">HLEDAT <img src="/img/hledat.svg" alt="hledat"></button>
            </div>
            <div class="form-group col-md-2">
              <button type="submit" class="btn filter">Zobrazit filtr</button>
            </div>
          </div>
      </div>
    </div>

    <div class="container">
      @include('backend.components.errors')
      @include('backend.components.messages')
    </div>

    <div class="container">
      <div class="form-row">
        <div class="form-group col-md-4 select">
          <select id="massChange" data-catalog="{{ App\Models\Admin\AdminSection::where('route', '=', Request::route()->getController()->viewDirPath)->first()->system_path }}" class="form-control">
            <option value="" selected disabled>Vyberte akci</option>
            <option value="1">Smazat</option>
          </select>
        </div>

        <div class="form-group col-md-3">
          <button id="massChangeSubmit" type="button" class="btn btn-primary">Potvrdit</button>
        </div>
      </div>

      <div class="form-row zobrazeni">
        <div class="form-group col">
          Zobrazeno: <strong>{{ $list->total() }} výsledků</strong>
        </div>
      </div>

      Počet k zobrazení
      <select name="perPage" class="list_count">
        <option value="100" {{ $list->perPage() == 100 ? 'selected' : '' }}>100</option>
        <option value="50" {{ $list->perPage() == 50 ? 'selected' : '' }}>50</option>
        <option value="25" {{ $list->perPage() == 25 ? 'selected' : '' }}>25</option>
        <option value="10" {{ $list->perPage() == 10 ? 'selected' : '' }}>10</option>
      </select>
    </div>
  </form>

  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col"><input type="checkbox" class="check_all"></th>
          <th scope="col">ID</th>
          <th scope="col">Heureka Kod</th>
          <th scope="col">Logo</th>
          <th scope="col">Název</th>
          <th scope="col">Cena</th>
          <th scope="col">Aktivní</th>
          <th scope="col">Pozice</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody class="sortable">
      @foreach ($list as $item)
        <tr class="item">
          <td><input type="checkbox" class="check" data-id="{{ $item->id }}"></td>
          <td>{{ $item->id }}</td>
          <td>{{($item->codeheureka) }}</td>
          <td>
            <span class="box">
              <img src="{{ !empty($item->image[0]->path) ? Storage::disk(config('ls.disk'))->url(App\Models\Admin\AdminSection::where('route', Request::route()->getController()->viewDirPath)->first()->prefix.'/'.$item->id.'/90x90'.$item->image[0]->path) : '/img/noimage.png' }}" />
            </span>
          </td>
          <td>{{ $item->lang->name }}</td>
          <td></td>
          <td>
            <active-button :id="{{ $item->id }}" :status="{{ $item->active }}" :catalog="{{ json_encode(App\Models\Admin\AdminSection::where('route', Request::route()->getController()->viewDirPath)->first()->system_path)}}"></active-button>
          </td>
          <td class="drag-it" data-id="{{ $item->id }}" data-position="{{ $item->position }}" data-catalog="{{ App\Models\Admin\AdminSection::where('route', Request::route()->getController()->viewDirPath)->first()->system_path }}">
            <span>{{ $item->position }}</span>
            <i></i>
          </td>
          <td>
            <div class="table-buttons">
              <ul>
                <li class="presunout"><a href="{{ route(Request::route()->getController()->getPath().'.show', ['id' => $item->id]) }}">Zobrazit</a></li>
                <li class="editovat"><a href="{{ route(Request::route()->getController()->getPath().'.edit', ['id' => $item->id]) }}">Editovat</a></li>
                <li class="duplikovat"><a href="#">Duplikovat</a></li>
                <li class="smazat">
                  <form action="{{route(Request::route()->getController()->getPath().'.delete', [$item->id])}}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    @csrf
                    <button type="submit" onclick="return confirm('Opravdu chcete smazat tento záznam?')">Smazat</button>
                  </form>
                </li>
              </ul>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    {{ $list->links() }}
  </div>

  @include('backend.catalog.products.components.modal_addProduct')

@endsection
