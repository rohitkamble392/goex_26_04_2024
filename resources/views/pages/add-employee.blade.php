@extends('layouts.main') 
@section('title', 'Add Employee')
@section('content')

<div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-secondary"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add Employee')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('superadmin-dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header"><h3>{{ __('Add Employee')}}</h3></div> --}}
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('create-employee') }}" >
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="name">{{ __('Name')}}<span class="text-red">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Employee Name">
                                </div>
                                <div class="col-sm-4">
                                    <label for="mobileNo">{{ __('Mobile Number')}}<span class="text-red">*</span></label>
                                    <input type="number" name="mobileNo" class="form-control" placeholder="Employee Mobile">
                                </div>
                                <div class="col-sm-4">
                                    <label for="email">{{ __('Email ID')}}<span class="text-red">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Employee Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="password">{{ __('Password')}}<span class="text-red">*</span></label>
                                    {{-- <input type="password" name="password" class="form-control" placeholder="Enter Password"> --}}
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="address">{{ __('Address')}}<span class="text-red">*</span></label>
                                    <textarea type="text" name="address" class="form-control" placeholder="Enter Address"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <label for="aadhar_number">{{ __('PIN Code')}}<span class="text-red">*</span></label>
                                    <input type="number" name="aadhar_number" class="form-control" placeholder="Enter PIN Code">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="aadhar_number">{{ __('State')}}<span class="text-red">*</span></label>
                                    <input type="number" name="aadhar_number" class="form-control" placeholder="Enter State">
                                </div>
                                <div class="col-sm-4">
                                    <label for="aadhar_number">{{ __('District')}}<span class="text-red">*</span></label>
                                    <input type="text" name="aadhar_number" class="form-control" placeholder="Enter District">
                                </div>
                            </div> 
                            <div class="card-header"><button type="submit" class="btn btn-secondary">{{ __('Submit')}}</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid">
@endsection
