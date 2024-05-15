@extends('Master.main')
@section('links')

  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<nav>
    <ol class="breadcrumb bg-primary text-white-all">
    <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-tachometer-alt"></i> dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Attribution </li>
</ol>
</nav>

<section class="section">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Attribution Partenaire</h4>
              <div class="card-header-action">
                <div class="card-header-action">
                    <button type="button" class="btn btn-primary" onclick="get_partenaire();" data-toggle="modal" data-target="#exampleModal">choisir l'admin</button>
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
                      <th>N</th>
                      <th>Progress</th>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="formModal">Attribuer un Admin :</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="" action="{{route('partenaires.store')}}" method="POST">
        @csrf
        <div class="form-group">
          <label>Choisir l'admin</label>
            <div class="input-group">
                <select class="form-control select2" name="Admin[]" style="width: 100%" multiple="" data-placeholder="Sélectionnez vos options">
                    @foreach ($users as $item)
                            <option value="{{$item->id}}">{{$item->name .' '. $item->lastname}}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="partenaires" id="partenaires">
        </div>

        <button type="submit" id="attribution_partenaire" style="width: 100%" class="btn btn-success m-t-15 waves-effect">Attribuer</button>
      </form>
    </div>
  </div>
</div>
</div>

@section('scripts')
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>

    <script>


function get_partenaire() {
    try {
        // Récupérer toutes les cases à cocher qui sont cochées
        var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

        // Tableau pour stocker les valeurs des cases cochées
        var checkedCheckboxes = [];

        // Parcourir toutes les cases cochées et obtenir leurs valeurs
        checkboxes.forEach(function(checkbox) {
            checkedCheckboxes.push(checkbox.value);
        });

        // Attribuer les valeurs des cases cochées au champ caché dans le formulaire
        document.getElementById('partenaires').value = checkedCheckboxes.join(',');

    } catch (error) {
        console.error('Erreur:', error);
        // Gérez l'erreur si nécessaire
    }
}



    </script>
@endsection
