<?php
$title = "Ticket #".$t['ticket_id'];
$subtitle = "View ticket trail.";
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
@include('page-header',['title' => "Tickets",'subtitle' => "View Ticket Trail"])
@stop

@section('content')
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
							<?php
							$subject = $t['subject'];
							$type = $t['type'];
							$status = $t['status'];
							$items = $t['items'];
							$date = $t['date'];
							$utu = url('update-ticket')."?xf=".$t['ticket_id'];
							
							  $guest = $t['user'];
										  $avatar = $guest['avatar'];
                                         
										 if($avatar == "") $avatar = [asset("images/avatar.png")];
										  $gname = $guest['fname']." ".$guest['lname'];
										  $uu = url('user')."?xf=".$guest['email'];
										 
							$statusClass = $status == "resolved" ? "label-primary" : "label-danger"; 
							?>
                                <h5 class="card-header">Transaction Details</h5>
                                <div class="card-body">
                                    <form action="javascript:void(0)" id="t-form">
									    <div class="row">
										
										<div class="col-md-4 row">
										 <div class="col-md-6">
										 <a href="{{$uu}}">
										  <div class="form-group">
                                             <label>Guest</label>
                                             <div class="form-control hover">
										       <img class="rounded-circle mr-3 mb-3" src="{{$avatar[0]}}" alt="{{$gname}}" style="width: 100px; height: 100px;"/><br>
											   {{$gname}} 
										     </div>
                                           </div>
										   </a>
										 </div>
										 <div class="col-md-6">
										  <a href="javascript:void(0)">
										   <div class="form-group">
                                               <label>Last response from</label>
											   <?php
											   $lastTI = $items[0];
								  $lastAuthor = $lastTI['author'];
								  $la_img = $lastAuthor['avatar'];
								  if($la_img == "") $la_img = [asset("images/avatar.png")];
								  $la_name = $lastAuthor['fname']." ".$lastAuthor['lname'];
											   ?>
                                               <div class="form-control hover">
										         <img class="rounded-circle mr-3 mb-3" src="{{$la_img[0]}}" alt="{{ucwords($la_name)}}" style="width: 100px; height: 100px;"/><br>
													 {{ucwords($la_name)}}
										       </div>
                                            </div>
										    </a>
										 </div>
										</div>
										<div class="col-md-8">
										  <div class="row mb-3">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Subject</label>
                                                  <p class="form-control-plaintext">{{$t['subject']}}</p>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Date created</label>
                                                  <p class="form-control-plaintext">{{$t['date']}}</p>
                                                </div>
										     </div>
										  </div>
										  <div class="row mb-3">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Last updated</label>
                                                  <p class="form-control-plaintext">{{$lastTI['date']}}</p>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Status</label>
                                                  <p class="form-control-plaintext"><span class="label {{$statusClass}}">{{strtoupper($status)}}</span></p>
                                                </div>
										     </div>
										  </div>
										 
										</div>
										
										</div>
										
										

                                    </form>
                                </div>
                            </div>
                        </div>
</div>	

<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Ticket Trail <a class="btn btn-outline-success ml-3" href="{{$utu}}">Update</a></h5>
                            <div class="card-body">
							  <?php
							    for($i = 0; $i < count($items); $i++)
								{
								  $ti = $items[$i];
								  $author = $ti['author'];
								  $img = $author['avatar'];
								  if($img == "") $img = [asset("images/avatar.png")];
								  $name = $author['fname']." ".$author['lname'];
								  
								  
								  $subjj = $i == 0 ? $subject : "Re: ".$subject;
							  ?>
                                <div class="media">
								<img class="mr-3 user-avatar-lg rounded" src="{{$img[0]}}" alt="{{$name}}">
                                    <div class="media-body">
                                        <h5>{{$subjj}}</h5>
                                        <p>{{$ti['msg']}}</p>
                                    </div>
									<p class="pull-right"><em>{{$ti['date']}}</em></p>
                                </div>
								<hr>
							  <?php
								}
							  ?>
                            </div>
                        </div>
                    </div>
</div>		
@stop