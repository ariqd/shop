@extends('layouts.admint')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .no-underline,
        .no-underline:hover {
            text-decoration: none !important;
        }

        .input-group-append {
            width: 27%;
        }

        .input-group-append span {
            width: 100%;
            overflow: hidden;
        }

        .text-atalla {
            color: #5856d6;
            /* font-weight: bold; */
        }

    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.5.7/dist/cleave.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.btnDelete').on('click', function (e) {
                e.preventDefault();
                const parent = $(this).parent();
                const id = $(this).data('id');

                Swal.fire({
                        title: "Apa anda yakin?",
                        text: "Data akan terhapus secara permanen!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then(function (willDelete) {
                        console.log(willDelete)
                        if (willDelete) {
                            parent.find('.formDelete-' + id).submit();
                        }
                    });
            });

            value = 1;
            min = 1;
            count = 0;

            $('#weight').prop('readonly', true);

            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            setButtonState();

            $('.select2').select2();

            $('#customers').select2({
                placeholder: '- Pilih customer -',
                allowClear: true
            });

            $('#couriers').select2({
                placeholder: '- Pilih layanan -',
                allowClear: true
            });

            $('#customers').change(function () {
                if ($(this).val() != 0) {
                    $('#weight').prop('readonly', false);
                    $('#ongkir').removeClass('invisible');

                    if (count > 0) {
                        $('#couriers').prop('disabled', false);
                    }

                    $.ajax({
                        url: "{!! url('sales/search-customer') !!}/" + $(this).val(),
                        method: "get",
                        beforeSend: function () {
                            $('.loading').show();
                        },
                        success: function (response) {
                            $('.loading').hide();
                            if (response.customer.status === 'Distributor') {
                                $("#discount").val(40);
                                $("[id^=qty-s-]").val(2);
                                $("[id^=qty-m-]").val(2);
                                $("[id^=qty-l-]").val(2);
                                value = 2;
                                min = 2;
                            } else {
                                $("#discount").val(30);
                                min = 1;
                            }
                            $("#destination").val(response.customer.city_id);
                            countTotal();
                        },
                        complete: function () {
                            $('#search').prop('disabled', false);
                        }
                    });
                } else {
                    $('#ongkir').addClass('invisible');
                    $('#couriers').prop('disabled', true);
                    $('#weight').prop('readonly', true);
                    $("#discount").val(0);
                }
            });

            $('#couriers').change(function () {
                calculateCost();
            });

            $('#services').change(function () {
                var ongkir = $(this).val();
                $('#courier_service_name').val($('#services option:selected').text());
                $('#courier_fee-text').html('Rp ' + number_format(ongkir, '.', ',', 0));
                $('#courier_fee-text').html('Rp ' + number_format(ongkir, '.', ',', 0));
                countTotal();
            });

            $('#search').change(function () {
                $.ajax({
                    url: "{!! url('sales/search') !!}/" + $("#search").val(),
                    method: "get",
                    beforeSend: function () {
                        $('.loading').show();
                    },
                    success: function (response) {
                        // console.log(response);
                        if (document.getElementById('item-id-' + response.product.id) == null) {
                            var table = document.getElementById("tbody");
                            var row = table.insertRow();
                            row.setAttribute('id', 'item-id-' + response.product.id);

                            var cell0 = row.insertCell(0);
                            var cell1 = row.insertCell(1);
                            var cell2 = row.insertCell(2);
                            var cell3 = row.insertCell(3);
                            var cell4 = row.insertCell(4);
                            cell0.setAttribute('style',
                                'width: 30%;');
                            cell1.setAttribute('style',
                                'text-align:right;width: 10%;');
                            cell2.setAttribute('style',
                                'text-align:right;width: 25%;');
                            cell3.setAttribute('style',
                                'text-align:right;width: 25%;');
                            cell4.setAttribute('style',
                                'text-align:right;width: 10%;');

                            cell0.innerHTML =
                                '<b>' + response.product.code + '</b><br/>' +
                                response.product.name + ' ' +
                                '<input type="hidden" name="item[' + count + '][id]" value="' +
                                response.product.id + '">';
                            cell1.innerHTML =
                                '<select class="form-control form-control-sm mb-2" id="colors-' +
                                response.product.id + '" name="item[' + count + '][color]"></select>' +
                                '<div class="input-group input-group-sm mb-2">' +
                                '<div class="input-group-append"><span class="input-group-text">XS</span></div>' +
                                '<input type="number" class="form-control" value="0" name="item[' +
                                count + '][qty][xs]" id="qty-xs-' + response.product.id +
                                '" oninput="countSubtotal(' + response.product.id + ')"' +
                                '/></div>' +
                                '<div class="input-group input-group-sm mb-2">' +
                                '<div class="input-group-append"><span class="input-group-text">S</span></div>' +
                                '<input type="number" class="form-control" min="' + min + '" value="' + value + '" name="item[' +
                                count + '][qty][s]" id="qty-s-' + response.product.id +
                                '" oninput="countSubtotal(' + response.product.id + ')"' +
                                '/></div>' +
                                '<div class="input-group input-group-sm mb-2">' +
                                '<div class="input-group-append"><span class="input-group-text">M</span></div>' +
                                '<input type="number" class="form-control" min="' + min + '" value="' + value + '" name="item[' +
                                count + '][qty][m]" id="qty-m-' + response.product.id +
                                '" oninput="countSubtotal(' + response.product.id + ')"' +
                                '/></div>' +
                                '<div class="input-group input-group-sm mb-2">' +
                                '<div class="input-group-append"><span class="input-group-text">L</span></div>' +
                                '<input type="number" class="form-control" min="' + min + '" value="' + value + '" name="item[' +
                                count + '][qty][l]" id="qty-l-' + response.product.id +
                                '" oninput="countSubtotal(' + response.product.id + ')"' +
                                '/></div>' +
                                '<div class="input-group input-group-sm mb-2">' +
                                '<div class="input-group-append"><span class="input-group-text">XL</span></div>' +
                                '<input type="number" class="form-control" value="0" name="item[' +
                                count + '][qty][xl]" id="qty-xl-' + response.product.id +
                                '" oninput="countSubtotal(' + response.product.id + ')"' +
                                '/></div>';
                            cell2.innerHTML = '<span class="my-2" id="price-text-' +
                                response.product.id + '">Rp' + number_format(response.product.price, '.', ',', 0) +
                                '</span>' +
                                '<input type="hidden" name="item[' + count +
                                '][price]" value="' + response.product.price +
                                '" id="price-' + response.product.id + '">';
                            cell3.innerHTML =
                                '<input type="hidden" class="subtotal" id="subtotal-' +
                                response.product.id + '" name="item[' + count +
                                '][subtotal]" value="' + response.product.price +
                                '"/>' + '<span class="my-2" id="subtotal-text-' +
                                response.product.id + '">Rp' + number_format(response.product
                                    .price, '.', ',', 0) + '</span>';
                            cell4.innerHTML =
                                '<div class="text-center"><a style="cursor:pointer" onclick="voidItem(' +
                                response.product.id +
                                ')"><i class="fa fa-trash text-danger"></i></a></div>';

                            $.each(response.colors, function (val, i) {
                                $('#colors-' + response.product.id)
                                    .append($("<option></option>")
                                        .attr("value", val)
                                        .text(val));
                            });

                            count++;
                            setButtonState();
                            countSubtotal(response.product.id);
                            if (count > 0 && $('#customers').val() != 0) {
                                $('#couriers').prop('disabled', false);
                            }
                        } else {
                            alert('Produk sudah ada di Keranjang Belanja!')
                        }
                    },
                    complete: function () {
                        $('.loading').hide();
                    }
                });
            });
        });

        function setButtonState() {
            if (count <= 0) {
                $('#btnPay').attr('disabled', 'disabled');
            } else {
                $('#btnPay').removeAttr('disabled');
            }
        }

        function voidItem(id) {
            count--;
            setButtonState();
            $("#item-id-" + id).remove();
            if (count > 0 && $('#customers').val() == 0) {
                $('#couriers').prop('disabled', true);
            }
        }

        function calculateCost() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{!! url('sales/cost') !!}",
                method: "post",
                data: {
                    _token: CSRF_TOKEN,
                    courier: $('#couriers').val(),
                    weight: $('#weight').val(),
                    destination: $('#destination').val(),
                },
                beforeSend: function () {
                    $('.loading').show();
                    $('#services').empty();
                },
                success: function (response) {
                    $('.loading').hide();
                    var costs = response.rajaongkir.results[0].costs;
                    $('#services').prop('disabled', false);
                    $("#services").select2({
                        placeholder: '- Pilih layanan',
                        allowClear: true,
                        data: $.map(costs, function (item) {
                            return {
                                text: item.service,
                                id: item.cost[0].value
                            }
                        })
                    });
                },
                complete: function () {
                    $('#services').val(1).trigger('change.select2');
                },
                error: function (xhr) {
                    $('#ajax-errors').html('');
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('#ajax-errors').append('<div class="alert alert-danger">' + value + '</div');
                    });
                },
            });
        }

        function countSubtotal(id) {
            var actual_price = parseFloat($("#price-" + id).val()) || 0;
            var xs = parseFloat($("#qty-xs-" + id).val()) || 0;
            var s = parseFloat($("#qty-s-" + id).val()) || 0;
            var m = parseFloat($("#qty-m-" + id).val()) || 0;
            var l = parseFloat($("#qty-l-" + id).val()) || 0;
            var xl = parseFloat($("#qty-xl-" + id).val()) || 0;

            var qty = (xs + s + m + l + xl) || 0;

            if ($("#qty-" + id).val() === "" || qty == 0) {
                alert('Qty tidak boleh 0 atau kosong!');
                $('#btnPay').attr('disabled', 'disabled');
            } else {
                $('#btnPay').removeAttr('disabled');
            }

            var subtotal = parseFloat((actual_price * qty) || 0);

            $("#subtotal-text-" + id).text('Rp' + number_format(subtotal, '.', ',', 0));
            $("#subtotal-" + id).val(subtotal);
            countTotal();
        }

        function countTotal() {
            var all_subtotals_length = $('.subtotal').length;
            var grand_subtotal = 0;

            for (i = 0; i < all_subtotals_length; i++) {
                grand_subtotal = grand_subtotal + (parseFloat($('.subtotal:eq(' + i + ')').val() || 0));
            }

            var discount = parseFloat($("#discount").val() || 0);
            var discount_nominal = discount / 100 * grand_subtotal;
            var grand_total = (grand_subtotal - discount_nominal);

            $("#grand-total-span").text(number_format(grand_total, '.', ',', 0));
            $("#grand-total-input").val(grand_total);
        }

        function number_format(number, thousandsSep, decPoint, decimals) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number;
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
            var s = '';

            var toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec)
            };

            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }

    </script>
