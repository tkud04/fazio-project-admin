

<?php
														 $au = url('apartment')."?xf=".$apartment['apartment_id'];
														 $name = $apartment['name'];
														 $cmedia = $apartment['cmedia'];
														 $media = $apartment['media'];
														 $rawImgs = $media['images'];
														 $imgs = $cmedia['images'];
														 $adata = $apartment['data'];
														 $terms = $apartment['terms'];
														 $host = $apartment['host'];
														 $avatar = $host['avatar'];
                                                  if($avatar == "") $avatar = [asset("images/avatar.png")];
										  $hname = $host['fname']." ".$host['lname'];
										  $uu = url('user')."?xf=".$host['email'];
														 $address = $apartment['address'];
														 $location = $address['city'].", ".$address['state'];
														 $facilities = $apartment['facilities'];
														 
$title = ucwords($name);
$subtitle = "View information about this apartment.";
														 
?>
@extends('layout')

@section('title',$title)

@section('scripts')
  <!-- DataTables CSS -->
  <link href="{{asset('lib/datatables/css/buttons.bootstrap.min.css')}}" rel="stylesheet" /> 
  <link href="{{asset('lib/datatables/css/buttons.dataTables.min.css')}}" rel="stylesheet" /> 
  <link href="{{asset('lib/datatables/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" /> 
  
      <!-- DataTables js -->
       <script src="{{asset('lib/datatables/js/datatables.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/datatables-init.js')}}"></script>
@stop

@section('page-header')
@include('page-header',['title' => "Apartments",'subtitle' => "View Apartment"])
@stop

@section('content')
<script>
let selectedSide = 1, facilities = [], aptImages = [], aptImgCount = {{count($cmedia['images'])}},
    aptCover = "0", aptCurrentImgCount = "{{count($imgs)}}";

$(document).ready(() => {
$('#admin-apt-side-2').hide();
let apartmentDescriptionEditor = new Simditor({
		textarea: $('#admin-apt-description'),
		toolbar: toolbar,
		placeholder: `This is the description`
	});
	
	apartmentDescriptionEditor.setValue(`{!! $adata['description'] !!}`);

 <?php
	foreach($facilities as $ff)
	  {
  ?>
    toggleFacility("{{$ff['facility']}}");
  <?php
	  }
	  
	  foreach($rawImgs as $ri)
	  {
		  $imgId = $ri['id'];
  ?>
      $(`#sci-{{$imgId}}-loading`).hide();
  <?php  
	  }
  ?>
	aptRemoveImage({id: 'my-apartment',ctr: '0'});
});

