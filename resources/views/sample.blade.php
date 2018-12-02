<?php $name = "Mr. White"; ?>

@extends('layouts.doctracc.main')

@section('title','Sample Page')

@section('content')
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="col-6">
        <p style="width: 40%">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque praesentium expedita porro reprehenderit ex similique a excepturi minima doloribus et voluptas dolores debitis repellat, architecto, suscipit ullam accusamus, rerum quidem.
        </p>
    </div>

    <div class="col-6">
        <h3>{{$name}}</h3>
    </div>
 </div>
 @stop

