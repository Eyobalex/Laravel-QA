<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/28/2019
 * Time: 12:20 AM
 */?>
<span class="text-muted">{{ $label }} {{ $model->created_date }}</span>
<div class="media">
    <a href="{{$model->user->url}}" class="pr-2">
        <img src="{{ $model->user->avatar }}" alt="">
    </a>
    <div class="media-body">
        <a href="{{ $model->user->url }}">{{ $model->user->name }}</a>
    </div>
</div>
