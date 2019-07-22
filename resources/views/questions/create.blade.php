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
                               @include('partials.form', ['buttonText' => 'Ask'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

