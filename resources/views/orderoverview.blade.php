@extends('layouts.app')

@section('content')

     <div class="adress">
          <p><strong>Název firmy: </strong>{{ $order -> Company_name }}</p>
          <p><strong>Ulice: </strong>{{ $order -> address_street}}</p>
          <p><strong>Město: </strong> {{ $order -> address_city}}</p>
          <p><strong>PSČ: </strong>{{ $order -> address_postcode}}</p>
          <p><strong>Status objednávky: </strong> {{ $order -> status}}</p>
     </div>

<div class="products">
     @foreach($reviews as $review)
          <div class="">
               <p><strong>{{ $review -> product_name }} </strong>  Cena:  {{ $review -> price }} Kč</p>
          </div>
     @endforeach
     <p><strong>Cena celkem: </strong> {{ $order -> total_price }} Kč</p>
</div>

@endsection
