@extends('layouts.public.main')
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>

@section('style')
    <link rel="stylesheet" href="{{asset('/css/home.css')}}">
    <style>
    .card {
      border: none;
      transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
      position: relative;
      overflow: hidden;
    }

    .card-img-top img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: transform 0.3s ease-in-out;
    }

    .card-img-top:hover img {
      transform: scale(1.1);
    }

    .price-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      background-color: #007bff;
      color: white;
      padding: 5px 10px;
      font-size: 0.9rem;
      border-radius: 5px;
    }

    .view-more {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: rgba(255, 255, 255, 0.8);
      color: #007bff;
      font-size: 0.9rem;
      text-decoration: none;
      padding: 5px 10px;
      border-radius: 5px;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }

    .card-img-top:hover .view-more {
      opacity: 1;
    }

    .rating-stars {
      color: gold;
    }

    .details-row {
      font-size: 0.9rem;
      color: gray;
    }

    .details-row span {
      margin-right: 15px;
    }
  </style>
@endsection

@section('content')
    
<section class="page-header" style="background-image: url({{asset('/img/bg-meeting.jpg')}});">
    <div class="content">
        <div class="container">
            <h1>Find Meeting and Event Spaces</h1>
            {{-- <form class="main-search" method="route('welcome')">
                <input type="text" name="query" id="country" class="autocomplete" required placeholder="Enter District" value="{{app('request')->input('query')}}">
                <button type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</section>

<div class="section-content facilities-content">
    <div class="container">
        <h2 class="text-center mb-5">Book A Facility</h2>
        <div class="row justify-content-center">
            @foreach ($facilities as $district => $items)
                <h2 class="text-center">{{$district}}</h2>

                <div class="row justify-content-center mb-5">
                    @foreach ($items as $facility)
                        <div class="col-sm-4">
                            <a href="{{ route('facility.view', [$facility]) }}" class="facility rounded-md" style="background-image: url({{ route('storage.file', ['images', count($facility->images)?$facility->images[0]->image:'']) }})">
                                <div class="badge">{{$facility->location->district}}</div>
                                <div>
                                    <div class="title">{{$facility->name}}</div>
                                    <div class="subtitle">{{$facility->location->name}}</div>
                                </div>
                            </a>
                        </div>

                       
                    @endforeach
                </div>

            @endforeach
        </div>
    </div>
</div>

@if($visits->count())
    <div class="section-content">
        <div class="container">
            <h1 class="text-center mb-5">Book A Visit</h1>

            <div class="row justify-content-center">

                @foreach ($visits as $visit)

                    @php
                        $first = $visit->facilities()->where('type', 'visit')->first();
                    @endphp

                    <div class="col-sm-4">
                        <a href="{{ route('visit.view', [$visit]) }}" class="facility" style="background-image: url({{ route('storage.file', ['images', count($first->images)?$first->images[0]->image:'']) }})">
                            <div class="badge">{{$visit->district}}</div>
                            <div>
                                <div class="title">{{$visit->name}}</div>
                            </div>
                        </a>
                    </div>    
                @endforeach
                
            </div>

        </div>
    </div>
@endif
    
@endsection

@section('script')
<script>
    var list = {!! $locations !!};
    window.autocomplete(document.getElementById("country"), list);
</script>
@endsection
