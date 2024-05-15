

@extends('Master.main')
@section('links')

  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <nav>
            <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-tachometer-alt"></i> dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Livreurs</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Mes Livreurs</h4>
                <div class="card-header-action"><button data-toggle="modal"
                    data-target="#exampleModalCenter" class="btn btn-success">Ajouter un livreur</button></div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                    <thead>
                      <tr>
                        <th>N</th>
                        <th>Name</th>
                        <th>Adresse</th>
                        <th>Sexe</th>
                        <th>Telephone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($livreurs as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->nom .' '. $item->prenom }}</td>
                                <td>{{ $item->adresse}}</td>
                                <td>@if($item->sexe == '1') Masculin @else Feminin @endif</td>
                                <td>{{ $item->telephone}}</td>
                                <td>
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton2"
                                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Options
                                        </button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item has-icon" onclick="update_livreur_model({{json_encode($item)}});"><i class="far fa-edit"></i> Modifier</a>
                                          <a class="dropdown-item has-icon" onclick="confirmDelete('{{ route('livreurs.destroy',$item->id)}}', '{{ $item->id }}')"><i class="far fa-trash-alt"></i> Supprimer</a>
                                          <a class="dropdown-item has-icon" @if($item->status =='1') href="{{route('suspendre_livreur',$item->id)}}" @else href="{{route('activer_livreur',$item->id)}}" @endif><i class="far fa-clock"></i> @if($item->status =='1') Suspendre @else Activer @endif</a>
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
<div class="modal fade" id="UpdateLivreur" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalCenterTitle"> Mettre a jour un livreur</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="{{route('livreurs.update',1)}}" method="POST">
             @method('PATCH')
        @csrf
        <div class="modal-body">
            <input type="hidden" name="id_update" id="update_update">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputEmail4">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom_update" placeholder="nom">
                </div>
                <div class="form-group col-md-6">
                <label for="inputPassword4">Prenom :</label>
                <input type="text" class="form-control" name="prenom" id="prenom_update" placeholder="prenom">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" name="adresse" id="adresse_update" placeholder="joe@gmail.com">
            </div>

            <div class="form-group">
                <label for="inputAddress2">Sexe</label>
                <div class="custom-switches-stacked mt-2" >
                    <label class="custom-switch">
                    <input type="radio" name="sexe" value="1" class="custom-switch-input" checked>
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">Masculin </span>
                    </label>
                    <label class="custom-switch">
                    <input type="radio" name="sexe" value="2" class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">Feminin</span>
                    </label>
                </div>

            </div>
            <div class="form-row">
                <label for="inputCity">Photo</label>
                <div class="custom-file form-group">
                <input type="file" class="custom-file-input" name="photo_permi" id="photo_update">
                <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Telephone</label>
                <input type="number" class="form-control" name="telephone" id="telephone_update" min="1" id="inputAddress" placeholder="Sans indicatif">
            </div>
            <div class="form-group mb-0">

            </div>
            </div>
        <div class="modal-footer bg-whitesmoke br">
        <button type="submit" class="btn btn-primary">Modifier</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferme</button>
        </div>
    </form>
  </div>
</div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalCenterTitle"> Ajouter un livreur</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="{{route('livreurs.store')}}"  method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputEmail4">Nom</label>
                <input type="text" class="form-control" id="update_nom" name="nom"  placeholder="nom">
                </div>
                <div class="form-group col-md-6">
                <label for="inputPassword4">Prenom :</label>
                <input type="text" class="form-control" id="update_prenom" name="prenom" placeholder="prenom">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="address" class="form-control" id="update_addresse" name="address"  placeholder="joe@gmail.com">
            </div>

            <div class="form-group">
                <label for="inputAddress2">Sexe</label>
                <div class="custom-switches-stacked mt-2" >
                    <label class="custom-switch">
                    <input type="radio" name="sexe" value="1" class="custom-switch-input" checked>
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">Masculin</span>
                    </label>
                    <label class="custom-switch">
                    <input type="radio" name="sexe" value="2" class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">Feminin</span>
                    </label>
                </div>

            </div>
            <div class="form-row">
                <label for="inputCity">Photo</label>
                <div class="custom-file form-group">
                <input type="file" class="custom-file-input" name="photo" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Telephone</label>
                <input type="number" name="telephone" class="form-control" min="1" max-length="9" id="update_telephone" placeholder="Sans indicatif">
            </div>
            <div class="form-group mb-0">

            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferme</button>
        </div>
    </form>
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

    function update_livreur_model(item){
        console.log(item);
        $('#nom_update').val(item.nom);
        $('#update_update').val(item.id);


        $('#prenom_update').val(item.prenom);
        $('#adresse_update').val(item.adresse);
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
                            url: 'livreurs/'+ id,
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
