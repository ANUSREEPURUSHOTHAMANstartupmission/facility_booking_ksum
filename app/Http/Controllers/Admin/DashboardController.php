<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DashboardController extends Controller
{
   public function __construct()
   {
       $this->middleware('role');
   }
   public function index(Request $request)
   {
       // District-wise summary
       $year = $request->input('year', Carbon::now()->year);

       $districts = Location::withCount('facilities')
       ->with(['facilities' => function ($query) use ($year) {
           $query->withCount(['bookings' => function ($q) use ($year) {
               $q->where('status', 'confirmed')->whereYear('start', $year);
           }]);
       }])
       ->get()
       ->groupBy('district')
       ->map(function ($locations, $district) use ($year) {
           $totalLocations = $locations->count();
           $totalFacilities = $locations->sum('facilities_count');

           $totalRevenue = $locations->flatMap(function ($location) use ($year) {
               return Booking::where('location_id', $location->id)
                   ->where('status', 'confirmed')
                   ->whereYear('start', $year)
                   ->get();
           })->sum('paid');

           $totalConfirmedBookings = $locations->flatMap(function ($location) {
               return $location->facilities;
           })->sum('bookings_count');

           return [
               'total_locations' => $totalLocations,
               'total_facilities' => $totalFacilities,
               'total_confirmed_bookings' => $totalConfirmedBookings,
               'total_revenue' => $totalRevenue,
           ];
       });


       // Group bookings by facility
       // $bookingsGrouped = Booking::where('status', 'confirmed')
       //     ->with(['facilities.location'])
       //     ->get()
       //     ->flatMap(function ($booking) {
       //         return $booking->facilities->map(function ($facility) use ($booking) {
       //             return [
       //                 'facility_name' => $facility->name,
       //                 'location_name' => $facility->location->name,
       //                 'district' => $facility->location->district,
       //                 'total' => $booking->total,
       //                 'booking_id' => $booking->id,
       //             ];
       //         });
       //     })
       //     ->groupBy('facility_name');


       $bookingsGrouped = Booking::whereIn('status', ['approved', 'confirmed']) // Fetch both statuses
       ->with(['facilities.location'])
       ->whereYear('start', $year)

       ->get()
       ->flatMap(function ($booking) {
           return $booking->facilities->map(function ($facility) use ($booking) {
               return [
                   'facility_name' => $facility->name,
                   'location_name' => $facility->location->name,
                   'district' => $facility->location->district,
                   'total' => $booking->total,
                   'pending' => ($booking->status == 'approved') ? $booking->balance : 0,
                   'paid' => ($booking->status == 'confirmed') ? $booking->paid : 0,
                   'status' => $booking->status, // ✅ Include status here
               ];
           });
       })
       ->groupBy('facility_name');
  






       // Pending bookings grouped by user
       $pendingBookingsByUser = Booking::where('status', 'approved')
           ->whereYear('start', $year)
           ->with(['user', 'location', 'facilities'])
           ->get()
           ->groupBy('user_id')
           ->map(function ($bookings, $userId) {
               $user = $bookings->first()->user;
               return [
                   'user_id' => $userId,
                   'name' => $user->name,
                   'email' => $user->email,
                   'total_pending' => $bookings->sum('balance'),
                   'details' => $bookings->map(function ($booking) {
                       return [
                           'location' => $booking->location->name ?? 'N/A',
                           'facility' => $booking->facilities->pluck('name')->join(', '),
                           'start_date' => $booking->start,
                           'amount' => $booking->balance,
                       ];
                   }),
               ];
           });



       // Total counts
       // $totalRevenue = $bookingsGrouped->flatMap(function ($group) {
       //     return $group;
       // })->sum('total');


       $total_Revenue_query = Booking::where('status', 'confirmed')->whereYear('start', $year)
       ->get();


       $totalRevenue = $total_Revenue_query->sum('paid');




       $totalPending = $pendingBookingsByUser->sum('total_pending');

       $totalBookingCount = Booking::whereIn('status', ['confirmed'])->whereYear('start', $year)->count();

       $totalBookingCount_pending = Booking::whereIn('status', ['approved'])->whereYear('start', $year)->count();


       $totalBookingCount_all = Booking::count();
       
       $totalFacilityCount = Facility::count();


       // Count of users with role "startup"
       $startupRole = Role::where('name', 'startup')->first();
       $totalStartupUsers = User::where('role_id', $startupRole->id ?? null)->count();

       $discountcount = Booking::whereIn('status', ['approved', 'confirmed','requested'])
            ->whereYear('start', $year)
            ->where(function ($query) {
                $query->where('discount', '>', 0)
                    ->orWhereNull('discount');
            })
            ->get()->count();





       $bookingStatusCount = Booking::selectRaw('
       SUM(CASE WHEN status = "approved" THEN 1 ELSE 0 END) as approved_count,
       SUM(CASE WHEN status = "requested" THEN 1 ELSE 0 END) as requested_count,
       SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending_count,
       SUM(CASE WHEN status = "confirmed" THEN 1 ELSE 0 END) as confirmed_count,
       SUM(CASE WHEN status = "cancelled" THEN 1 ELSE 0 END) as cancelled_count,
       SUM(CASE WHEN status = "rejected" THEN 1 ELSE 0 END) as rejected_count
   ')->first();


       return view('admin.dashboard', compact(
           'districts',
           'bookingsGrouped',
           'pendingBookingsByUser',
           'totalRevenue',
           'totalPending',
           'totalBookingCount',
           'totalBookingCount_all',
           'totalFacilityCount',
           'totalStartupUsers',
           'bookingStatusCount',
           'year',
           'totalBookingCount_pending',
           'discountcount'
       ));
   }
}



