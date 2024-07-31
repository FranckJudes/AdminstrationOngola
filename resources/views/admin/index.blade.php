

@extends('Master.main')
@section('links')

  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <nav>
            <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-tachometer-alt"></i> dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Administrateurs</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Les Administrateurs</h4>
                <div class="card-header-action"><button data-toggle="modal"
                    data-target="#exampleModalCenter" class="btn btn-success">Ajouter un Admin</button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                    <thead>
                      <tr>
                        <th>N</th>
                        <th>Noms & Prenoms</th>
                        <th>Email</th>
                        <th>Sexe</th>
                        <th>Telephone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($SousAdmin as  $key => $item)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->name .' ' . $item->lastname}}</td>
                        <td>{{$item->email}}</td>
                        <td>@if($item->sexe == '1') Masculin @else Feminin @endif</td>
                        <td>{{$item->telephone}}</td>

                        <td>
                            <div class="dropdown d-inline">
                                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton2"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Options
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item has-icon" onclick="update_livreur_model({{json_encode($item)}});"><i class="far fa-edit"></i> Modifier</a>
                                  <a class="dropdown-item has-icon" onclick="confirmDelete('{{ route('admin.destroy',$item->id)}}', '{{ $item->id }}')"><i class="far fa-trash-alt"></i> Supprimer</a>
                                  <a class="dropdown-item has-icon" href="{{route('partenaire_associes',$item->id)}}"  ><i class="fas fa-address-card"></i> Les partenaires associes</a>
                                </div>
                              </div>
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


@endsection
@include('all_modal_app.modal_admin')

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
         function update_livreur_model(item){
        console.log(item);
            $('#nom_update').val(item.name);
            $('#update_update').val(item.id);


            $('#prenom_update').val(item.lastname);
            $('#adresse_update').val(item.email);
            $('#telephone_update').val(item.telephone);
            if (item.sexe === '1') {
                $('input[name="sexe"][value="1"]').prop('checked', true);
            } else if (item.sexe === '2') {
                $('input[name="sexe"][value="2"]').prop('checked', true);
            }

            $('#UpdateLivreur').modal('show');
        }

    function confirmDelete(url,id){
        swal({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            buttons: ['Annuler', 'Oui, supprimer !'],
        }).then((result) => {
            if (result) {

                        $.ajax({
                            url: 'admin/'+ id,
                            method: 'DELETE',
                            data: {
                                        _token: '{{ csrf_token() }}'
                                    },
                            success: function(response) {
                                console.log(response);

                                if(response.status === 'error'){
                                    iziToast.error({
                                        title: '{{ __('message._error') }} !'
                                        , message: '{{ __('message._error') }}'
                                        , position: 'topRight'
                                    });
                                 reloadPage();
                                }else{
                                    iziToast.success({
                                        title: '{{ __('message._sucet') }} !'
                                        , message: '{{ __('message._sucet') }}'
                                        , position: 'topRight'
                                    });
                                 reloadPage();

                                }
                            },
                            error: function(error) {
                                // Gestion des erreurs

                                console.log(error);
                            }
                        });
            }
        });
    }

    function reloadPage(){
        location.reload();

    }
    </script>
@endsection
