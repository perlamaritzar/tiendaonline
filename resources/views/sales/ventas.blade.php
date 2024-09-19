@extends('layouts.cms')

@section('title', 'Ventas')

@section('header', 'Ventas')

@section('context_button')
<button type="button" class="btn btn-success" data-bs-toggle="modal"><i class="fa-solid fa-folder-plus">


    </i>
    <a href="{{route('nuevaventa')}}" class="text-decoration-none" style="color: white;">Nueva Venta</a>
</button>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Ventas</a></li>
    </ol>
</nav>
@endsection

@section('content')

<div class="row d-flex  g-4">

    <div class="col-lg-12">



        @foreach ($sales as $item)
        <div id="accordion">

            <div class="card">
                <div class="card-header">
                    <a class="btn" data-bs-toggle="collapse" href="#collapse{{$item->id}}">
                        <b>Venta de:</b> {{$item->id}} | <b>Cliente:</b> {{ $item->customer->name }}
                    </a>
                </div>

                <div id="collapse{{$item->id}}" class="collapse " data-bs-parent="#accordion">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">

                                <table class="table table-stripped">
                                    <thead>
                                        <th>Cantidad</th>
                                        <th>Articulo</th>
                                        <th>Precio</th>
                                    </thead>
                                    <tbody>
                                        @php
                                        $totalPrice = 0;
                                        @endphp
                                        
                                        @foreach ($Details as $art)

                                        @if($art->sale_id == $item->id)
                                        <tr>
                                            <td>{{$art->amount}}</td>
                                            <td>{{$art->product->name}}</td>
                                            <td>
                                                @php

                                                $fprice = $art->amount * $art->price;
                                                $totalPrice += $fprice;

                                                @endphp
                                                {{$fprice}}
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4">
                                <p><b>Total</b></p>
                                ${{$totalPrice}}
                            </div>
                        </div>

                    </div>


                </div>
            </div>
            @endforeach


        </div>
    </div>


    @endsection


    <!--joseph-->
