<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/24/2019
 * Time: 9:59 PM
 */?>

@extends('layouts.app')

@section('content')
    <div class="container">

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your answer ...</h3>
                </div>
                <hr>

                <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="answer">Edit your answer</label>
                        <textarea name="body" id="answer" rows="7" class="form-control {{ $errors->has('body') ? "is-invalid" : "" }}">{{ old('body',$answer->body) }}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-outline-primary">Submit</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
    </div>
    @endsection