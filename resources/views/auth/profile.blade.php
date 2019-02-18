@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <a href="/companies" class="btn btn-block btn-success text-light">Companies</a>
                            </div>
                            <div class="col-6">
                                <a href="/employee" class="btn btn-block btn-success text-light">Employees</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
