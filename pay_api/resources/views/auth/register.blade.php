@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header upper-link"><i class="fas fa-user-plus"></i> {{ __('Register: User Data') }}</div>

                <div class="card-body">
                    <form id="form_register" method="POST" action="/register_checkout/">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-3">
                                <input id="password" type="password" class="form-control" name="password" required minlength="6" maxlength="10">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="6" maxlength="10">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                            <div class="col-md-3">
                                <input id="cpf" type="text" class="form-control cpf" name="cpf" value="" required placeholder="999.999.999-99">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cep" class="col-md-4 col-form-label text-md-right">{{ __('CEP') }}</label>

                            <div class="col-md-3">
                                <input id="cep" type="text" class="form-control cep" name="cep" value="" required placeholder="99999-99">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phones" class="col-md-4 col-form-label text-md-right">{{ __('Phones') }}</label>

                            <div class="col-md-6">
                                <div class="input-group mb-1">
                                    <input type="text" class="form-control phone col-6" placeholder="(99) 9999-9999" id="phone">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="btnPhoneAdd">Add</button>
                                    </div>
                                </div>
                                <div class="input-group mb-1">
                                    <input id="phones_label" type="text" class="form-control phones_field" name="phones" value="" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="btnPhoneClear">Clear</button>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Note: insert one or more phones.
                                </small>
                                <input id="phones" type="hidden" class="form-control phones_field" name="phones" value="">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary float-right col-4">
                                    {{ __('Next') }}
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
        $('.cpf').mask('000.000.000-00', {reverse: true, clearIfNotMatch: true});
        $('.cep').mask('00000-000', {clearIfNotMatch: true});
        $('.phone').mask('(00) 0000-00009', {clearIfNotMatch: true});
    });
    $(document).ready(function(){
        $('#btnPhoneClear').click(function(event) {
            $('.phones_field').val('');
        });
        $('#btnPhoneAdd').click(function(event) {
            var phone = $("#phone").val();
            if(phone.length == 0) {
                $('#mdErrorBody').html("Enter one phone for add.");
                $('#mdError').modal('show');
            } else {
                var phones = $('#phones').val();
                $('.phones_field').val(phones.length > 0 ? (phones+' / '+phone) : phone);
                $('#phone').val('');
            }
        });
        $('#form_register').submit(function(event) {
            event.preventDefault();
            var phones = $("#phones").val();
            if(phones.length == 0) {
                $('#mdErrorBody').html("Enter one or more phones.");
                $('#mdError').modal('show');
            } else {
                $.post('/register_validation/', $( "#form_register" ).serialize(), function (data) {
                    if(data.length > 0) {
                        console.log(data);
                        $('#mdErrorBody').html(data[0]);
                        $('#mdError').modal('show');
                    } else {
                        $("#form_register").unbind();
                        $("#form_register").submit();
                    }
                });
            }
        });
    });
</script>
@endsection