$(document).ready(function () {
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
                    } else {
                        $("#discount").val(30);
                    }
                    $("#destination").val(response.customer.city_id);
                    countTotal();
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
                $('.loading').hide();
                if (document.getElementById('item-id-' + response.stock.id) == null) {
                    var table = document.getElementById("tbody");
                    var row = table.insertRow();
                    row.setAttribute('id', 'item-id-' + response.stock.id);

                    var cell0 = row.insertCell(0);
                    var cell1 = row.insertCell(1);
                    var cell2 = row.insertCell(2);
                    var cell3 = row.insertCell(3);
                    var cell4 = row.insertCell(4);
                    cell0.setAttribute('style', 'vertical-align:middle;width: 30%;');
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
                        '"/> <div class="input-group-append"><span class="input-group-text">pcs</span></div></div>';
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
            },
            complete: function () {
                $('.input-number').cleave({
                    numeral: true,
                    delimiter: '.',
                    numeralDecimalMark: ',',
                    numeralThousandsGroupStyle: 'thousand',
                    prefix: 'Rp',
                });
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
        },
        success: function (response) {
            $('.loading').hide();
            var costs = response.rajaongkir.results[ 0 ].costs;
            $('#services').prop('disabled', false);
            $("#services").select2({
                placeholder: '- Pilih layanan',
                allowClear: true,
                data: $.map(costs, function (item) {
                    return {
                        text: item.service + ' - ' + item.description,
                        id: item.cost[ 0 ].value
                    }
                })
            });
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
    if (s[ 0 ].length > 3) {
        s[ 0 ] = s[ 0 ].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[ 1 ] || '').length < prec) {
        s[ 1 ] = s[ 1 ] || '';
        s[ 1 ] += new Array(prec - s[ 1 ].length + 1).join('0')
    }

    return s.join(dec)
}
