@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header upper-link"><i class="fas fa-shopping-cart"></i> {{ __('Register: Payment Data') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Data') }}</label>
                        <div class="col-md-6">
                            <div class="alert alert-info" role="alert">
                                <p>Name: <b>{{ $user["name"] }}</b></p>
                                <p>Email: <b>{{ $user["email"] }}</b></p>
                                <p>CPF: <b>{{ $user["cpf"] }}</b></p>
                                <p>CEP: <b>{{ $user["cep"] }}</b></p>
                                <p>Address: <b>{{ $user["address"] }}</b></p>
                                <p>Phones: <b>{{ $user["phones"] }}</b></p>
                                <hr>
                                <small class="form-text text-muted">
                                    Note: check the entered user data.
                                </small>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="/register/" id="form_checkout">
                        @csrf
                        <input type="hidden" id="name" name="name" value="{{ $user["name"] }}" >
                        <input type="hidden" id="email" name="email" value="{{ $user["email"] }}" >
                        <input type="hidden" id="password" name="password" value="{{ $user["password"] }}" >
                        <input type="hidden" id="cpf" name="cpf" value="{{ $user["cpf"] }}" >
                        <input type="hidden" id="cep" name="cep" value="{{ $user["cep"] }}" >
                        <input type="hidden" id="address" name="address" value="{{ $user["address"] }}" >
                        <input type="hidden" id="phones" name="phones" value="{{ $user["phones"] }}" >
                        <input type="hidden" id="price" name="price" value="0">

                        <div class="form-group row">
                            <label for="plan_id" class="col-md-4 col-form-label text-md-right">{{ __('Plan') }}</label>

                            <div class="col-md-6">
                                <select name="plan_id" id="plan_id" class="form-control" required>
                                    <option value="">Select plan...</option>
                                    @foreach ($plans as $p)
                                        <option value="{{ $p->id }}">{{ $p->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="plan_desc" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                <div id="plan_desc" class="alert alert-secondary" style="display: none;">

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name on card') }}</label>

                            <div class="col-md-6">
                                <input id="name_card" type="text" class="form-control text-uppercase text-center" name="name_card" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number_card" class="col-md-4 col-form-label text-md-right">{{ __('Number on card') }}</label>

                            <div class="col-md-4">
                                <input id="number_card" type="text" class="form-control card_number text-center" name="number_card" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiration" class="col-md-4 col-form-label text-md-right">{{ __('Expiration') }}</label>

                            <div class="col-md-2">
                                <input id="expiration" type="text" class="form-control expiration text-center" name="expiration" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ccv" class="col-md-4 col-form-label text-md-right">{{ __('CCV') }}</label>

                            <div class="col-md-2">
                                <input id="ccv" type="text" class="form-control ccv text-center" name="ccv" value="" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-secondary col-4" href="/register/">
                                    {{ __('Back') }}
                                </a>
                                <button type="submit" class="btn btn-primary float-right col-4">
                                    {{ __('Checkout') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function($){
        $('.card_number').mask('0000 0000 0000 0000', {reverse: true, clearIfNotMatch: true});
        $('.expiration').mask('00/00', {clearIfNotMatch: true});
        $('.ccv').mask('000', {clearIfNotMatch: true});
    });
    $(document).ready(function(){
        $('#plan_id').change(function() {
            console.log($('#plan_id').val());
            $.getJSON('/plan/'+$('#plan_id').val(), function (data) {
                var plan_desc = '';
                plan_desc += '<h5><b>'+data["title"]+'</b></h5>';
                plan_desc += data["description"]+'<br>';
                plan_desc += 'Period: <b>'+data["period"]+'</b><br>';
                plan_desc += 'Price: <b>'+data["price"]+'</b><br>';
                $('#plan_desc').html(plan_desc).show();
                $('#price').val(data["price"]);
            });
        });
        $('#form_checkout').submit(function(event) {
            event.preventDefault();
            $.post('/checkout_validation/', $( "#form_checkout" ).serialize(), function (data) {
                showAnimationProcessing(function() {
                    console.log(data);
                    if(data.length > 0) {
                        $('#mdErrorBody').html(data[0]);
                        $('#mdError').modal('show');
                    } else {
                        $("#form_checkout").unbind();
                        $("#form_checkout").submit();
                    }
                });
            });
        });
    });

    function showAnimationProcessing(handler_function) {
        $("#prgProcessing").css('width', '10%');
        $("#prgProcessing").html('10%');
        $('#mdProcessing').modal('show');
        var counter = Math.floor((Math.random() * 9) + 1);
        console.log("counter", counter);
        var interval = setInterval(function() {
            counter++;
            counter_pc = (counter*10)+'%';
            $("#prgProcessing").css('width', counter_pc);
            $("#prgProcessing").html(counter_pc);
            if (counter == 10) {
                clearInterval(interval);
                $('#mdProcessing').modal('hide');
                handler_function();
            }
        }, 1000);
    }
</script>
@endsection
