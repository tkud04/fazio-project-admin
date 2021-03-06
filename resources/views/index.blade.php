<?php
$title = "Dashboard";
$subtitle = "Admin dashboard";

$rbrcData = $stats['rbrcData'];
$trmData = $stats['trmData'];
$trmData2 = $stats['trmData2'];
?>

@extends('layout')

@section('scripts')
<link href="{{asset('lib/morris-bundle/morris.css')}}" rel="stylesheet">
<script src="{{asset('lib/morris-bundle/raphael.min.js')}}"></script>
<script src="{{asset('lib/morris-bundle/morris.js')}}"></script>
<script src="{{asset('lib/morris-bundle/morris-init.js')}}"></script>
<script>
let rbrcData = [
<?php

 $opts4 = [
								'studio' => "Studio",
												    '1bed' => "1 bedroom",
												    '2bed' => "2 bedrooms",
												    '3bed' => "3 bedrooms",
												    'penthouse' => "Penthouse apartment",
					  ];

foreach($rbrcData as $k => $v)
{
?>
{value: {{$v}}, label: "{{$opts4[$k]}}"},
<?php
}
?>
];

let trmData = [

<?php

$ctr = 0;

foreach($trmData as $k => $v)
{
?>
{x: "{{$k}}", y: {{$v}},}@if($ctr < count($trmData)),@endif
<?php
++$ctr;
}
?>
        ];
		
console.log(trmData);
</script>
@stop

