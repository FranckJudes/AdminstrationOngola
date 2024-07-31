<div class="modal fade" id="UpdateLivreur" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
