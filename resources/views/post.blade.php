<?php
$title = $p['title'];
$subtitle = "View post.";
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
@include('page-header',['title' => "Posts",'subtitle' => $p['title']])
@stop

@section('content')
							<?php
							$title = $p['title'];
							$url = $p['url'];
							$status = $p['status'];
							$content = $p['content'];
							$comments = $p['comments'];
							$date = $p['date'];
							$updated_at = $p['updated'];
							#$utu = url('update-post')."?xf=".$p['ticket_id'];
							$img = $p['img'];
							
							  $author = $p['author'];
										  $avatar = $author['avatar'];
                                         
										 if($avatar == "") $avatar = [asset("images/avatar.png")];
										  $aname = $author['fname']." ".$author['lname'];
										  $uu = url('user')."?xf=".$author['email'];
										 
							$statusClass = $status == "enabled" ? "label-primary" : "label-danger"; 
							?>

<script>
$(document).ready(() => {
let addPostContentEditor = new Simditor({
		textarea: $('#ap-content'),
		toolbar: toolbar,
		placeholder: `Enter your post content here. Maximum of 7000 words..`
	});
addPostContentEditor.setValue(`{!! $content !!}`);	
});


</script>
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">

                                <h5 class="card-header">Post Details</h5>
                                <div class="card-body">
                                    <form action="{{url('post')}}" method="post" id="ubp-form">
										{!! csrf_field() !!}
										<input type="hidden" name="xf" value="{{$p['id']}}"/>
									    <div class="row">
										
										<div class="col-md-4">
										  <div class="row">
										    <div class="col-md-12">
										      <a href="{{$uu}}">
										      <div class="form-group">
                                                <label>Author</label>
                                                <div class="form-control hover">
										          <img class="rounded-circle mr-3 mb-3" src="{{$avatar[0]}}" alt="{{$aname}}" style="width: 100px; height: 100px;"/><br>
											      {{$aname}} 
										        </div>
                                              </div>
										      </a>
										    </div>
										  </div>
										  <div class="row">
										    <div class="col-md-12">
										      <a href="javascript:void(0)">
										      <div class="form-group">
                                                <label>Image</label>
                                                <div class="form-control hover">
										          <img class="rounded-circle mr-3 mb-3" src="{{$img}}" alt="{{$title}}" style="width: 200px; height: 200px;"/><br>										       
										        </div>
                                              </div>
											  <div class="form-group">
                                            <label for="ap-img">Change image:</label>
                                            <div id="ap-images">
												<div id="ap-image-div-0" class="row">
												  <div class="col-md-7">
												    <input type="file" class="form-control" onchange="readURL(this,{id: 'ap',ctr: '0'})" id="ap-img-0" name="ap-images[]">												    
												  </div>
												  <div class="col-md-5">
												    <img id="ap-preview-0" src="#" alt="preview" style="width: 100px; height: 100px;"/>
													</div>
												</div>
										    </div>
                                        </div>
										      </a>
										    </div>
										  </div>
										</div>
										<div class="col-md-8">
										  <div class="row mb-3">
										    <div class="col-md-12">
										       <div class="form-group">
                                                 <label for="ap-title">Title</label>
                                                 <input id="ap-title" type="text" placeholder="Post title" name="title" value="{{$title}}" class="form-control">
                                               </div>
										    </div>
											<div class="col-md-12">
										       <div class="form-group">
                                                 <label for="ap-url">URL</label>
                                                 <input id="ap-url" type="text" placeholder="Friendly URL e.g. how-to-pick-an-apartment" name="url" value="{{$url}}" class="form-control">
                                               </div>
										    </div>
										     <div class="col-md-12">
										        <div class="form-group">
                                                  <label>Status</label>
												  <?php
										            $statuses = ['enabled' => "Enabled",
										            'disabled' => "Disabled"
													];
										          ?>
                                                  <select class="form-control" id="ap-status" name="status">
												  <option value="none">Select status</option>
												  <?php
												  foreach($statuses as $key => $value)
												  {
													  $ss = $key == $status ? " selected='selected'" : "";
												  ?>
												  <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												  }
												  ?>
												</select>
                                                </div>
										     </div>
											 <div class="col-md-6">										 
												<div class="form-group">
                                                  <label>Date created</label>
                                                  <p class="form-control-plaintext">{{$date}}</p>
                                                </div>
											 </div>
											 <div class="col-md-6">	
												<div class="form-group">
                                                  <label>Last updated</label>
                                                  <p class="form-control-plaintext">{{$updated_at}}</p>
                                                </div>
										     </div>
										  </div>
										</div>
										
										</div>
										
										<div class="row mb-3">
										     <div class="col-md-12">
										       <div class="form-group">
                                                 <label for="ap-content">Content</label>
                                                 <textarea class="form-control" name="content" id="ap-content"></textarea>
                                               </div>
										    </div>
										  </div>
										  
										  <div class="row mb-3">
										     <div class="col-md-12 pl-0">
                                                <p class="text-right">
                                                    <button class="btn btn-space btn-secondary" id="ubp-form-btn">Save</button>
                                                </p>
                                            </div>
										  </div>
										

                                    </form>
                                </div>
                            </div>
                        </div>
</div>	

<div class="row">
  <div class="col-md-12" style="margin-bottom: 20px;">
											<div class="form-group">
											   
												<div class="row">
												 <?php
												   $tags = [
												     ['name' => "Tag 1"],
												     ['name' => "Tag 2"],
												     ['name' => "Tag 3"],
												     ['name' => "Tag 4"],
												     ['name' => "Tag 5"],
												   ];
											        foreach($tags as $t)
													{
														$n = $t['name'];
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
</div>

<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Comments</h5>
                            <div class="card-body">
							  <?php
							    for($i = 0; $i < count($comments); $i++)
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