<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/22/2019
 * Time: 7:54 PM
 */?>

@if (session('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif
