@extends('layouts.app')

@section('content')

<form method="post">
      {{ csrf_field() }}
          <h4>Upravit Produkt</h4>
               <div class="form-group">
                    <label for="exampleInputEmail1">Název Produktu</label>
                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="{{ $product -> product_name}}">
               </div>
               <div class="form-group">
                    <label for="exampleInputPassword1">Cena</label>
                    <input type="integer" name="product_price" class="form-control" id="exampleInputPassword1" placeholder="" value="{{ $product -> price }}">
               </div>
               <button type="submit" class="btn btn-primary">Změnit</button>
</form>

@endsection