@endpush

@section('content')
<div class="tb-content tb-style1 pb-5">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">
            {{ @$sale ? 'Detail / Edit Nota Penjualan' : 'Nota Penjualan' }}
            <small class="text-muted"># {{ @$sale ? $sale->purchase_no : $no_so }}</small>
        </h2>
        <a href="{{ route('sales.index') }}" class="btn btn-outline-info btn-sm">Kembali ke list Nota Penjualan</a>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        @if(@$sale && @$sale->status == 'BELUM LUNAS')
            <div class="row mb-3">
                <div class="col-12">
                    <div class="tb-alert">
                        <div class="d-flex justify-content-between">
                            <div class="py-1">
                                <i class="fa fa-exclamation-circle"></i> Customer belum melunasi pembelian.
                            </div>
                            <div>
                                <a href="{{ url('sales/lunas/'.@$sale->id) }}" class="btn btn-success btn-sm m-0 no-underline"><i class="fa fa-check"></i> Lunas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <form action="{{ @$sale ? route('sales.update', $sale->id) : route('sales.store') }}" method="POST">
                    @csrf
                    {{ @$sale ? method_field('PUT') : '' }}
                    <div class="row">
                        <div class="col-8">
                            @if(!@$sale)
                                <div class="form-group row">
                                    <label for="search" class="col-sm-3 col-form-label">Cari Kode Produk:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="search" id="search" disabled>
                                            <option value="0" selected disabled>- Pilih Produk -</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->code }} {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="tb-card tb-style1">
                                <div class="tb-data-table tb-lock-table tb-style1">
                                    <table class="table stripe row-border order-column no-footer table-hover" aria-describedby="tb-no-locked_info" id="table">
                                        <thead>
                                            <tr>
                                                <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" aria-label="Nama: activate to sort column descending" style="width: 25%">
                                                    Produk
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Kategori: activate to sort column ascending" style="text-align:right;width: 25%">
                                                    Qty
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Harga: activate to sort column ascending" style="text-align:right;width: 20%">
                                                    Harga
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Total: activate to sort column ascending" style="text-align:right;width: 25%">
                                                    Total
                                                </th>
                                                {{-- @if(!@$sale) --}}
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Action: activate to sort column ascending" style="text-align:center;width: 5%"></th>
                                                {{-- @endif --}}
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            @if(@$sale)
                                                @foreach($sale->details as $key => $detail)
                                                    <tr id="item-id-{{ $detail->id }}">
                                                        <td class="align-middle" style="width: 25%">
                                                            <b>{{ $detail->stock->product->code }}</b> <br>
                                                            {{ $detail->stock->product->name }}
                                                            {{ $detail->stock->color }} | {{ $detail->stock->size }}
                                                            <input type="hidden" name="item[{{ $key }}][id]" value="{{ $detail->id }}">
                                                        </td>
                                                        <td class="align-middle text-right" style="width: 25%">
                                                            @if(!@$sale)
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" id="qty-{{ $detail->id }}" value="{{ $detail->qty }}" name="item[{{ $key }}][qty]" oninput="countSubtotal({{ $detail->id }})">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">pcs</span>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <span class="text-right">
                                                                    <strong>{{ $detail->qty }} pcs</strong>
                                                                    {{-- @if(@$sale->status == 'BELUM LUNAS')
                                                                        <p class="{{ $detail->stock->qty <= $detail->qty ? 'text-danger' : 'text-success' }}">Available: {{ $detail->stock->qty }} pcs</p>
                                                                    @endif --}}
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td class="align-middle text-right" style="width: 20%">
                                                            Rp{{ number_format($detail->stock->product->price, 0, ',', '.') }}
                                                            <input type="hidden" id="price-{{ $detail->id }}" value="{{ $detail->stock->product->price }}" name="item[{{ $key }}][price]" oninput="countSubtotal({{ $detail->id }})">
                                                        </td>
                                                        <td class="align-middle text-right" style="width: 25%">
                                                            <span id="subtotal-text-{{ $detail->id }}">Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                                            <input type="hidden" class="form-control subtotal" id="subtotal-{{ $detail->id }}" value="{{ $detail->subtotal }}" name="item[{{ $key }}][subtotal]" readonly>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            {{-- <a href="#" class="text-atalla btnDelete" data-id="{{ $detail->id }}">
                                                            Hapus
                                                            </a>
                                                            <form action="{{ url('sales/delete/detail/'.$detail->id) }}" method="post" class="formDelete-{{ $detail->id }} d-none">
                                                                {!! csrf_field() !!}
                                                                {!! method_field('delete') !!}
                                                            </form> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            @if(@$sale && @$sale->status != 'BELUM LUNAS')
                                <div class="row">
                                    <div class="col-4">
                                        <label for="customers">Customer</label>
                                    </div>
                                    <div class="col-8 text-right">
                                        <strong>{{ $sale->customer->name }}</strong><br>
                                        {{ $sale->customer->status }} <br>
                                        @if(@$sale->discount)
                                            Diskon {{ @$sale->discount }}%
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="customers">Pengiriman</label>
                                    </div>
                                    <div class="col-8 text-right">
                                        <strong>{{ $sale->customer->address }}</strong><br>
                                        Kota {{ $sale->customer->city_name }} <br>
                                        Provinsi {{ $sale->customer->province_name }} <br>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="customers">Customer:</label>
                                    <select class="form-control" name="customer_id" id="customers" {{ @$sale ? 'disabled' : '' }}>
                                        <option></option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ @$sale->customer_id == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="discount">Diskon (%)</label>
                                    <input type="number" class="form-control" id="discount" name="discount" min="0" value="{{ @$sale ? $sale->discount : 0 }}" oninput="countTotal()">
                                </div>
                            @endif
                            @if(@$sale)
                                {{-- If edit, show text --}}
                                <div class="d-flex justify-content-between mt-4">
                                    <div class="">
                                        <span>Kurir:</span>
                                    </div>
                                    <div class=" text-right">
                                        <strong>{{ strtoupper($sale->courier_name) }}</strong>
                                        <p> {{ $sale->courier_service_name }} | {{ $sale->weight }} gram</p>
                                    </div>
                                </div>
                                @if(@$sale->status == 'BELUM LUNAS')
                                    {{-- If edit and status BELUM LUNAS --}}
                                    <div class="card border-warning mb-3">
                                        <div class="card-body p-2">
                                            <p class="font-weight-bold"><i class="fa fa-info-circle"></i> Edit Kurir</p>
                                            <div class="form-group">
                                                <label for="couriers">Kurir</label>
                                                <select class="form-control" name="courier_name" id="couriers">
                                                    <option></option>
                                                    @foreach($couriers as $key => $courier)
                                                        <option value="{{ $key }}">
                                                            {{ $courier }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="services">Layanan</label>
                                                <select name="courier_fee" id="services" class="form-control services w-100" disabled>
                                                    <option></option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="courier_service_name" id="courier_service_name">
                                            <div class="form-group">
                                                <label for="weight">Berat (gram)</label>
                                                <input type="text" class="form-control" id="weight" name="weight" value="{{ @$sale ? $sale->weight : 1 }}" oninput="calculateCost()">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                {{-- If create --}}
                                <div class="form-group">
                                    <label for="couriers">Kurir</label>
                                    <select class="form-control" name="courier_name" id="couriers">
                                        <option></option>
                                        @foreach($couriers as $key => $courier)
                                            <option value="{{ $key }}">
                                                {{ $courier }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="services">Layanan</label>
                                    <select name="courier_fee" id="services" class="form-control services w-100" disabled>
                                        <option></option>
                                    </select>
                                </div>
                                <input type="hidden" name="courier_service_name" id="courier_service_name">
                                <div class="form-group">
                                    <label for="weight">Berat (gram)</label>
                                    <input type="text" class="form-control" id="weight" name="weight" value="{{ @$sale ? $sale->weight : 1 }}" oninput="calculateCost()">
                                </div>
                            @endif
                            <div class="row {{ @!$sale ? 'invisible' : '' }} mt-4" id="ongkir">
                                <div class="col-6">
                                    <p class="">Ongkos Kirim:</p>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" id="destination" name="destination" value="{{ @$sale ? @$sale->customer->city_id : 0 }}">
                                    <p class="float-right" id="courier_fee-text">
                                        Rp {{ @$sale ? number_format($sale->courier_fee, 0, ',', '.') : '' }}
                                    </p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">
                                    <p><strong>Total (excl. Ongkir):</strong></p>
                                </div>
                                <div class="col-7">
                                    <h5 class="text-right"> Rp
                                        <span id="grand-total-span">{{ @$sale ? number_format($sale->total, 0, ',', '.') : '-' }}</span>
                                    </h5>
                                    <input type="hidden" id="grand-total-input" name="total">
                                </div>
                            </div>
                            <input type="hidden" value="{{ @$sale ? $sale->purchase_no : $no_so }}" name="purchase_no">
                            @if(@$sale)
                                @if(@$sale->status == 'BELUM LUNAS')
                                    <div class="row my-2">
                                        <div class="col-6">
                                            Status Transaksi
                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="tb-badge tb-box-colo4">BELUM LUNAS</span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-block mt-1 mb-2">Edit Nota Penjualan</button>
                                    <a href="{{ url('sales/lunas/'.@$sale->id) }}" class="btn btn-block btn-success mb-2">
                                        <i class="fa fa-check"></i> Ubah Status Pembelian ke Lunas
                                    </a>
                                    <a role="button" href="#" onclick="window.print()" class="btn btn-outline-link btn-block mt-2 mb-3">
                                        <i class="fa fa-print"></i> Cetak Nota Penjualan
                                    </a>
                                    <hr>
                                    <a href="{{ url('sales/cancel/'.@$sale->id) }}" class="btn btn-block btn-secondary mt-3 mb-2">
                                        <i class="fa fa-times"></i> Batalkan Transaksi
                                    </a>
                                @elseif(@$sale->status == 'LUNAS')
                                    <div class="row my-2">
                                        <div class="col-6">
                                            Status Transaksi
                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="tb-badge tb-box-colo3">LUNAS</span>
                                        </div>
                                    </div>
                                    <a href="{{ url('sales/dikirim/'.@$sale->id) }}" class="btn btn-block btn-primary btn- my-2">
                                        <i class="fa fa-check"></i> Barang Dikirim Ke {{ $sale->customer->status }} {{ $sale->customer->name }}
                                    </a>
                                    <a role="button" href="#" onclick="window.print()" class="btn btn-outline-link btn-block mt-2 mb-3">
                                        <i class="fa fa-print"></i> Cetak Nota Penjualan
                                    </a>
                                @elseif(@$sale->status == 'DIKIRIM')
                                    <div class="row my-2">
                                        <div class="col-6">
                                            Status Transaksi
                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="tb-badge tb-box-colo2">BARANG DIKIRIM</span>
                                        </div>
                                    </div>
                                    <a href="{{ url('sales/finish/'.@$sale->id) }}" class="btn btn-block btn-info my-2">
                                        <i class="fa fa-check"></i> Barang Diterima {{ $sale->customer->status }} {{ $sale->customer->name }}
                                    </a>
                                    <a role="button" href="#" onclick="window.print()" class="btn btn-outline-link btn-block mt-2 mb-3">
                                        <i class="fa fa-print"></i> Cetak Nota Penjualan
                                    </a>
                                @elseif(@$sale->status == 'FINISH')
                                    <div class="row my-2">
                                        <div class="col-6">
                                            Status Transaksi
                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="tb-badge tb-box-colo1">finish</span>
                                        </div>
                                    </div>
                                    <a role="button" href="#" onclick="window.print()" class="btn btn-outline-link btn-block mt-2 mb-3">
                                        <i class="fa fa-print"></i> Cetak Nota Penjualan
                                    </a>
                                @elseif(@$sale->status == 'CANCEL')
                                    <div class="row my-2">
                                        <div class="col-6">
                                            Status Transaksi
                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="tb-badge tb-box-colo7">Cancel</span>
                                        </div>
                                    </div>
                                    <a role="button" href="#" onclick="window.print()" class="btn btn-outline-link btn-block mt-2 mb-3">
                                        <i class="fa fa-print"></i> Cetak Nota Penjualan
                                    </a>
                                @endif
                            @else
                                <button type="submit" id="btnPay" class="btn btn-info btn-block my-2">Simpan</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
