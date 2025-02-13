@extends('layouts.page')

@section('style')
    <style>
        .hidden-details {
            display: none;
            transition: all 0.3s ease-in-out;
        }

        .hidden-details td {
            background-color: #fffff;
            /* padding: 10px; */
            border-top: 1px solid #ddd;
        }

        .details-table {
            /* margin-top: 10px; */
            width: 100%;
            border-collapse: collapse;
        }

        .details-table th, .details-table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .details-table th {
            background-color: #007bff;
            color: white;
        }

        .details-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-responsive {
            overflow-x: auto;
            max-height: 400px; /* Adjust height as needed */
        }

        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #888; 
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #555;
        }




        .day_head {
        flex: 0 0 auto;
        width: 14%;
        border: 1px solid rgba(101, 109, 119, 0.16);
        padding: 5px; /* Reduced padding */
        background: #ccc;
        font-weight: bold;
        font-size: 12px; /* Smaller font size */
        text-align: center;
        font-weight: bold;

    }
    .day {
        flex: 0 0 auto;
        width: 14%;
        border: 1px solid rgba(101, 109, 119, 0.16);
        padding: 0; 
        height: 50px;
        display: flex; 
        align-items: center; 
        justify-content: center; 
        overflow-y: scroll;
        text-align: center;
        font-size: 10px;
        font-weight:normal;
    }
    .bg-secondary {
        background-color: rgb(151, 154, 158) !important; 
    }
    .bg-light {
        background-color: rgb(222, 224, 226) !important; 
    }
    .bg-red {
        background-color:rgba(234, 16, 35, 0.61) !important;
    }
    .bg-azure {
        background-color: #d1ecf1 !important;
    }
    .bg-orange {
        background-color: #fff3cd !important;
    }
    .bg-green {
        background-color: #d4edda !important;
    }
    .time {
        font-size: 10px; 
        display: block;
        margin: 2px 0;    }
    .booking {
        border: 1px solid #ccc; 
        padding: 2px; 
        display: block;
        background: rgba(204, 204, 204, 0.3); 
        border-radius: 3px; 
        margin-bottom: 2px;
        font-size: 10px; 
        white-space: nowrap; 
        text-overflow: ellipsis;
    }

    </style>
@endsection

@section('page')
<x-page-header heading="Dashboard" subhead=""></x-page-header>



