@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>

</head>
<body>
    <div class="container">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-xs-6">
							<h2>Manage <b>Issues</b></h2>
						</div>
						<div class="col-xs-6">
							<a href="#addIssueModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Create A New Issue</span></a>
							</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Issue's Id</th>
							<th>Title</th>
							<th>Status</th>
							<th>Name</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($issues as $issue)		
						<tr>
							<td>{{ $issue->id }}</td>
							<td>{{ $issue->title }}</td>
							<td>{{ $issue->status }}</td>
							<td>{{ $issue->name }}</td>
							<td>
								<a href="#editIssueModal{{$issue->id}}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
								<a href="#deleteIssueModal{{$issue->id}}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
								<a href="#showIssueModal{{$issue->id}}" class="show" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xe8ff;</i></a>
							</td>
						</tr> 
						@endforeach
					</tbody>
				</table>

			</div>
		</div>        
    </div>

	<!-- Add Modal -->
	<div id="addIssueModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="addIssue" method="POST">
					@csrf
					<div class="modal-header">						
						<h4 class="modal-title">Create a new issue</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" name="title" required>
						</div>

						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" required></textarea>
						</div>
				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Create">
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Edit Modal -->
	@foreach ($issues as $issue)	
	<div id="editIssueModal{{$issue->id}}" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="edit/{{$issue->id}}" method="POST">
					@csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Issue : {{$issue->title}}</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" name="title" value ='{{ $issue->title }}' required>
						</div>

						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" required> {{ $issue->description }} </textarea>
						</div>	
						
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" id="stats" name="status">
								<option value="Submitted" @if ($issue->status=='Submitted') selected @endif>Submitted</option>
								@if ($role == 'admin')
								<option value="In progress" @if ($issue->status=='In progress') selected @endif>In progress</option>
								<option value="Resolved" @if ($issue->status=='Resolved') selected @endif>Resolved</option>									
								@endif
								<option value="Closed" @if ($issue->status=='Closed') selected @endif>Closed</option>
							  </select>
						</div>	
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	@endforeach

	<!-- Delete Modal -->
	@foreach ($issues as $issue)	
		<div id="deleteIssueModal{{$issue->id}}" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="delete/{{$issue->id}}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-header">						
							<h4 class="modal-title">Delete the Issue : {{$issue->title}}</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">					
							<p>Are you sure you want to delete this issue?</p>
							<p class="text-warning">This action cannot be undone.</p>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-danger" value="Delete">
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach

	<!-- Show Modal -->	
	@foreach ($issues as $issue)	
		<div id="showIssueModal{{$issue->id}}" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">						
							<h3 class="modal-title">{{$issue->title}}</h3>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">	

							<table class="table table-striped table-hover">
								<tr>
									<td style="color:#2196F3;"><strong> Description:</strong></td>
									<td>{{$issue->description}}</td>
								
								</tr>
								
								<tr>
									<td style="color:#2196F3;"><strong> Status:</strong></td>
									<td>{{$issue->status}}</td>
								</tr>
	
								<tr>
									<td style="color:#2196F3;"><strong> Creator:</strong></td>
									<td>{{$issue->name}}</td>
								</tr>
							</table>

						</div>
				</div>
			</div>
		</div>
	@endforeach

</body>
</html>

@endsection
