<?php
$title = "Plans";
$subtitle = "View all subscription plans";
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
@include('page-header',['title' => $title,'subtitle' => $subtitle])
@stop

@section('content')
<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					
                        <div class="card">
                            <h5 class="card-header">Plans</h5>
							<a href="{{url('add-plan')}}" class="btn btn-outline-secondary">Add plan</a>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first etuk-table">
                                        <thead>
                                            <tr>
                                                 <th>Plan</th>
                                                 <th>Added by</th>
                                                 <th>Status</th>
                                                 <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										  <?php
										   if(count($plans) > 0)
										   {
											  foreach($plans as $p)
											   {
												    $name = $p['name'];
												    $amount = $p['amount'];
												    $description = $p['description'];
												    $date = $p['date'];
												    $updated = $p['updated'];
												    $ps_id = $p['ps_id'];
							                        $author = $p['added_by'];
										            $avatar = $author['avatar'];
                                                    if($avatar == "") $avatar = [asset("images/avatar.png")];
										            $aname = $author['fname']." ".$author['lname'];
													$ru = url('remove-plan')."?xf=".$p['id'];
													$ss = $p['status'] == "enabled" ? "badge-primary" : "badge-danger";
													
													$sciType = "disable";
													$sciText = "Disable plan";
													
													if($p['status'] == "disabled")
													{
														$sciType = "enable";
													    $sciText = "Enable plan";
													}
													$sci = url('ed-plan')."?xf=".$p['id']."&type=".$sciType;
													$pu = url('plan')."?xf=".$p['id'];
										  ?>
                                            <tr>
											     <td>
												   <a href="{{$pu}}">
												     <h4>{{ ucwords($name) }}</h4>
												    </a>
													<div>
													  <span>&#8358;{{number_format($amount,2)}} / month</span><br>
													  <span>Description: <em>{!! $description !!}</em></span><br>
													  <span>PayStack ID: <b>{!! $ps_id !!}</b></span><br>
													</div>
												 </td>
											     <td>
												  <img class="rounded-circle mr-3 mb-3" src="{{$avatar[0]}}" alt="{{$aname}}" style="width: 100px; height: 100px;"/>
												  <br>{{ $aname }}
												</td>
					                             <td><span class="badge {{$ss}}">{{ strtoupper($p['status']) }}</span></td>
					                            <td>
						                          <a class="btn btn-outline-primary" href="{{$sci}}">{{$sciText}}</a>
						                          <a class="btn btn-outline-danger" href="{{$ru}}">Remove</a>
                                                </td>
                                            </tr>
									     <?php
											   }
										   }
										 ?>
									   </tbody>
									</table>
							    </div>
							 </div>
						</div>
                    </div>
                </div>			
@stop