</script>
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
							
                                <h5 class="card-header">{{$name}}</h5>
                                <div class="card-body">
                                    <form action="javascript:void(0)" id="t-form">
									    <div class="row">
										
										<div class="col-md-3 row" style="border-right: 1px solid #ccc; margin-right: 3px;">
										 <div class="col-md-12">
										  <a href="{{$au}}">
										   <div class="form-group">
                                               <label>Apartment</label>
                                               <div class="form-control hover">
										         <img class="rounded-circle mr-3 mb-3" src="{{$imgs[0]}}" alt="{{$name}}" style="width: 100px; height: 100px;"/><br>
												 {{$name}}
										       </div>
                                            </div>
										   </a><br>
										   <a href="{{$uu}}">
										  <div class="form-group">
                                             <label>Host</label>
                                             <div class="form-control hover">
										       <img class="rounded-circle mr-3 mb-3" src="{{$avatar[0]}}" alt="{{$hname}}" style="width: 100px; height: 100px;"/><br>
											   {{$hname}} 
										     </div>
                                           </div>
										   </a>
										 </div>
										 
										</div>
										<div class="col-md-8">
										<div id="admin-apt-side-1">
										  <div class="row mb-3">
										     <div class="col-md-12">
											  <h3>Basic Information</h3>
											 </div>
										    <div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Apartment ID<i class="req">*</i></label>
												<input type="text" class="form-control" value="{{$apartment['apartment_id']}}" readonly>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Friendly URL<i class="req">*</i></label>
												<input type="text" class="form-control" id="my-apartment-url" value="{{$apartment['url']}}">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Friendly Name<i class="req">*</i></label>
												<input type="text" class="form-control" id="my-apartment-name" value="{{$apartment['name']}}" placeholder="Give your apartment a name e.g Royal Hibiscus">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Price per day(&#8358;)<i class="req">*</i></label>
												<input type="number" class="form-control" id="my-apartment-amount" value="{{$adata['amount']}}" placeholder="Enter amount in NGN">
											</div>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
										<?php
										  $av = ['available' => "Available",
										         'occupied' => "Occupied",
										         'unavailable' => "Unavailable"
												 ];
										?>
											<div class="form-group">
												<label>Availability<i class="req">*</i></label>
												<select class="form-control" id="my-apartment-avb">
												  <option value="none">Select availability</option>
												  <?php
												  foreach($av as $key => $value)
												  {
													  $ss = $key == $apartment['avb'] ? " selected='selected'" : "";
												  ?>
												  <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												  }
												  ?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Max no. of guests<i class="req">*</i></label>
												<input type="number" class="form-control" id="my-apartment-max-adults" value="{{$terms['max_adults']}}" placeholder="The max number of adults allowed to check-in">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Pets<i class="req">*</i></label>
												<?php
												 $opts3 = [
												    'no' => "No",
													'yes' => "Yes"
												 ];
												?>
												<select class="form-control" id="my-apartment-pets">
												<?php
												  foreach($opts3 as $key => $value)
												  {
													  $ss = $key == $terms['pets'] ? " selected='selected'" : "";
												?>
												  <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												<?php
												  }
												?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label>Description</label>
												<textarea id="admin-apt-description" class="form-control"></textarea>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Category<i class="req">*</i></label>
												<select class="form-control" id="my-apartment-category">
												  <option value="none">Select category</option>
												  <?php
												  $aptCategories = [
												    'studio' => "Studio",
												    '1bed' => "1 bedroom",
												    '2bed' => "2 bedrooms",
												    '3bed' => "3 bedrooms",
												    'penthouse' => "Penthouse apartment",
												    'duplex' => "Duplex"
												  ];
												  foreach($aptCategories as $key => $value)
												  {
													  $ss = $adata['category'] == $key ? " selected='selected'" : "";
												  ?>
												  <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												  }
												  ?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Property type<i class="req">*</i></label>
												<select class="form-control" id="my-apartment-ptype">
												  <option value="none">Select type</option>
												  <?php
												  $aptTypes = [
												    'unfurnished' => "Unfurnished apartment",
												    'Furnished' => "Furnished apartment",
												    'serviced' => "Serviced apartment",
												  ];
												  foreach($aptTypes as $key => $value)
												  {
													  $ss = $adata['property_type'] == $key ? " selected='selected'" : "";
												  ?>
												  <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												  }
												  ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>No. of rooms<i class="req">*</i></label>
												<select class="form-control" id="my-apartment-rooms">
												  <option value="none">Select number of rooms</option>
												  <?php
												   for($i = 0; $i < 5; $i++)
												   {
                                                     $rr = $i == 0 ? "room" : "rooms";
                                                     $ss = $adata['rooms'] == ($i + 1) ? " selected='selected'" : "";													 
												  ?>
												  <option value="{{$i + 1}}"{{$ss}}>{{$i + 1}} {{$rr}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>No. of units<i class="req">*</i></label>
												<select class="form-control" id="my-apartment-units">
												  <option value="none">Select number of units</option>
												  <?php
												   for($i = 0; $i < 5; $i++)
												   {
                                                     $rr = $i == 0 ? "unit" : "units";
                                                     $ss = $adata['units'] == ($i + 1) ? " selected='selected'" : "";													 
												  ?>
												  <option value="{{$i + 1}}"{{$ss}}>{{$i + 1}} {{$rr}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>No. of bathrooms<i class="req">*</i></label>
												<select class="form-control" id="my-apartment-bathrooms">
												  <option value="none">Select number of bathrooms</option>
												  <?php
												   for($i = 0; $i < 5; $i++)
												   {
                                                     $rr = $i == 0 ? "bathroom" : "bathrooms";
                                                     $ss = $adata['bathrooms'] == ($i + 1) ? " selected='selected'" : "";													 
												  ?>
												  <option value="{{$i + 1}}"{{$ss}}>{{$i + 1}} {{$rr}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>No. of bedrooms<i class="req">*</i></label>
												<select class="form-control" id="my-apartment-bedrooms">
												  <option value="none">Select number of bedrooms</option>
												  <?php
												   for($i = 0; $i < 5; $i++)
												   {
                                                     $rr = $i == 0 ? "bedroom" : "bedrooms";
                                                     $ss = $adata['bedrooms'] == ($i + 1) ? " selected='selected'" : "";													 
												  ?>
												  <option value="{{$i + 1}}"{{$ss}}>{{$i + 1}} {{$rr}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>
										
										  </div>
										  
										 </div>
										 <div id="admin-apt-side-2">
										 
											 <div class="row mb-3">
											    <div class="col-md-12">
											     <h3>Extras</h3>
											    </div>
		                                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 20px;">
													<h4 class="mb-3">Facilities & Services</h4>
												</div>										
										
												<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 20px;">
													<div class="form-group">
											   
														<div class="row">
														  <?php
													        foreach($services as $s)
															{
																$key = $s['tag'];
																$value = $s['name'];
													      ?>
														  <div class="col-lg-3 col-md-6 col-sm-12">
												   
		 												    <a class="btn btn-primary btn-sm text-white apt-service" id="apt-service-{{$key}}" onclick="toggleFacility('{{$key}}')" data-check="unchecked">
															  <center><i id="apt-service-icon-{{$key}}" class="ti-control-stop"></i></center>
															</a>
															 <label>{{$value}}</label>
														  </div>
														  <?php
															}
														  ?>
														</div>
												
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12">
											<h4 class="mb-3">Location & Media</h4>
										</div>
																			
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label>Address<i class="req">*</i></label>
												<input type="text" class="form-control" id="my-apartment-address" value="{{$address['address']}}" placeholder="House address">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>City<i class="req">*</i></label>
												<input type="text" class="form-control" id="my-apartment-city" value="{{$address['city']}}" placeholder="City">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>LGA<i class="req">*</i></label>
												<input type="text" class="form-control" id="my-apartment-lga" value="{{$address['lga']}}" placeholder="LGA">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>State<i class="req">*</i></label>
												<select class="form-control" id="my-apartment-state">
												  <option value="none">Select state</option>
												  <?php
												   foreach($states as $key => $value)
												   {
													   $ss = $key == $address['state'] ? " selected='selected'" : "";
												  ?>
												    <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Country<i class="req">*</i></label>
												<select class="form-control" id="my-apartment-country">
												  <option value="none">Select country</option>
												  <?php
												   foreach($countries as $key => $value)
												   {
													   $ss = $key == $address['country'] ? " selected='selected'" : "";
												  ?>
												    <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label>Images<i class="req">*</i></label>
												<div class="row">
												 <?php
												  for($x = 0; $x < count($imgs); $x++)
												  {
													  $img = $imgs[$x];
													  $imgId = $rawImgs[$x]['id'];
													  $cover = $rawImgs[$x]['cover'];
													  $dt = "{apartment_id: '".$apartment['apartment_id']."',id:".$imgId."}";
												 ?>
												 <div class="col-lg-4 col-md-4 col-sm-12" id="my-apartment-current-img-{{$imgId}}">
												    <div>
												      <img src="{{$img}}" alt="preview" style="width: 100px; height: 100px;"/>	
                                                       @if($cover == "yes")
                                                        <label class="label label-success" id="my-apartment-cover-label">Cover image</label>
                                                       @endif														   
												    </div>
												    <div style="margin-top: 10px;" id="sci-{{$imgId}}-submit">
													   @if($cover == "no")
													   <a href="javascript:void(0)" onclick="myAptSetCurrentCoverImage({{$dt}})" class="btn btn-theme btn-sm">Set as cover image</a>
												       @endif
													   <a href="javascript:void(0)" onclick="myAptRemoveCurrentImage({{$dt}})"class="btn btn-warning btn-sm">Remove</a>
												    </div>
													<div style="margin-top: 10px;" id="sci-{{$imgId}}-loading">
													   <h4>Processing.. <img src="{{asset('img/loading.gif')}}" class="img img-fluid" alt="Processing.."></h4>
													</div>
												  </div>
												  <?php
												  }
												  ?>
												</div>
											</div>
										</div>
											 </div>
										 </div>
										 <a href="javascript:void(0)" class="btn btn-primary" id="admin-apt-prev">Previous</a>
										 <a href="javascript:void(0)" class="btn btn-primary" id="admin-apt-next">Next</a>
										</div>
										
										</div>
										
										

                                    </form>
                                </div>
                            </div>
                        </div>
</div>			
@stop
