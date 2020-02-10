<label for="tag" class="font-weight-bold">Tag</label>
<div class="row">
    <div class="col-sm-3">
        <input list=listTagsChoices type="text" class="form-control" id="tag" placeholder="Saisir un tag">
        <datalist id="listTagsChoices">
            @foreach($tagsChoice as $tag)
                <option value="{{ $tag->name }}"></option>
            @endforeach
        </datalist>
    </div>
    <div class="col-sm-1 py-1 py-sm-0 text-right text-sm-left">
        <button type="button" id="buttonAddTags" class="btn btn-primary">Ajouter</button>
    </div>
</div>

