@extends('layouts.main') 
@section('title', 'Edit Department')
@section('content')

<div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit Department')}}</h5>
                            <span>{{ __('Edit Department')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('emm-dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="add-depatment">{{ __('Edit Department')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/department/update">   
                            @csrf   
                            <input type="hidden" name="id" value="{{$department->id}}">                     
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                        <label for="dname">{{ __('Department Name')}}<span class="text-red">*</span></label>
                                        <input id="dname" type="text" class="form-control @error('name') is-invalid @enderror" name="dname" value="{{ clean($department->dname, 'titles')}}" readonly>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                <div class="form-group">
                                        <label for="demail">{{ __('Department Email')}}<span class="text-red">*</span></label>
                                        <input id="demail" type="email" class="form-control @error('name') is-invalid @enderror" name="demail" value="{{ clean($department->demail, 'titles')}}" >
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                <div class="form-group">
                                        <label for="ddesc">{{ __('Department Desription')}}<span class="text-red">*</span></label>
                                        <input id="ddesc" type="text" class="form-control @error('name') is-invalid @enderror" name="ddesc" value="{{ clean($department->demail, 'titles')}}" >
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Advanced Features</label>                                        
                                        @foreach($policyFeatures as $feature)
                                        <div class="border-checkbox-group border-checkbox-group-success d-block">
                                            <input
                                            class="border-checkbox"
                                            type="checkbox"
                                            name="policy_features[]"
                                            id="checkbox{{ $feature->id }}"
                                            value="{{ $feature->id }}"
                                            {{ $department->policyFeatures->contains($feature->id) ? 'checked' : '' }}
                                            >
                                            <label class="border-checkbox-label" for="checkbox{{ $feature->id }}">{{ $feature->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
