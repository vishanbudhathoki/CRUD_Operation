<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Product</a>
    </div>
    <ul class="nav navbar-nav">
      <!-- <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li> -->
    </ul>
  </div>
</nav>
  
<div class="container">
  

    <!-- <h1>Product</h1> -->
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{route('product.create')}}" class="btn btn-primary  pt-10 pb-12 mt-10 mb-12" >Create a Product</a>
        </div>
        <form method="post" action="{{ route('product.deleteSelected') }}">
            @csrf

            <table border ="1" class="table table-hover table-responsive">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <!-- <th>Select</th> -->
                    <td colspan="7"><input type="checkbox" id="selectAll"> <label for="selectAll">Select All</label></td>
                </tr> 
                <!-- <tr>
                    <td colspan="7"><input type="checkbox" id="selectAll"> <label for="selectAll">Select All</label></td>
                </tr> -->
                @foreach($products as $product)
                    <tr>
                        
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->qty}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->description}}</td>
                        
                    
                        <td>
                            <a href="{{route('product.edit',['product'=>$product])}} " class="btn btn-primary">Edit</a>
                        </td>           
                        <td>
                            <form method="post" action="{{ route('product.destroy', ['id' => $product->id]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Delete" />
                            </form>    
                        </td>
                        <td>
                            <input type="checkbox" name="selectedProducts[]" value="{{ $product->id }}">
                        </td>    
                    </tr>
                        
                @endforeach
            </table> 
            <input type="hidden" name="selectedProductsHidden" value="">
            <button type="submit" class="btn btn-danger">Delete Selected Products</button>
        </form>              
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.querySelector('#selectAll');
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selectedProducts[]"]');
            
            // Add event listener to select all checkbox
            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            // Add event listener to form submission to update hidden field
            document.querySelector('form').addEventListener('submit', function(event) {
                const selectedCheckboxes = document.querySelectorAll('input[type="checkbox"][name="selectedProducts[]"]:checked');
                const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);
                document.querySelector('input[name="selectedProductsHidden"]').value = JSON.stringify(selectedIds);
            });
        });
    </script>
 </div>   
</body>
</html>