<div class="container">
    <div id="listTags" class="row p-3">
        @foreach($comment->tags as $tag)
            <div class="row rounded bg-primary mr-4 my-1 my-sm-0">
                <span class="text-light text-center px-2" state="here" >{{ $tag->name }}</span>
                <button class="btn btn-danger btn-sm text-light py-0 border border-danger" onclick="changeStateTags(event)">x</button>
            </div>
        @endforeach
    </div>
</div>
