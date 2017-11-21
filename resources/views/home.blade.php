@extends('layouts.app')

@section('content')

<div class="message">

</div>

            <div class="panel panel-default">
                <div class="panel-heading">
                     <h1>Nabídka produktů</h1></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>

<!--Show products -->
     <div class="row m-2">
          @foreach($products as $product)
  <div class="product col-m-3 m-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $product -> product_name }}</h4>
          <h5>Cena: {{ $product -> price }} Kč</h5>
          <form class="" action="" method="post">
                {{ csrf_field() }}
               <input data-productid="{{ $product -> product_id }}"  type="hidden" name="product_id" class="product_id" value="{{ $product -> product_id }}">
               <input data-user="{{ Auth::user()['id'] }}"  type="hidden" name="user_id" class="user_id" value="{{ Auth::user()['id'] }}">
          </form>
          <button  class="buy btn btn-primary" type="button" name="button" >Koupit</button>
        <a href="/edit/{{ $product -> product_id }}" class="btn btn-primary m-2">Upravit</a>
        <button class="delete-modal btn btn-danger" data-id="{{ $product -> product_id }}" data-title="" data-content="">
                                   <span class="glyphicon glyphicon-trash"></span> Odstranit</button>

<!-- modal -->
        <div id="deleteModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h4 class="modal-title"></h4>
                  </div>

                      <h3 class="text-center">Určitě chcete tento produkt vymazat?</h3>
                      <br/>
                      <form class="form-horizontal" role="form">
                          <div class="form-group">
                              <div class="col-sm-10">
                                  <input type="hidden" class="form-control" id="id_delete" disabled>
                              </div>
                          </div>
                      </form>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                              <span id="" class='glyphicon glyphicon-trash'></span> Odstranit
                          </button>
                          <button type="button" class="btn btn-warning" data-dismiss="modal">
                              <span class='glyphicon glyphicon-remove'></span> Zavřít
                          </button>
                      </div>
              </div>
          </div>
      </div>
<!--end of modal -->

      </div>
    </div>
  </div>
  @endforeach

  </div>

<!--Add new product -->
<div class="add_product m-4">
     <h4>Přidat nový produkt</h4>
     <form method="post">
           {{ csrf_field() }}
               <div class="form-group">

                    <label for="product_name">Název produktu</label>
                    <input type="text" class="form-control" name="product_name"  placeholder="">
               </div>
               <div class="form-group">
                    <label for="price">Cena produktu</label>
                    <input type="integer" class="form-control" name="price" placeholder="">
                    <input type="hidden" value="{{ Session::token() }}" name="_token">
               </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
               </form>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

   <!-- Bootstrap JavaScript -->
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

   <!-- toastr notifications -->
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>

$(document).ready(function(){

   $('.buy').click(function(){
          console.log('click');
     var card = $(this).closest('.card-body');

        $.ajax ({
             'method': 'post',
             'url': '/buy',
             'dataType': 'json',
             'data': {
                  '_token': $('input[name=_token]').val(),
                  'id': card.find('.product_id').data('productid'),
                  'user': card.find('.user_id').data('user')
             }

        })
        .done(function(data){
             alert('Položka byla vložena do košíku');
        })
   });


var deleted_product = null;
$(document).on('click', '.delete-modal', function() {
     deleted_product = $(this).closest('.product');
          $('#id_delete').val($(this).data('id'));
          $('#deleteModal').modal('show');
          id = $('#id_delete').val();
       });

       $('.modal-footer').on('click', '.delete', function() {
            console.log('clicking');
          $.ajax({
               'type': 'post',
               'url': '/delete/' + id,
               'data': {
                   '_token': $('input[name=_token]').val(),
                   'product_id' : id
               },
               success: function(data) {
                    $(".message").empty().append(data);
                    if (deleted_product) {
                         $(deleted_product).remove();
                    }

               }
          });
       });

});

 </script>

@endsection
