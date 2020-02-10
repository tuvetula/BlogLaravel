<label for="tag" class="font-weight-bold">Tag</label>
<div class="container row">
    <input list=listTagsChoices type="text" class="form-control col-md-3" id="tag" placeholder="Saisir un tag">
    @if(!empty($tags))
        <datalist id="listTagsChoices">
            @foreach($tags as $tag)
                <option value="{{ $tag->name }}"></option>
            @endforeach
        </datalist>
    @endif
    <button type="button" id="buttonAddTags" class="btn btn-primary col-md-1 ml-1">Ajouter</button>
</div>
