@extends('Master.main')
@section('links')

  <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css')}}">
  <link rel="stylesheet"href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<nav>
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-tachometer-alt"></i> dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> les Admins </li>
    </ol>
</nav>

<section class="section">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Les partenaires Associes a {{$users->name .' '. $users->lastname}}</h4>
              <div class="card-header-action">
                <div class="card-header-action">
                    <button type="button" class="btn btn-danger" onclick="get_partenaire();" data-toggle="modal" data-target="#exampleModal">Retirer a L'admin  </button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-2">
                  <thead>
                    <tr>
                      <th class="text-center pt-3">
                        <div class="custom-checkbox custom-checkbox-table custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                            class="custom-control-input" id="checkbox-all">
                          <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                      </th>
                      <th>Noms et Prenoms</th>
                      <th>Adresse </th>
                      <th>Members</th>
                      <th>Actif depuis :</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($partenaires as $item)
                      <tr>
                          <td class="text-center pt-2">
                              <div class="custom-checkbox custom-control">
                                  <input type="checkbox" data-checkboxes="mygroup" value="{{$item->id}}"  class="custom-control-input"
                                  id="checkbox-{{$loop->iteration}}">
                                  <label for="checkbox-{{$loop->iteration}}" class="custom-control-label">&nbsp;</label>
                              </div>
                          </td>
                          <td>{{$item->nom}}</td>
                          <td class="align-middle">
                            {{$item->adresse}}
                          </td>
                          <td>
                              <img alt="image" src="{{ asset($item->logo) }}" width="35">
                          </td>
                          <td>{{ $item->created_at }}</td>
                          <td>
                          </td>

                      </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
@endsection



@section('scripts')
    <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/jszip.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>



@endsection
