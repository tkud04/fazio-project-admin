<?php
$title = "Add Apartment Tip";
$subtitle = "Add a tip or piece of information to show guests when viewing an apartment";
?>

@extends('layout')

@section('title',$title)


@section('page-header')
@include('page-header',['title' => $title,'subtitle' => $subtitle])
@stop


@section('content')
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">{{$title}}</h5>
                                <div class="card-body">
                                    <form action="{{url('add-apartment-tip')}}" id="aat-form" method="post">
										{!! csrf_field() !!}
										
										<div class="row">
										<div class="col-md-12">
										<div class="form-group">
                                            <label>Title (optional)</label>
                                            <input id="aat-title" type="text" placeholder="Enter a title for your tip" name="title" class="form-control">
                                        </div>
										</div>
										<div class="col-md-12">
										<div class="form-group">
                                            <label for="aat-message">Message</label>
                                             <textarea class="form-control" name="message" placeholder="Your message" id="aat-message"></textarea>
                                        </div>
										</div>
										</div>
										
										
                                        <div class="row">
                                            <div class="col-sm-12 pl-0">
                                                <p class="text-right">
                                                    <button class="btn btn-space btn-secondary" id="aat-form-btn">Submit</button>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
</div>
@stop