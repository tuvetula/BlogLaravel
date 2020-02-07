<div class="container text-center">
    <h2>Post mis à jour</h2>
</div>
<p>Le post {{ $post->title }} sur lequel vous avez posté des commentaires, a été mis à jour le {{ date_format($post->updated_at,'d_m-Y à H:i:s') }}</p>
<p>Voici le post modifié:</p>
<p>{{ $post->post }}</p>
