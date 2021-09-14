<?php
$title = "Update Ticket";
$subtitle = "Update the ticket trail of a complaint/issue.";
?>

@extends('layout')

@section('title',$title)


@section('page-header')
@include('page-header',['title' => "Update Ticket",'subtitle' => $title])
@stop


@section('content')
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Re: {{$t['subject']}}</h5>
                                <div class="card-body">
                                    <form action="{{url('update-ticket')}}" id="ut-form" method="post">
										{!! csrf_field() !!}
										<input type="hidden" name="xf" value="{{$t['ticket_id']}}">
										<div class="row">
										  <div class="col-md-12">
										     <div class="form-group">
                                               <label>Your message</label>
                                               <textarea class="form-control" name="msg" id="ut-msg"></textarea>
                                              </div>
										   </div>
										</div>
										
										
                                        <div class="row">
                                            <div class="col-sm-12 pl-0">
                                                <p class="text-right">
                                                    <button class="btn btn-space btn-secondary" id="ut-form-btn">Submit</button>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
</div>
@stop