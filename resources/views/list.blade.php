<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ToDO-Ajax</title>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"/>
</head>
<body>
<br>
<div class="container">
	<div class="row">
		<div class="col-lg-offset-3 col-lg-6">			
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Panel title <a href="#" class="pull-right" id="addNew" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a></h3>
			  </div>

			  <div class="panel-body" id="items">
			   <ul class="list-group">
			   @foreach($items as $item)
			   <li class="list-group-item ourItem"data-toggle="modal" data-target="#myModal">{{$item->item}}
			   <input type="hidden" id="itemId" value="{{$item->id}}"></li>
				@endforeach
			   </ul>
			   </div>
			   </div>
			   </div>
			   <div class="col-lg-2">
			<input type="text" class="form-control" name="searchItem" id="searchItem" placeholder="Search Here...">
		</div>
			  
		
			  <!-- Modal -->
			  <div id="myModal" class="modal fade" role="dialog">
			    <div class="modal-dialog">

			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title" id="title" >Add New Item</h4>
			        </div>
			        <div class="modal-body">
			        <input type="hidden" id="id">
			          <p><input type="text" placeholder="Add Item" id="addItem" class="form-control"></p>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-danger" id="delete" data-dismiss="modal" style="display: none">Delete</button>
                       <button type="button" class="btn btn-primary" id="save" data-dismiss="modal" style="display: none">Save changes</button>
                       <button type="button" class="btn btn-primary" id="addButton" data-dismiss="modal">Add</button>
				        </div>
				    </div>

				    </div>
				  </div>
				</div>
			  
		</div>
{{ csrf_field() }}
	<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	
<script>
	$(document).ready(function() {
		$(document).on ('click','.ourItem', function(event) {
				var text =$(this).text();
				var id =$(this).find('#itemId').val();
				$('#title').text('Edit Item');
				var text=$.trim(text);
				$('#addItem').val(text);
				$('#delete').show('400');
				$('#save').show('400');
				$('#addButton').hide('300');
				$('#id').val(id);
				console.log(text);
		});
	$(document).on ('click','#addNew', function(event) {
				$('#title').text('Add New Item');
				$('#addItem').val("");
				$('#delete').hide('400');
				$('#save').hide('400');
				$('#addButton').show('400');
				
			});
		$('#addButton').click(function(event) {
			var text=$('#addItem').val();
			$.post('list', {'text': text,'_token':$('input[name=_token]').val()}, function(data) {
				console.log(data);
				$('#items').load(location.href +' #items');
			});	
		});
		$('#delete').click(function(event) {
			var id =$("#id").val();
			$.post('delete', {'id': id,'_token':$('input[name=_token]').val()}, function(data) {
				$('#items').load(location.href +' #items');
			console.log(id);
				
			});
		});	
		$('#save').click(function(event) {
			var id =$("#id").val();
			var value =$("#addItem").val();
			$.post('update', {'id': id,'value': value,'_token':$('input[name=_token]').val()}, function(data) {
				$('#items').load(location.href +' #items');
			console.log(data);
				
			});
		});
  $(function() {
    // var availableTags = [
    //   "PHP",
    //   "Python",
    //   "Ruby",
    //   "Scala",
    //   "Scheme"
    // ];
    $( "#searchItem" ).autocomplete({
      source: 'http://127.0.0.1:8000/search'
    });
  });
  });

</script>

</body>
</html>