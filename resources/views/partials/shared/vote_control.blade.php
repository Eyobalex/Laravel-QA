<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/28/2019
 * Time: 12:31 AM
 */?>
@if ($model instanceof \App\Question)
    @php
        $route = 'voteQuestions';
        $title = '{{ $title }}';
    @endphp

    @elseif($model instanceof \App\Answer)
        @php
            $route = 'voteAnswers';
            $title = 'answer';
        @endphp
@endif

<div class="d-flex flex-column vote-controls">
    <a href="" title="This {{ $title }} is useful" class="vote-up" onclick="event.preventDefault(); document.getElementById('up-vote-{{ $title }}-{{$model->id}}').submit();">  <i class="fas fa-caret-up fa-3x"></i></a>
    <span class="vote">{{ $model->votes_count }}</span>
    <form action=" {{ route($route, $model->id  ) }}" id="up-vote-{{ $title }}-{{$model->id}}" style="display: none;" method="post">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <a href="" onclick="event.preventDefault(); document.getElementById('down-vote-{{ $title }}-{{$model->id}}').submit();" title="This {{ $title }} is not useful" class="vote-down"> <i class="fas fa-caret-down fa-3x"></i></a>
    <form action="{{ route($route, $model->id   ) }}" id="down-vote-{{ $title }}-{{$model->id}}" style="display: none;" method="post">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
   @if ($model instanceof \App\Question)
       @include('partials.shared.fav', ['model' => $model])
       
       @elseif($model instanceof \App\Answer)
       
       @include('partials.shared.accept', ['answers' => $model])
   @endif
</div>

