<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/19/2019
 * Time: 7:12 PM
 */?>


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                       <div class="card-header">
                           <div class="d-flex align-items-center">
                               <h2>Ask question</h2>
                               <div class="ml-auto">
                                   <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary" >Back</a>
                               </div>
                           </div>

                       </div>
                        <div class="card-body">

                            <form action="{{ route('questions.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="question-title">Question Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" id="question-title" class="form-control {{ ($errors->has('title'))? "is-invalid" : "" }}">
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback"><strong>{{$errors->first('title')}}</strong></div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="question-body">Explain your question </label>
                                    <textarea name="body" id="question-body" rows="10" class="form-control {{ ($errors->has('body'))? "is-invalid" : "" }}">{{ old('body') }}</textarea>
                                    @if ($errors->has('body'))
                                        <div class="invalid-feedback"><strong>{{$errors->first('body')}}</strong></div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-outline-primary btn-lg">Ask a question</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

