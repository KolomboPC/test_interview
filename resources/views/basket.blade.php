@extends('layouts.app')

@section('content')

<div class="card text-center">
          <div class="card-header">
               Zboží v košíku
          </div>
          <div class="m-3">
          <a href="/home" class="btn btn-success">Pokračovat v nákupu</a>
          </div>
     <div class="card-body">


          @foreach($products as $product)

          <div class="order_view">
               <h4 class="card-title">{{ $product -> product_name }}</h4>
               <p class="card-text">{{ $product -> price}} kč</p>


          <!-- Button trigger modal -->
<button type="button" class=" delete btn btn-danger m-2" data-toggle="modal" data-target="#exampleModal-{{ $product->product_id }}" data_id ="{!! $product -> product_id !!}">
 Odstranit
</button>

</div>


<!-- Modal -->
<div class="exampleModal modal fade" id="exampleModal-{{ $product->product_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <form class="" action="/kos/{{ $product->product_id }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Opravdu chcete polozku {{ $product -> product_name }} odstranit?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
          <div class="modal-body">
                    <input type="hidden" name="edit_email" value="{{ $product -> product_id }}">
          </div>

               <button  style="margin:10px" type="submit" class="btn btn-primary ">Smazat</button>
               <br>

          </form>
    </div>
 </div>
</div>
<!--end of modal -->

@endforeach

          <h4>Celková cena = {{ $total_price }} kč</h4>
          <a id="order" class="btn btn-primary">Objednat</a>
     </div>
</div>

<div class="order_form" style="display:none">
<form method="POST">
      {{ csrf_field() }}
  <div class="form-row">


  </div>
  <div class="form-group">
    <label for="inputAddress">Jméno Firmy</label>
    <input type="text" class="form-control" id="inputAddress"  name="company_name" >
  </div>
  <div class="form-group">
    <label for="inputAddress2">Ulice</label>
    <input type="text" class="form-control" id="inputAddress2"  name="street_address">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Město</label>
      <input type="text" class="form-control" id="inputCity" name="city_address">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">PSČ</label>
      <input type="text" class="form-control" id="inputZip" name="postcode_address">
    </div>
  </div>
     <input type="hidden" name="status" value="objednávka přijata">
     <input type="hidden" name="total_price" value="{{ $total_price }} ">
  <button type="submit" class="btn btn-primary">Objednat</button>
</form>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

   <!-- Bootstrap JavaScript -->
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

   <!-- toastr notifications -->
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>

$(document).ready(function(){
$('#order').click(function(){
     $(".order_form").show();
})
});
</script>

@endsection
