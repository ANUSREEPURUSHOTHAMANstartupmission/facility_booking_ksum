@extends('layouts.page')

@section('style')
<style>
    .date-form {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-control {
        margin-right: 10px;
    }

    .btn {
        height: 38px;
    }
</style>
@endsection

@section('page')
<x-page-header heading="Export Bookings" subhead="Select a date range to export bookings"></x-page-header>
<div class="row row-deck row-cards justify-content-center align-items-start">
    <div class="col-sm-12">
        <div class="card">
            <!-- <div class="card-header">
                <h3 class="card-title">Export Bookings</h3>
            </div> -->

            <div class="card-body">
                <form action="{{ route('admin.export.store') }}" method="POST" class="date-form">
                    @csrf
                    <div class="col-sm-4">
                        <label for="start">Start Date:</label>
                        <input type="date" id="start" name="start" class="form-control" value="{{ $start }}">
                    </div>
                    <div class="col-sm-4">
                        <label for="end">End Date:</label>
                        <input type="date" id="end" name="end" class="form-control" value="{{ $end }}">
                    </div>
                    <button type="submit" class="btn btn-secondary">Export</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
