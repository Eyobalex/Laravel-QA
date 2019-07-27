<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/28/2019
 * Time: 12:45 AM
 */?>
<a href="" title="Mark this question as favorite" class="favorite {{ $model->favorite_class }}  mt-2" onclick="event.preventDefault(); document.getElementById('favorite-question-{{$model->id}}').submit();">  <i class="fas fa-star fa-2x"></i>
    <span class="favorite-count">{{ $model->favoriteCount }}</span></a>

<form action=" {{ $model->id }}/favorite" id="favorite-question-{{$model->id}}" style="display: none;" method="post">
    @csrf
    @if ($model->is_favorite)
        @method ('delete')
    @endif
</form>
