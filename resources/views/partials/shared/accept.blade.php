<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/28/2019
 * Time: 12:47 AM
 */?>

@can('accept', $answer)
    <a href="" title="Mark this answer as best answer" class="answer {{$answer->status}} mt-2" onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit();">  <i class="fas fa-check fa-2x"></i>
    </a>
    <form action="{{route('answers.accept', $answer->id)}}" id="accept-answer-{{$answer->id}}" style="display: none;" method="post">
        @csrf
    </form>

@else
    @if ($answer->is_best)
        <a href="" title="this is the  best answer" class="answer {{$answer->status}} mt-2" >  <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan
