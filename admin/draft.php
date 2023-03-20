<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Ajouter un ouvrage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" id="title" name="Title_add" required>
                    </div>
                    <div class="form-group">
                        <label for="nomAuteur">Nom de l'auteur:</label>
                        <input type="text" class="form-control" id="nomAuteur" name="Author_Name_add" required>
                    </div>
                    <div class="form-group">
                        <label for="State_add">Etat</label>
                        <select class="form-control" id="State_add" name="State_add">
                            <option value="Dechire">Déchiré</option>
                            <option value="Neuf">Neuf</option>
                            <option value="BonEtat">Bon état</option>
                            <option value="Acceptable">Acceptable</option>
                            <option value="AssezUse">Assez usé</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="Livre">Livre</option>
                            <option value="Roman">Roman</option>
                            <option value="DVD">DVD</option>
                            <option value="MemoireDeRecherche">mémoire de recherche</option>
                            <option value="Magazine">magazine</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dateEdition">Date d'édition</label>
                        <input type="date" class="form-control" id="dateEdition" name="dateEdition" required>
                    </div>
                    <div class="form-group">
                        <label for="dateAchat">Date d'achat</label>
                        <input type="date" class="form-control" id="dateAchat" name="dateAchat" required>
                    </div>
                    <div class="form-group">
                        <label for="nombrePage">Nombre des pages</label>
                        <input type="number" min="0" class="form-control" id="nombrePage" name="nombrePage" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Confirmer</button>
            </div>
        </div>
    </div>
</div>