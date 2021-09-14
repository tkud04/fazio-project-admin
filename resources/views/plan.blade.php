<?php
$title = $p['name']." Plan";
$subtitle = "Edit this subscription plan.";				
?>

@extends('layout')

@section('title',$title)


@section('page-header')
@include('page-header',['title' => "Plans",'subtitle' => $title])
@stop


@section('content')
<script>
$(document).ready(() => {
let addPlanDescriptionEditor = new Simditor({
		textarea: $('#asp-description'),
		toolbar: toolbar,
		placeholder: `Enter your description here. Maximum of 200 words..`
	});
addPlanDescriptionEditor.setValue(`{!! $p['description'] !!}`);		

});

</script>
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Edit Plan</h5>
                                <div class="card-body">
                                    <form action="{{url('plan')}}" id="asp-form" method="post" enctype="multipart/form-data">
										{!! csrf_field() !!}
										<input type="hidden" name="xf" value="{{$p['id']}}"/> 
										<div class="row">
										<div class="col-md-12">
										<div class="form-group">
                                            <label for="asp-name">Name</label>
                                            <input id="asp-name" type="text" placeholder="Plan name" name="name" value="{{$p['name']}}" class="form-control">
                                        </div>
										</div>
										<div class="col-md-12">
										<div class="form-group">
                                            <label for="asp-amount">Amount</label>
                                             <input id="asp-amount" type="number" placeholder="Price" name="amount" value="{{$p['amount']}}" class="form-control">
                                        </div>
										</div>
										<div class="col-md-12">
										<div class="form-group">
                                            <label for="asp-tc">Post Count</label>
                                             <input id="asp-tc" type="number" placeholder="Posting count" name="pc" value="{{$p['pc']}}" class="form-control">
                                        </div>
										</div>
										<div class="col-md-12">
										<div class="form-group">
                                            <label for="asp-ps-id">Paystack ID (type <em>free</em> for free plans)</label>
                                             <input id="asp-ps-id" type="text" placeholder="Unique ID generated on Paystack" name="ps_id" value="{{$p['ps_id']}}" class="form-control">
                                        </div>
										</div>
										<div class="col-md-12">
										<div class="form-group">
                                            <label for="asp-frequency">Billing frequency</label>
                                             <select id="asp-frequency" name="frequency" class="form-control">
											   <option value="none">How frequent should customers should be billed?</option>
											   <?php
											    $frequencies = [
												  'free' => "Don't bill customers",
												  'day' => "Daily",
												  'week' => "Weekly",
												  '2-week' => "Every 2 weeks",												 
												  'month' => "Monthly",
												  '3-month' => "Quarterly",
												];
												
												foreach($frequencies as $k => $v)
												{
													$ss = $p['frequency'] == $k ? " selected='selected'" : "";
											   ?>
											    <option value="{{$k}}"{{$ss}}>{{$v}}</option>
											   <?php
											    }
											   ?>
											 </select>
                                        </div>
										</div>
										<div class="col-md-12">
										<div class="form-group">
                                            <label for="asp-description">Description <em>(optional)</em></label>
                                             <textarea class="form-control" name="description" id="asp-description"></textarea>
                                        </div>
										</div>
										<div class="col-md-12">
										<div class="form-group">
                                            <label for="asp-status">Status</label>
                                             <select id="asp-status" name="status" class="form-control">
											   <option value="none">Select status</option>
											   <?php
											    $statuses = [
												  'enabled' => "Enabled",
												  'disabled' => "Disabled"
												];
												
												foreach($statuses as $k => $v)
												{
													$ss = $p['status'] == $k ? " selected='selected'" : "";
											   ?>
											    <option value="{{$k}}"{{$ss}}>{{$v}}</option>
											   <?php
											    }
											   ?>
											 </select>
                                        </div>
										</div>
				
                                            <div class="col-md-12 pl-0">
                                                <p class="text-right">
                                                    <button class="btn btn-space btn-secondary" id="asp-form-btn">Submit</button>
                                                </p>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
</div>
@stop