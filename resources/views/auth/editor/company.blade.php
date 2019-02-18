@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <h3>Edit company info</h3>
                                <a href="/companies" class="btn-link">BACK</a>
                                <hr>
                                <form method="POST" action="/companies/{{ $response["id"] }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Company name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $response["payload"]["name"] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"  value="{{ $response["payload"]["email"] }}">
                                    </div>
                                    <div class="form-group">
                                        <p>Existing:  {{ $response["payload"]["logo"] }}</p>
                                        <label for="logo" class="control-label">Logo</label>
                                        <input type="file" class="form-control" name="logo" id="logo">
                                    </div>
                                    <div class="form-group">
                                        <label for="website" class="control-label">Website</label>
                                        <input type="text" class="form-control" name="website" id="website" value="{{ $response["payload"]["website"] }}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-dark">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