<div class="container">
<div class="row row-deck row-cards justify-content-center align-items-start">
<div class="row mt-5">
        <!-- <div class="col-md-12">
            <div class="card p-3 "  style="overflow-x: scroll;">
                <h3>District-Wise Summary</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>District</th>
                            <th>Locations</th>
                            <th>Facilities</th>
                            <th>Confirmed Bookings</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($districts as $district => $data)
                            <tr>
                                <td>{{ $district }}</td>
                                <td>{{ $data['total_locations'] }}</td>
                                <td>{{ $data['total_facilities'] }}</td>
                                <td>{{ $data['total_confirmed_bookings'] }}</td>
                                <td>{{ number_format($data['total_revenue'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> -->
        <!-- <div class="col-md-6 text-dark" style="background-color:rgb(255, 255, 255);border-radius: 12px;">
            <div class=" col-md-12">
                <div>
                    
                    <div class="  row col-md-12 px-3 pt-3">
                        <div class=" col-md-2  flex ">
                            <p class=" text-success" style="font-size:20px;font-weight:bold">{{ $totalBookingCount_all }}</p>
                        </div>
                        <div class=" col-md-10 item-end justify-end">
                            <strong><p>Total Request</p></strong>
                        </div>
                    </div>
                    <div class="">
                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Number of requests approved by the admin.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->approved_count }}</p>
                            </div>
                        </div>
                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Payment request completed.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->confirmed_count }}</p>
                            </div>
                        </div>
                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Requests not processed yet.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->requested_count }}</p>
                            </div>
                        </div>

                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Requests moved to pending.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->pending_count }}</p>
                            </div>
                        </div>

                      

                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Cancelled requests.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->cancelled_count }}</p>
                            </div>
                        </div>
                      
                      
                    </div>
                </div>

            
                <div class="row col-md-12">
                    <div class="col-sm-6  p-2 text-center">
                        <p style="font-size:20px;font-weight:bold">{{ $totalFacilityCount }}</p> 
                        <strong>Total Facilities</strong>
                    </div>
                    <div class="col-sm-6 p-2 text-center">
                        <p style="font-size:20px;font-weight:bold">{{ $totalStartupUsers }}</p> 
                        <strong>Users</strong>
                    </div>
               </div>
            </div>
        </div> -->
    </div>


    <!-- Date -->

    <div class="col-sm-12">
    <div class="col-md-6"></div>
    <div class="card col-md-6">
        <div class="card-header">
            <h3 class="card-title">Select Year</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.dashboard.index') }}" class="mb-3">
                @csrf
                <div class="row">
                    <div class="col-md-12 row">
                        <div class="col-md-9">
                            <input type="text" class="form-control yearpicker" name="year" id="year" value="{{ $year }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- <div class="col-sm-12">
        <div class=" col-md-6"></div>
        <div class="card col-md-6">
            <div class="card-header">
                <h3 class="card-title">Select Year</h3>
            </div>

            <div class="card-body">
                <form method="GET" action="{{ route('admin.dashboard.index') }}" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 row">
                            <div class="col-md-9">
                                <select class="form-control" name="year" id="year">
                                    @for ($y = date('Y'); $y >= 2000; $y--)
                                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <!-- <div class=" col-md-12 row">
        <div class=" col-md-6"></div>
        <div class="col-md-6">
            <form method="GET" action="{{ route('admin.dashboard.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-12 row">
                        <div class="col-md-6">
                            <select class="form-control" name="year" id="year">
                                @for ($y = date('Y'); $y >= 2000; $y--)
                                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div> -->
    <!-- Overview Summary -->
   <div class="mt-5 row  col-sm-12 mb-5 mx-auto gap-2 ">
        <div class="col-sm-2 text-light p-2 py-4 text-center">
           
        </div>
        <div class="col-sm-2  text-light p-2 py-4 text-center" style="background-color:rgb(25, 148, 9)">
            <p style="font-size:20px;font-weight:bold">{{ $totalBookingCount }}</p> 
            <strong>Payment Completed Bookings</strong>
        </div>
        <div class="col-sm-2  text-light p-2 py-4 text-center" style="background-color:rgb(4, 84, 17)">
            <p style="font-size:20px;font-weight:bold">{{ number_format($totalRevenue, 2) }}</p> 
            <strong>Total Revenue</strong>
        </div>
        <div class="col-sm-2  text-light p-2 py-4 text-center" style="background-color:rgb(241, 132, 59)">
            <p style="font-size:20px;font-weight:bold">{{ $totalBookingCount_pending }}</p> 
            <strong>Payment Pending Bookings</strong>
        </div>
        <div class="col-sm-2 text-light p-2 py-4 text-center" style="background-color:rgb(236, 107, 67)">
            <p style="font-size:20px;font-weight:bold">{{ number_format($totalPending, 2) }}</p> 
            <strong>Total Pending</strong>
        </div>
        <!-- <div class="col-sm-2 text-light p-2 py-4 text-center" style="background-color:rgb(21, 116, 104)">
            <p style="font-size:20px;font-weight:bold">{{ $totalBookingCount_all }}</p> 
            <strong>Total Request</strong>
        </div> -->
    
        <!-- <div class="col-sm-2 bg-primary text-light p-2 py-4 text-center">
            <p style="font-size:20px;font-weight:bold">{{ $totalFacilityCount }}</p> 
            <strong>Total Facilities</strong>
        </div>
        <div class="col-sm-2 text-light p-2 py-4 text-center" style="background-color:rgb(97, 137, 8)">
            <p style="font-size:20px;font-weight:bold">{{ $totalStartupUsers }}</p> 
            <strong>Users</strong>
        </div> -->
      
   </div>



   <!-- Booking Details Grouped by Facility -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3"  style="overflow-x: scroll;">
                <h3>Booking Details</h3>
                <div class=""> <!-- Added responsive wrapper -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>District</th>
                                <th>Location</th>
                                <th>Facility</th>
                                <th>Paid Amount</th>
                                <th>Pending Amount</th>
                                <th>Total Bookings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookingsGrouped as $facilityName => $bookings)
                                <tr>
                                    <td>{{ $bookings->first()['district'] }}</td>
                                    <td>{{ $bookings->first()['location_name'] }}</td>
                                    <td>{{ $facilityName }}</td>
                                    <td>{{ number_format($bookings->sum('paid'), 2) }}</td>
                                    <td>{{ number_format($bookings->sum('pending'), 2) }}</td>
                                    <td>{{ $bookings->filter(fn($b) => isset($b['status']) && in_array($b['status'], ['approved', 'confirmed']))->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- End table-responsive -->
            </div>
        </div>
    </div>





  
   

    <div class="row my-5">
        <div class="col-md-12">
            <div class="card p-3"  style="overflow-x: scroll;">
                <h3>Pending Payments by User</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Total Pending Amount</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingBookingsByUser as $user)
                            <tr>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ number_format($user['total_pending'], 2) }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="toggleDetails('{{ $user['user_id'] }}')">View Details</button>
                                </td>
                            </tr>
                            <tr id="details-{{ $user['user_id'] }}" class="hidden-details">
                                <td colspan="4">
                                    <table class=" table-sm details-table mt-2  m-0" style="padding:0px">
                                        <thead>
                                            <tr>
                                                <th>Location</th>
                                                <th>Facility</th>
                                                <th>Start Date</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user['details'] as $detail)
                                                <tr>
                                                    <td>{{ $detail['location'] }}</td>
                                                    <td>{{ $detail['facility'] }}</td>
                                                    <td>{{ $detail['start_date'] }}</td>
                                                    <td>{{ number_format($detail['amount'], 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

  <!-- District-Wise Summary -->
  <div class="row mt-5">
        <!-- <div class="col-md-12">
            <div class="card p-3 "  style="overflow-x: scroll;">
                <h3>District-Wise Summary</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>District</th>
                            <th>Locations</th>
                            <th>Facilities</th>
                            <th>Confirmed Bookings</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($districts as $district => $data)
                            <tr>
                                <td>{{ $district }}</td>
                                <td>{{ $data['total_locations'] }}</td>
                                <td>{{ $data['total_facilities'] }}</td>
                                <td>{{ $data['total_confirmed_bookings'] }}</td>
                                <td>{{ number_format($data['total_revenue'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> -->
        <!-- <div class="col-md-6 text-dark" style="background-color:rgb(255, 255, 255);border-radius: 12px;">
            <div class=" col-md-12">
                <div>
                    
                    <div class="  row col-md-12 px-3 pt-3">
                        <div class=" col-md-2  flex ">
                            <p class=" text-success" style="font-size:20px;font-weight:bold">{{ $totalBookingCount_all }}</p>
                        </div>
                        <div class=" col-md-10 item-end justify-end">
                            <strong><p>Total Request</p></strong>
                        </div>
                    </div>
                    <div class="">
                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Number of requests approved by the admin.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->approved_count }}</p>
                            </div>
                        </div>
                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Payment request completed.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->confirmed_count }}</p>
                            </div>
                        </div>
                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Requests not processed yet.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->requested_count }}</p>
                            </div>
                        </div>

                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Requests moved to pending.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->pending_count }}</p>
                            </div>
                        </div>

                      

                        <div class="  row col-md-12">
                            <div class=" col-md-10">
                                <p>Cancelled requests.</p>
                            </div>
                            <div class=" col-md-2">
                                <p style="font-size:20px;font-weight:bold">{{ $bookingStatusCount->cancelled_count }}</p>
                            </div>
                        </div>
                      
                      
                    </div>
                </div>

            
                <div class="row col-md-12">
                    <div class="col-sm-6  p-2 text-center">
                        <p style="font-size:20px;font-weight:bold">{{ $totalFacilityCount }}</p> 
                        <strong>Total Facilities</strong>
                    </div>
                    <div class="col-sm-6 p-2 text-center">
                        <p style="font-size:20px;font-weight:bold">{{ $totalStartupUsers }}</p> 
                        <strong>Users</strong>
                    </div>
               </div>
            </div>
        </div> -->
    </div>

    <div class="col-md-12">
        <div class="card p-3 "  style="overflow-x: scroll;">
            <h3>District-Wise Summary</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>District</th>
                        <th>Locations</th>
                        <th>Facilities</th>
                        <th>Confirmed Bookings</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($districts as $district => $data)
                        <tr>
                            <td>{{ $district }}</td>
                            <td>{{ $data['total_locations'] }}</td>
                            <td>{{ $data['total_facilities'] }}</td>
                            <td>{{ $data['total_confirmed_bookings'] }}</td>
                            <td>{{ number_format($data['total_revenue'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    


</div>
<script>
    function toggleDetails(userId) {
        var allDetails = document.querySelectorAll('.hidden-details');
        allDetails.forEach(function(detailRow) {
            if (detailRow.id !== 'details-' + userId) {
                detailRow.style.display = "none";
            }
        });

        var detailsRow = document.getElementById('details-' + userId);
        if (detailsRow.style.display === "none" || detailsRow.style.display === "") {
            detailsRow.style.display = "table-row"; 
        } else {
            detailsRow.style.display = "none";
        }
    }
</script>


<script>
    $(document).ready(function () {
        $('.yearpicker').datepicker({
            format: "yyyy", // Only year
            viewMode: "years", // Show only years
            minViewMode: "years", // Disable months and days selection
            autoclose: true
        });
    });
</script>


@endsection
