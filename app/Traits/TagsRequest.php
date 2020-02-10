<?php
namespace App\Traits;

use App\Http\Requests\TagRequest;
use App\Models\Comment;
use App\Models\Tag;

trait TagsRequest
{
    /**
     * @param TagRequest $tagRequest
     */
    public function tagsAttach(TagRequest $tagRequest)
    {
        if(!empty($tagRequest->tags)){
            $tags = explode(',', $tagRequest->tags);
            foreach ($tags as $tagValue){
                if(strlen($tagValue) > 0){
                    $tag = new Tag;
                    $tag->name = $tagValue;
                    $tagExistInBdd = Tag::where('name' , '=' , $tagValue)->get();
                    if($tagExistInBdd->count() == 0){
                        $this->tags()->save($tag);
                    }else{
                        $this->tags()->attach($tagExistInBdd->first()->id);
                    }
                }
            }
        }
    }

    public function tagsDetach(TagRequest $tagRequest)
    {
        if(!empty($tagRequest->tagsToDelete)){
            $tagsToDelete = explode(',' , $tagRequest->tagsToDelete);
            foreach ($tagsToDelete as $tagValue){
                $tagExistInBdd = Tag::where('name', '=', $tagValue)->get();
                if ($tagExistInBdd->count() > 0) {
                    $this->tags()->detach($tagExistInBdd->first()->id);
                }
            }
        }
    }

    public function tagsDetachByTagId(int $id)
    {
        $this->tags()->detach($id);

    }
}
