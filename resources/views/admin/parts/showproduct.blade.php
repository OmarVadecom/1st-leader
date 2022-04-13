@extends($pLayout. 'master')
@section('content')
@php
    $charts=explode(',',$product->charts);
@endphp
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $product->name }}
                    </h3>
                </div>
                <div class="card-header">
                    <img style="height: 300px; width: 50%; display: block; margin: auto;"
                        src="{{ url('/') }}/uploads/products-attachments/{{ $product->image }}">
                    <h2 style="text-align:center"> المخططات التفصيليه </h2>
                    <hr>

                    @if($charts[0] !== "")
                        @foreach($charts as $chart)
                            @if(count($charts) == 1)
                                <div class="col-xs-12">
                                @else
                                    <div class="col-xs-6">
                            @endif
                            <img src="{{ url('/') }}/uploads/products-charts/{{ $chart }}"
                                style="width:100%">
                </div>
                @endforeach
            @else
                <p style="text-align:center">لا توجد مخططات </p>
                @endif
                <h2 style="text-align:center"> قطع الغيار </h2>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>رقم القطعه</th>
                            <th>الصوره</th>
                            <th>السعر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->parts as $part)
                            <tr>
                                <td>{{ $part->name }}</td>
                                <td>{{ $part->code }}</td>
                                <td><img src="{{ url('/') }}/uploads/parts_images/{{ $part->image }}"
                                        style="width:100px"></td>
                                <td>{{ $part->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
    @endsection
