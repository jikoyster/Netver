<?php $name = "Mr. White"; ?>

@extends('layouts.doctracc.main')

@section('title','Sample Page')

@section('content')
 <p style="width: 40%">
 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque praesentium expedita porro reprehenderit ex similique a excepturi minima doloribus et voluptas dolores debitis repellat, architecto, suscipit ullam accusamus, rerum quidem.
 </p>
 {{$name}}
 @stop

