@extends('layouts.admint')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.5.7/dist/cleave.min.js"></script>
    <script>
        (function ($, window, undefined) {
            'use strict'
            $.fn.cleave = function (opts) {
                var defaults = {
                        autoUnmask: false
                    },
                    options = $.extend(defaults, opts || {});
                return this.each(function () {
                    var cleave = new Cleave('#' + this.id, options),
                        $this = $(this);
                    $this.data('cleave-auto-unmask', options['autoUnmask']);;
                    $this.data('cleave', cleave)
                });
            }

            var origGetHook, origSetHook;

            if ($.valHooks.input) {
                origGetHook = $.valHooks.input.get;
                origSetHook = $.valHooks.input.set;
            } else {
                $.valHooks.input = {};
            }

            $.valHooks.input.get = function (el) {
                var $el = $(el),
                    cleave = $el.data('cleave');
                if (cleave) {
                    return $el.data('cleave-auto-unmask') ? cleave.getRawValue() : el.value;
                } else if (origGetHook) {
                    return origGetHook(el);
                } else {
                    return undefined;
                }
            }

            $.valHooks.input.set = function (el, val) {
                var $el = $(el),
                    cleave = $el.data('cleave');
                if (cleave) {
                    cleave.setRawValue(val);
                    return $el;
                } else if (origSetHook) {
                    return origSetHook(el);
                } else {
                    return undefined;
                }
            }

        })(jQuery, window);

        $(document).ready(function () {
            $('#weight').prop('readonly', true);

            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $('.select2').select2();

            $('#search').change(function () {
                $.ajax({
                    url: "{!! url('sales-toko/search') !!}/" + $("#search").val(),
                    method: "get",
                    beforeSend: function () {
                        $('.loading').show();
                    },
                    success: function (response) {
                        $('.loading').hide();
                        if (document.getElementById('item-id-' + response.stock.id) == null) {
                            let table = document.getElementById("tbody");
                            let row = table.insertRow();
                            row.setAttribute('id', 'item-id-' + response.stock.id);

                            let cell0 = row.insertCell(0);
                            let cell1 = row.insertCell(1);
                            let cell2 = row.insertCell(2);
                            let cell3 = row.insertCell(3);
                            let cell4 = row.insertCell(4);
                            cell0.setAttribute('style',
                                'vertical-align:middle;width: 30%;');
                            cell1.setAttribute('style',
                                'text-align:right;vertical-align:middle;width: 10%;');
                            cell2.setAttribute('style',
                                'text-align:right;vertical-align:middle;width: 25%;');
                            cell3.setAttribute('style',
                                'text-align:right;vertical-align:middle;width: 25%;');
                            cell4.setAttribute('style',
                                'text-align:right;vertical-align:middle;width: 10%;');

                            cell0.innerHTML =
                                '<b>' + response.stock.product.code + '</b><br/>' +
                                response.stock.product.name + ' ' +
                                response.stock.color + ' | ' +
                                response.stock.size + '<br/> ' +
                                '<input type="hidden" name="item[' + count + '][id]" value="' +
                                response.stock.id + '">';
                            cell1.innerHTML =
                                '<div class="input-group">' +
                                '<input type="number" class="form-control" value="1" name="item[' +
                                count + '][qty]" id="qty-' + response.stock.id +
                                '" oninput="countSubtotal(' + response.stock.id +
                                ')" placeholder="' + response.stock.qty +
                                '"/> <div class="input-group-append"><span class="input-group-text">pcs</span></div></div>' +
                                '<small class="text-muted">Stok tersedia: ' + response.stock.qty + '</small>';
                            cell2.innerHTML = '<span class="my-2" id="price-text-' +
                                response.stock.id + '">Rp' + number_format(response.stock
                                    .product.price, '.', ',', 0) + '</span>' +
                                '<input type="hidden" name="item[' + count +
                                '][price]" value="' + response.stock.product.price +
                                '" id="price-' + response.stock.id + '">';
                            cell3.innerHTML =
                                '<input type="hidden" class="subtotal" id="subtotal-' +
                                response.stock.id + '" name="item[' + count +
                                '][subtotal]" value="' + response.stock.product.price +
                                '"/>' + '<span class="my-2" id="subtotal-text-' +
                                response.stock.id + '">Rp' + number_format(response.stock
                                    .product
                                    .price, '.', ',', 0) + '</span>';
                            cell4.innerHTML =
                                '<div class="text-center"><a style="cursor:pointer" onclick="voidItem(' +
                                response.stock.id +
                                ')"><i class="fa fa-trash text-danger"></i></a></div>';

                            count++;
                            setButtonState();
                            countTotal();
                            if (count > 0 && $('#customers').val() != 0) {
                                $('#couriers').prop('disabled', false);
                            }
                        } else {
                            var num = +$("#qty-" + response.stock.id).val() + 1;
                            $("#qty-" + response.stock.id).val(num);
                            countSubtotal(response.stock.id);
                        }
                    }
                });
            });
        });

        var count = 0;

        function setButtonState() {
            if (count <= 0) {
                $('#btnPay').attr('disabled', 'disabled');
            } else {
                $('#btnPay').removeAttr('disabled');
            }
        }

        function voidItem(id) {
            $("#item-id-" + id).remove();
            count--;
            setButtonState();
            countTotal();
            if (count > 0 && $('#customers').val() == 0) {
                $('#couriers').prop('disabled', true);
            }
        }

        function countSubtotal(id) {
            var actual_price = parseFloat($("#price-" + id).val()) || 0;
            var qty = parseFloat($("#qty-" + id).val()) || 0;

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
<div class="tb-content tb-style1">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">
            {{ @$sale ? 'Detail / Edit Nota Penjualan' : 'Nota Penjualan' }}
            <small class="text-muted"># {{ @$sale ? $sale->purchase_no : $no_so }}</small>
        </h2>
        <a href="{{ route('sales.index') }}" class="btn btn-outline-info btn-sm">Kembali ke list Nota Penjualan</a>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row">
            <div class="col-12">
                <form action="{{ @$sale ? route('sales-toko.update', $sale) : route('sales-toko.store') }}" method="POST">
                    @csrf
                    {{ @$sale ? method_field('PUT') : '' }}
                    <div class="row">
                        <div class="col-8">
                            @if(@!$sale)
                                <div class="form-group row">
                                    <label for="search" class="col-sm-3 col-form-label">Cari Kode Produk:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="search" id="search">
                                            <option value="0" selected disabled>- Pilih Produk -</option>
                                            @foreach($stocks as $stock)
                                                <option value="{{ $stock->id }}">
                                                    {{ $stock->product->code }} {{ $stock->product->name }}
                                                    {{ $stock->color }} | {{ $stock->size }}
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" aria-label="Nama: activate to sort column descending" style="width: 25%">Produk</th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Kategori: activate to sort column ascending" style="text-align:right;width: 25%">Qty
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Harga: activate to sort column ascending" style="text-align:right;width: 20%">Harga
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Total: activate to sort column ascending" style="text-align:right;width: 25%">Total
                                                </th>
                                                @if(!@$sale)
                                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Action: activate to sort column ascending" style="text-align:right;width: 5%"></th>
                                                @endif
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
                                                                <span class="text-right"><strong>{{ $detail->qty }}
                                                                        pcs</strong></span>
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
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-secondary">Customer</p>
                                <div>
                                    <input type="hidden" name="customer_id" value="1">
                                    <p><strong>Retail</strong></p>
                                </div>
                            </div>
                            <div class="mb-2 form-row">
                                <label for="discount" class="col-8 col-form-label">Diskon (%)</label>
                                <div class="col-4">
                                    @if(!@$sale)
                                        <input type="number" class="form-control" id="discount" name="discount" value="0" oninput="countTotal()" min="0" max="100" />
                                    @else
                                        <p class="text-right"><strong>{{ $sale->discount }}%</strong></p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                <div class="col-2">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-10">
                                    <h4 class="float-right">Rp
                                        <span id="grand-total-span">
                                            {{ @$sale ? number_format($sale->total, 0, ',', '.') : '0' }}
                                        </span>
                                    </h4>
                                    <input type="hidden" id="grand-total-input" name="total">
                                </div>
                            </div>
                            <hr>
                            <input type="hidden" value="{{ @$sale ? $sale->purchase_no : $no_so }}" name="purchase_no">
                            @if(@$sale)
                                @if($sale->status == 'FINISH')
                                    <div class="row my-2">
                                        <div class="col-6">
                                            Status Transaksi
                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="tb-badge tb-box-colo1">FINISH</span>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-block btn-success">Cetak Nota Penjualan</a>
                                @else
                                    <button type="submit" id="btnPay" class="btn btn-info btn-block">Simpan</button>
                                @endif
                            @else
                                <button type="submit" id="btnPay" class="btn btn-info btn-block">Simpan</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
