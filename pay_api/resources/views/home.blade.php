@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header upper-link"><i class="fas fa-home"></i> Dashboard</div>

                <div class="card-body">
                    <h5><b><i class="far fa-money-bill-alt"></i> My Payments</b></h5>
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Plan</th>
                          <th scope="col">Price</th>
                          <th scope="col">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($payments as $p)
                            <tr>
                              <th scope="row">{{$p['id']}}</th>
                              <td>{{$p['plan']}}</td>
                              <td>{{$p['price']}}</td>
                              <td>{{date('Y/m/d H:i:s', strtotime($p['date']))}}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted text-center">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
