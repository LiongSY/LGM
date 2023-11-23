@extends('layouts.customers.app')

@section('content')
<div class="container" style="margin-top:9%">

<form>
    <div class="form-row">
        <div class="mb-4 border-bottom pb-2 col-12">
            <h4 class="mb-0">Booking Details</h4>
        </div>
        <div class="form-group col-md-1">
            <label for="inputAdults">Adults</label>
            <select id="inputAdults" class="form-control">
                @for ($i = 1; $i <= 50; $i++)
                    <option>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group col-md-1">
            <label for="inputChildren">Children</label>
            <select id="inputChildren" class="form-control">
                @for ($i = 0; $i <= 50; $i++)
                    <option>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group col-md-1">
            <label for="inputInfants">Infants</label>
            <select id="inputInfants" class="form-control">
                @for ($i = 0; $i <= 50; $i++)
                    <option>{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="container">
        <div class="row mb-4 justify-content">
            <div class="col-md-4 col-12">
                <div class="mb-4 border-bottom pb-2">
                    <h4 class="mb-0">Type and Number of Room</h4>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-dark">Single Room</p>
                            </div>
                            <div class="input-group w-auto justify-content-end align-items-center">
                                <input type="button" value="-" class="button-minus border rounded-circle icon-shape icon-sm mx-1" data-field="quantity">
                                <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field border-0 text-center w-25">
                                <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm" data-field="quantity">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-dark">Double</p>
                            </div>
                            <div class="input-group w-auto justify-content-end align-items-center">
                                <input type="button" value="-" class="button-minus border rounded-circle icon-shape icon-sm mx-1" data-field="quantity">
                                <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field border-0 text-center w-25">
                                <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm lh-0" data-field="quantity">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-dark">Triple</p>
                            </div>
                            <div class="input-group w-auto justify-content-end align-items-center">
                                <input type="button" value="-" class="button-minus border rounded-circle icon-shape icon-sm mx-1 lh-0" data-field="quantity">
                                <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field border-0 text-center w-25">
                                <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm lh-0" data-field="quantity">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function incrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal)) {
            parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(0);
        }
    }

    function decrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal) && currentVal > 0) {
            parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(0);
        }
    }

    $('.input-group').on('click', '.button-plus', function (e) {
        incrementValue(e);
    });

    $('.input-group').on('click', '.button-minus', function (e) {
        decrementValue(e);
    });
</script>

@endsection