@section('title',$title)
@section('content')
 <div class="ecommerce-widget">

                        <div class="row">
						<?php
						 //total apartments
						 $ta = $stats['total_apartments'];
						 $tap = (($ta - 2) / $ta) * 100;
						 $taClass = "text-success";
						 $taIcon = "<span><i class='fa fa-fw fa-arrow-up'></i></span>";
						 
						 if($tap < 0)
						 {
							 $taClass = "text-secondary";
							 $taIcon = "<span><i class='fa fa-fw fa-arrow-down'></i></span>";
						 }
						 else if($tap == 0)
						 {
							 $taClass = "text-primary";
							 $taIcon = "";
						 }
						 
						 //total bookings
						 $tb = $stats['total_bookings'];
						 $tbp = 0;
						 $tbClass = "text-success";
						 $tbIcon = "<span><i class='fa fa-fw fa-arrow-up'></i></span>";
						 
						 if($tbp < 0)
						 {
							 $tbClass = "text-secondary";
							 $tbIcon = "<span><i class='fa fa-fw fa-arrow-down'></i></span>";
						 }
						 else if($tbp == 0)
						 {
							 $tbClass = "text-primary";
							 $tbIcon = "";
						 }
						 
						 //total hosts
						 $th = $stats['total_hosts'];
						 $thp = 0;
						 $thClass = "text-success";
						 $thIcon = "<span><i class='fa fa-fw fa-arrow-up'></i></span>";
						 
						 if($thp < 0)
						 {
							 $thClass = "text-secondary";
							 $thIcon = "<span><i class='fa fa-fw fa-arrow-down'></i></span>";
						 }
						 else if($thp == 0)
						 {
							 $thClass = "text-primary";
							 $thIcon = "";
						 }
						?>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Apartments</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{$ta}}</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right {{$taClass}} font-weight-bold">
										{!! $taIcon !!}<span>{{$tap}}%</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue"></div>
                                </div>
                            </div>
                           
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Bookings</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{$tb}}</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right {{$tbClass}} font-weight-bold">
                                            {!! $tbIcon !!}<span>{{$tbp}}%</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue3"></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Hosts</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{$th}}</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right {{$thClass}} font-weight-bold">
                                            {!! $thIcon !!}<span>{{$thp}}%</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue4"></div>
                                </div>
                            </div>
                        </div>
                        
                            <!-- ============================================================== -->
                      
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="row">
							<div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Recent Bookings</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">#</th>
                                                        <th class="border-0">Guest</th>
                                                        <th class="border-0">Apartment</th>
                                                        <th class="border-0">Status</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												$opts5 = [
								'unfurnished' => "Unfurnished apartment",
												    'Furnished' => "Furnished apartment",
												    'serviced' => "Serviced apartment",
					  ];
												
									   if(count($orders) > 0)
									   {
										   $ordersLength = count($orders) > 5 ? 5 : count($orders);
									    for($ctr = 0; $ctr < $ordersLength; $ctr++)
										{
											$o = $orders[$ctr];
										  $ref = $o['reference'];
										  $guest = $o['guest'];
										  $avatar = $guest['avatar'];
                                                                                  if($avatar == "") $avatar = [asset("images/avatar.png")];
										  $gname = $guest['fname']." ".$guest['lname'];
										  
										  $ru = url('receipt')."?xf=".$ref;
										  $cu = "javascript:void(0)";
										  $s = ""; $liClass = ""; $ps = "";

										  $items = $o['items'];
										  $ii = $items['data'];
										  $subtotal = $items['subtotal'];
										  $bookingDetails = [];
										  
										  
										  
										  foreach($ii as $i)
										  {
											            $temp = [];
														 $apartment = $i['apartment'];
														 $temp['au'] = $apartment['url'];
														 $temp['name'] = $apartment['name'];
														 $cmedia = $apartment['cmedia'];
														 $temp['imgs'] = $cmedia['images'];
														 $adata = $apartment['data'];
														 $temp['terms'] = $apartment['terms'];
														 $host = $apartment['host'];
														 $temp['hostName'] = $host['fname']." ".substr($host['lname'],0,1).".";
														 $temp['amount'] = $adata['amount'];
														 $address = $apartment['address'];
														 $temp['location'] = $address['city'].", ".$address['state'];
														 $temp['checkin'] = $i['checkin'];
														 $temp['checkout'] = $i['checkout'];
														 $temp['guests'] = $i['guests'];
														 $temp['kids'] = $i['kids'];
														 array_push($bookingDetails,$temp);
														 
														 $ptype = $adata['property_type'];
														 
										  }			 
											  
									   ?>
                                                    <tr>
                                                        <td>{{$ctr + 1}}</td>
                                                        <td>
														  <img class="rounded-circle mr-3 mb-3" src="{{$avatar[0]}}" alt="{{$gname}}" style="width: 100px; height: 100px;"/><br>
														  {{$gname}} <br> Reference #: <a href="javascript:void(0)">{{$ref}}</a>
														</td>
                                                        <td>
														   <div class="card" style="overflow-y: scroll;">
                                <h5 class="card-header">Items</h5>
                                <div class="card-body">
                                    <div class="list-group">
									   <?php
									    for($iiCtr = 0; $iiCtr < count($ii); $iiCtr++)
										{
											$i = $bookingDetails[$iiCtr];
											$ll = ""; $sm = " class='text-muted'"; $tc = "";
											$iiu = "javascript:void(0)";
											
											if($iiCtr == 0)
											{
												$ll = " active";
											    $sm = "";
											    $tc = " text-white";
											}
											
											$imgs = $i['imgs'];
											
											//status
											$status = $o['status']; $ss = ""; $ssClass = "";
											
											switch($status)
											{
												case "paid":
												  $ss = "Completed"; $ssClass = "success";
												break;
												
												case "unpaid":
												  $ss = "On hold"; $ssClass = "warning";
												break;
												
												case "cancelled":
												  $ss = "Cancelled"; $ssClass = "danger";
												break;
											}
											
									   ?>
                                        <a href="{{$iiu}}" class="list-group-item list-group-item-action flex-column align-items-start{{$ll}}">
                                            <div class="d-flex w-100 justify-content-between">
											<img class="rounded-circle mr-3 mb-3" src="{{$imgs[0]}}" alt="{{$i['name']}}" style="width: 100px; height: 100px;"/>
											 
											  <div>
                                                <h5 class="mb-1{{$tc}}">{{$i['name']}}</h5>
                                                <h5 class="mb-1{{$tc}}">{{$opts5[$ptype]}}</h5>
                                                 <!--
												 <small{{$sm}}>{{$i['checkin']." - ".$i['checkout']}}</small>
												 <p class="mb-1">Adults: {{$i['guests']}} | Children: {{$i['kids']}}</p>
                                                 <small{{$sm}}>Price per night: &#8358;{{number_format($i['amount'])}}</small>
											      -->
											  </div>
											 
                                            </div>
                                            
                                        </a>
										<?php
										}
										?>
                                    </div>
                                </div>
                            </div>
                                                        </td>
                                                        <td><span class="badge-dot badge-{{$ssClass}} mr-1"></span>{{$ss}} </td>
                                                    </tr>
                                        <?php
										 
										}
										}
										?>       
                                                    <tr>
                                                        <td colspan="9"><a href="{{url('orders')}}" class="btn btn-outline-light float-right">View more</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end recent orders  -->		
							
							<div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12">
                                <!-- ============================================================== -->
                                <!-- top perfomimg  -->
                                <!-- ============================================================== -->
                                <div class="card">
                                    <h5 class="card-header">Top Performing Hosts</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table no-wrap p-table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">Host</th>
                                                        <th class="border-0">Apartments</th>
                                                        <th class="border-0">Revenue</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												if(count($tph) > 0)
												{
													$tphLength = count($tph) > 5 ? 5 : count($tph);
													for($i = 0; $i < $tphLength; $i++)
													{
														$t = $tph[$i];
													
												?>
                                                    <tr>
                                                        <td>{{$t['name']}}</td>
                                                        <td>{{$t['apartments']}}</td>
                                                        <td>&#8358;{{number_format($t['revenue'],2)}}</td>
                                                    </tr>
												<?php
													}
												}
												?>
                                                    <tr>
                                                        <td colspan="3">
                                                            <a href="{{url('tph')}}" class="btn btn-outline-light float-right">View more</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- end top perfomimg  -->
                                <!-- ============================================================== -->
								
								<!-- ============================================================== -->
                                <!-- subscription plans  -->
                                <!-- ============================================================== -->
                                <div class="card">
                                    <h5 class="card-header">Subscription Plans</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table no-wrap p-table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">Name</th>
                                                        <th class="border-0">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												if(count($plans) > 0)
												{
													$pLength = count($plans) > 5 ? 5 : count($plans);
													for($i = 0; $i < $pLength; $i++)
													{
														$p = $plans[$i];
													
												?>
                                                    <tr>
                                                        <td>{{$p['name']}}</td>
                                                        <td>&#8358;{{number_format($p['amount'],2)}}/{{$p['frequency']}}</td>
                                                    </tr>
												<?php
													}
												}
												?>
                                                    <tr>
                                                        <td colspan="3">
                                                            <a href="{{url('plans')}}" class="btn btn-outline-light float-right">View more</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- end subscription plans  -->
                                <!-- ============================================================== -->
								
								<!-- ============================================================== -->
                                <!-- apartment tips -->
                                <!-- ============================================================== -->
                                <div class="card">
                                    <h5 class="card-header">Apartment Tips</h5>
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-md-12">
											 <center>
											  <h4>{{count($tips)}} apartment tip(s) added.</h4>
											   <a href="{{url('apartment-tips')}}" class="btn btn-outline-light float-right">View more</a>
											 </center>
											</div> 
                                        </div>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- end apartment tips  -->
                                <!-- ============================================================== -->
							</div>
							</div>
							
							<div class="row">
                            <!-- ============================================================== -->
                            <!-- total revenue  -->
                            <!-- ============================================================== -->
  
                            
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- category revenue  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Revenue by Room Category</h5>
                                    <div class="card-body">
                                        <div id="revenue_by_room_category" style="height: 420px;"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end category revenue  -->
                            <!-- ============================================================== -->

                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header"> Total Revenue</h5>
                                    <div class="card-body">
                                        <div id="total_revenue_month"></div>
                                    </div>
                                    <div class="card-footer">
                                        <p class="display-7 font-weight-bold"><span class="text-primary d-inline-block">&#8358;26,000</span><span class="text-success float-right">+9.45%</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
							
							</div>
							
@stop
