let hasCPF = true;
let donationPeriodicity = "monthly";
let donationAmount = 50;
let config = null;
let selectedPayment = "credit_card";
let minOnceDonationCreditCard = 0;
let minOnceDonationBankSlip = 0;
let minOnceDonationPix = 0;
let lastDonationButtonClicked = null;

function setValuesFromQueryString() {
    let params = (new URL(document.location)).searchParams;
    let amount = params.get('amount');
    let periodicity = params.get('recurring_period');
    let paymentMethod = params.get('payment_method');
    let source = params.get('source');
    let source_url = params.get('referrer_url');
    let source_id = params.get('referrer_post_id');

    let fieldSetId = 'donation-monthly-group';
    let fieldOtherId = 'field-other-monthly';
    let fieldSourceId = 'field-source';
    let fieldSourceUrlId = 'field-source-url';
    let fieldSourceIdId = 'field-source-id';

    if (source) {
        let sourceEl = document.getElementById(fieldSourceId)
        sourceEl.value = source;
    }

    if (source_url) {
        let sourceUrlEl = document.getElementById(fieldSourceUrlId)
        sourceUrlEl.value = source_url;
    }

    if (source_id) {
        let sourceIdEl = document.getElementById(fieldSourceIdId)
        sourceIdEl.value = source_id;
    }

    if (periodicity) {
        let periodicityEl;
        periodicity = periodicity.toLowerCase();

        switch (periodicity) {
            case 'monthly':
            case 'months':
            case 'mensal':
                periodicityEl = document.getElementById('inlineRadio1');
                break;

            case 'yearly':
            case 'years':
            case 'anual':
                fieldSetId = 'donation-yearly-group';
                fieldOtherId = 'field-other-yearly';
                periodicityEl = document.getElementById('inlineRadio2');
                break;

            case 'única':
            case 'unica':
            case 'once':
            case 'one-time':
                fieldSetId = 'donation-once-group';
                fieldOtherId = 'field-other-once';
                periodicityEl = document.getElementById('inlineRadio3');
                break;

            default:
                break;
        }

        if (periodicityEl) {
            periodicityEl.click();
        }
    }

    if (paymentMethod) {
        let methodEl;
        paymentMethod = paymentMethod.toLowerCase();

        switch (paymentMethod) {
            case 'credit_card':
            case 'cartao':
            case 'cartão':
            case 'cartãodecrédito':
            case 'cartaodecredito':
            case 'cartão_de_crédito':
            case 'cartao_de_credito':
            case 'crédito':
            case 'credito':
                methodEl = document.getElementById('payment-credit-card');
                break;

            case 'bank_slip':
            case 'boleto':
                methodEl = document.getElementById('payment-bank-slip');
                break;

            case 'pix':
                methodEl = document.getElementById('payment-pix');
                break;

            default:
                break;
        }

        if (methodEl) {
            methodEl.click();
        }
    }

    if (amount) {
        let amountElementId = amount;
        let amountEl = document.querySelector('#' + fieldSetId + ' [data-amount-for-selection="' + amount + '"]');

        if (amountEl) {
            amountEl.click();
        } else {
            let otherElem = document.getElementById(fieldOtherId);

            if (otherElem) {
                otherElem.focus();
                otherElem.value = amount;
            }
        }
    }
}

$(document).ready(function () {
    //$('.option-default-monthly').trigger('click');
    $('#field-zipcode').mask('00000-000');
    $('#field-cpf').mask('000.000.000-00');
    $('#field-card-number').mask('0000 0000 0000 0000');
    $('#field-card-expiration').mask('00/00');
    $('#field-card-cvc').mask('0000');

    $('#field-other-monthly').mask("R$ 0#");
    $('#field-other-yearly').mask("R$ 0#");
    $('#field-other-once').mask("R$ 0#");

    let origin = window.location.href;

    $.getJSON(origin + "config.json", function (data) {
        config = data;

        minOnceDonationCreditCard = config.minOnceDonation.creditCard;
        minOnceDonationBankSlip = config.minOnceDonation.bankSlip;
        minOnceDonationPix = config.minOnceDonation.pix;

        $("#text-block1-title").html(config.textBlock1.title);
        $("#text-block1-content").html(config.textBlock1.content);
        $("#text-block2-title").html(config.textBlock2.title);
        $("#text-block2-content").html(config.textBlock2.content);

        let htmlFooter = "";
        for (let i = 0; i < config.footerLinks.length; i++) {
            htmlFooter += "<a href='" + config.footerLinks[i].link + "' target='" + config.footerLinks[i].target + "' rel='noopener noreferrer'>" + config.footerLinks[i].name + "</a>" + (i + 1 < config.footerLinks.length ? " | " : "");
        }
        $("#footer-links").html(htmlFooter);


        $("#button-monthly1")
            .attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton1.amount + "," + config.donationMonthlyButton1.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationMonthlyButton1.amount)
            .text(config.donationMonthlyButton1.display);
        $("#button-monthly2")
            .attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton2.amount + "," + config.donationMonthlyButton2.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationMonthlyButton2.amount)
            .text(config.donationMonthlyButton2.display);
        $("#button-monthly3")
            .attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton3.amount + "," + config.donationMonthlyButton3.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationMonthlyButton3.amount)
            .text(config.donationMonthlyButton3.display);
        $("#button-monthly4")
            .attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton4.amount + "," + config.donationMonthlyButton4.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationMonthlyButton4.amount)
            .text(config.donationMonthlyButton4.display);
        $("#button-monthly5")
            .attr("onclick", "donationOption(this,'monthly'," + config.donationMonthlyButton5.amount + "," + config.donationMonthlyButton5.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationMonthlyButton5.amount)
            .text(config.donationMonthlyButton5.display);

        $("#button-yearly1")
            .attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton1.amount + "," + config.donationYearlyButton1.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationYearlyButton1.amount)
            .text(config.donationYearlyButton1.display);
        $("#button-yearly2")
            .attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton2.amount + "," + config.donationYearlyButton2.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationYearlyButton2.amount)
            .text(config.donationYearlyButton2.display);
        $("#button-yearly3")
            .attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton3.amount + "," + config.donationYearlyButton3.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationYearlyButton3.amount)
            .text(config.donationYearlyButton3.display);
        $("#button-yearly4")
            .attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton4.amount + "," + config.donationYearlyButton4.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationYearlyButton4.amount)
            .text(config.donationYearlyButton4.display);
        $("#button-yearly5")
            .attr("onclick", "donationOption(this,'yearly'," + config.donationYearlyButton5.amount + "," + config.donationYearlyButton5.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationYearlyButton5.amount)
            .text(config.donationYearlyButton5.display);

        $("#button-once1")
            .attr("onclick", "donationOption(this,'once'," + config.donationOnceButton1.amount + "," + config.donationOnceButton1.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationOnceButton1.amount)
            .text(config.donationOnceButton1.display);
        $("#button-once2")
            .attr("onclick", "donationOption(this,'once'," + config.donationOnceButton2.amount + "," + config.donationOnceButton2.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationOnceButton2.amount)
            .text(config.donationOnceButton2.display);
        $("#button-once3")
            .attr("onclick", "donationOption(this,'once'," + config.donationOnceButton3.amount + "," + config.donationOnceButton3.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationOnceButton3.amount)
            .text(config.donationOnceButton3.display);
        $("#button-once4")
            .attr("onclick", "donationOption(this,'once'," + config.donationOnceButton4.amount + "," + config.donationOnceButton4.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationOnceButton4.amount)
            .text(config.donationOnceButton4.display);
        $("#button-once5")
            .attr("onclick", "donationOption(this,'once'," + config.donationOnceButton5.amount + "," + config.donationOnceButton5.showAddOnFee + ")")
            .attr("data-amount-for-selection", config.donationOnceButton5.amount)
            .text(config.donationOnceButton5.display);

        $('.option-default-monthly').trigger('click');
    }).done(function () {
        setValuesFromQueryString();
    }).fail(function (a) {
        console.log(a);
        alert("Erro ao carregar configurações." + a);
    });

    $('.option-default-monthly').trigger('click');
});

function setPeriodOption(periodicity) {
    $('#field-other-monthly').val("");
    $('#field-other-yearly').val("");
    $('#field-other-once').val("");

    $('#donation-monthly-group').addClass('d-none').removeClass('d-block');
    $('#donation-yearly-group').addClass('d-none').removeClass('d-block');
    $('#donation-once-group').addClass('d-none').removeClass('d-block');
    $('#donation-' + periodicity + '-group').addClass('d-block').removeClass('d-none');

    $('.option-default-' + periodicity).trigger('click');
    $('#payment-credit-card').trigger('click');

    switch (periodicity) {
        case "monthly":
            $("#payment-pix").prop('disabled', true);
            //$("#payment-bank-slip").prop('disabled', true);
            $("#payment-bank-slip").prop('disabled', false);
            //$("#payment-pix").prop('disabled', true);
            $("#payment-pix").prop('disabled', false);
            //$("#payment-bank-slip").next().html("Boleto - <small><i>Apenas para pagamentos únicos</i></small>");
            //$("#payment-pix").next().html("PIX - <small><i>Apenas para pagamentos únicos</i></small>");
            break;
        case "yearly":
            $("#payment-pix").prop('disabled', true);
            //$("#payment-bank-slip").prop('disabled', true);
            $("#payment-bank-slip").prop('disabled', false);
            //$("#payment-pix").prop('disabled', true);
            $("#payment-pix").prop('disabled', false);
            //$("#payment-bank-slip").next().html("Boleto - <small><i>Apenas para pagamentos únicos</i></small>");
            //$("#payment-pix").next().html("PIX - <small><i>Apenas para pagamentos únicos</i></small>");
            break;
        case "once":
            $("#payment-pix").prop('disabled', false);
            $("#payment-bank-slip").prop('disabled', false);
            $("#payment-pix").next().html("PIX");
            $("#payment-bank-slip").next().html("Boleto");
            break;
    }

    if (hasCPF == false) {
        $("#payment-pix").prop('disabled', true);
        $("#payment-bank-slip").prop('disabled', true);
    }
}

function donationOption(el, type, amount, showAddOnFee) {
    lastDonationButtonClicked = el;
    $('#donation-' + type + '-group button').addClass('btn-outline-dark').removeClass('active');
    $(el).addClass('active').removeClass('btn-outline-dark');
    $("#field-other-" + type).css('background-color', '#fff').val("");

    if (config && showAddOnFee) {
        $("#div-add-on-fee").slideDown();

        let feeAmount = 0;

        switch (selectedPayment) {
            case "credit_card":
                feeAmount = config.addOnFeeValues.creditCard.fix;
                feeAmount += amount * (config.addOnFeeValues.creditCard.percent / 100);
                break;
            case "bank_slip":
                feeAmount = config.addOnFeeValues.bankSlip.fix;
                feeAmount += amount * (config.addOnFeeValues.bankSlip.percent / 100);
                break;
            case "Pix":
                feeAmount = config.addOnFeeValues.pix.fix;
                feeAmount += amount * (config.addOnFeeValues.pix.percent / 100);
                break;
        }

        $("#div-add-on-fee label").html("Adicione + <strong>R$ " + feeAmount.toFixed(2) + "</strong> para cobrir as tarifas bancárias");


        if ($('#field-add-on-fee').is(':checked')) {
            amount += feeAmount;
        }

    }
    else {
        $("#div-add-on-fee").slideUp();
    }


    switch (type) {
        case "monthly":
            $(".button-confirm-payment").text("Contribuir com R$ " + amount + " por mês");
            break;
        case "yearly":
            $(".button-confirm-payment").text("Contribuir com R$ " + amount + " por ano");
            break;
        case "once":
            $(".button-confirm-payment").text("Contribuir com R$ " + amount);
            break;
    }


    donationPeriodicity = type;
    donationAmount = amount;
}
function donationOtherOption(el, type, showAddOnFee) {

    lastDonationButtonClicked = el;
    amount = parseFloat($(el).cleanVal());


    if (amount != "" && amount > 0) {

        switch (selectedPayment) {
            case "credit_card":
                if (amount < minOnceDonationCreditCard) {
                    $("#div-errors-price").html("Valor mínimo para contribuição em cartão de crédito é de R$ " + minOnceDonationCreditCard).slideDown('fast').effect("shake");
                    $('.option-default-' + type).trigger('click');
                    $(el).focus();
                    return
                }
                break;
            case "bank_slip":
                if (amount < minOnceDonationBankSlip) {
                    $("#div-errors-price").html("Valor mínimo para contribuição em boleto bancário é de R$ " + minOnceDonationBankSlip).slideDown('fast').effect("shake");
                    $('.option-default-' + type).trigger('click');
                    $(el).focus();
                    return
                }
                break;
            case "Pix":
                if (amount < minOnceDonationPix) {
                    $("#div-errors-price").html("Valor mínimo para contribuição em PIX é de R$ " + minOnceDonationPix).slideDown('fast').effect("shake");
                    $('.option-default-' + type).trigger('click');
                    $(el).focus();
                    return
                }
                break;
        }
        $("#div-errors-price").slideUp('fast');



        $('#donation-' + type + '-group button').addClass('btn-outline-dark').removeClass('active');
        $(el).css('background-color', '#FFC107');

        if (showAddOnFee) {
            $("#div-add-on-fee").slideDown();

            let feeAmount = 0;

            switch (selectedPayment) {
                case "credit_card":
                    feeAmount = config.addOnFeeValues.creditCard.fix;
                    feeAmount += amount * (config.addOnFeeValues.creditCard.percent / 100);
                    break;
                case "bank_slip":
                    feeAmount = config.addOnFeeValues.bankSlip.fix;
                    feeAmount += amount * (config.addOnFeeValues.bankSlip.percent / 100);
                    break;
                case "Pix":
                    feeAmount = config.addOnFeeValues.pix.fix;
                    feeAmount += amount * (config.addOnFeeValues.pix.percent / 100);
                    break;
            }

            $("#div-add-on-fee label").html("Adicione + <strong>R$ " + feeAmount.toFixed(2) + "</strong> para cobrir as tarifas bancárias");


            if ($('#field-add-on-fee').is(':checked')) {
                amount += feeAmount;
            }

        }
        else {
            $("#div-add-on-fee").slideUp();
        }



        //amount = amount/100

        switch (type) {
            case "monthly":
                $(".button-confirm-payment").text("Contribuir com R$ " + amount.toFixed(2) + " por mês");
                break;
            case "yearly":
                $(".button-confirm-payment").text("Contribuir com R$ " + amount.toFixed(2) + " por ano");
                break;
            case "once":
                $(".button-confirm-payment").text("Contribuir com R$ " + amount.toFixed(2));
                break;
        }
        donationPeriodicity = type;
        donationAmount = amount;


    }
    else {
        $(el).next().html("OUTRO<br/>VALOR");
        $('.option-default-' + type).trigger('click');
    }
}
function setPaymentMethod(paymentMethod) {
    switch (paymentMethod) {
        case "credit_card":
            $("#credit-card-fields").slideDown();
            break;
        case "bank_slip":
        case "Pix":
            $("#credit-card-fields").slideUp();
            break;
        // case "Pix":
        //     $("#credit-card-fields").slideUp();
        // break;
    }
    if (lastDonationButtonClicked != null) $(lastDonationButtonClicked).trigger('click').trigger('blur');

    selectedPayment = paymentMethod;
}
function getCepData() {
    let cep = $('#field-zipcode').val();
    cep = cep.replace(/\D/g, "");
    if (cep.length < 8) {
        $("#div-errors-price").html("CEP deve conter no mínimo 8 dígitos").slideDown('fast').effect("shake");
        $("#field-zipcode").addClass('is-invalid').focus();
        return;
    }
    $("#field-zipcode").removeClass('is-invalid');
    $("#div-errors-price").slideUp('fast');


    if (cep != "") {
        $("#field-street").val("Carregando...");
        $("#field-district").val("Carregando...");
        $("#field-city").val("Carregando...");
        $("#field-state").val("...");
        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/", function (data) {
            $("#field-street").val(data.logradouro);
            $("#field-district").val(data.bairro);
            $("#field-city").val(data.localidade);
            $("#field-state").val(data.uf);
            $("#field-street-number").focus();

        }).fail(function () {
            $("#field-street").val("");
            $("#field-district").val("");
            $("#field-city").val("");
            $("#field-state").val(" ");
        });
    }
}

function flowProces(token) {

    if (window.inPaymentFlow === true) {
        return;
    }

    window.inPaymentFlow = true;

    if (selectedPayment === "credit_card" && token.length > 0) {
        getCreditCardToken(token);
    }
    else {
        subscription("", token);
    }

    window.inPaymentFlow = false;
}
//Codigo novo

//Codigo antigo

// function getCreditCardToken(cap_token)
// {
//     if(!validateFields()) return;

//     let obj                 = {};
//     obj.card_cvv            = $("#field-card-cvc").val();
//     obj.card_expiration     = $("#field-card-expiration").val();
//     obj.card_number         = $("#field-card-number").val();
//     obj.holder_name         = $("#field-name").val()+" "+$("#field-surname").val();
//     obj.payment_method_code = "credit_card";
//     obj.registry_code       = $("#field-cpf").val();

//     $.ajax({
//         type: "POST",
//         url: "https://sandbox.asaas.com/api/v3/payments",
//         dataType: "json",
//         headers: { "Authorization": "Basic " + btoa("$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNTczMDU6OiRhYWNoXzUwNDliOTg5LTUxZGItNDRmZS1hNDcwLTljOGJmODdmOWYxOQ==" + ":") },
//         data: obj,
//         success:function(data)
//         {
//             //alert(data.payment_profile.gateway_token);
//             subscription(data.payment_profile.gateway_token, cap_token)
//         },
//         error: function(request, status, error)
//         {
//             console.log(error);
//             console.log(request.responseText);
//             $("#div-errors-price").html("Erro ao cadastrar perfil de pagamento").slideDown('fast').effect( "shake" );
//         }
//     });
// }

// function subscription(gateway_token, cap_token)
// {
//     if(!validateFields()) return;

//     let obj                 = {};
//     obj.amount              = donationAmount;
//     obj.addressCountry      = $("#field-country").val();
//     obj.addressState        = $("#field-state").val();
//     obj.addressCity         = $("#field-city").val();
//     obj.addressStreet       = $("#field-street").val();
//     obj.addressDistrict     = $("#field-district").val();
//     obj.addressStreetNumber = $("#field-street-number").val();
//     obj.addressComplement   = $("#field-complement").val();
//     obj.addressZipCode      = $("#field-zipcode").val();
//     obj.email               = $("#field-email").val();
//     obj.customerName        = $("#field-name").val();
//     obj.customerSurname     = $("#field-surname").val();
//     obj.paymentMethod       = selectedPayment;
//     obj.recurringPeriod     = donationPeriodicity;
//     obj.taxpayerId          = $("#field-cpf").val();
//     obj.gatewayToken        = gateway_token;
//     obj.capToken            = cap_token;
//     obj.metadata            = {
//         'source': $( '#field-source' ).val(),
//         'source_url': $( '#field-source-url' ).val(),
//         'source_id': $( '#field-source-id' ).val(),
//     };

//     //let tmp = $(".button-confirm-payment").html();
//     $(".progress-subscription").addClass('d-flex').removeClass('d-none');
//     $(".button-confirm-payment").addClass('d-none').removeClass('d-block');

//     //Pegar method
//     var typePayment = $('input[name="payment"]:checked').val();
//     localStorage.setItem("method", typePayment);
//     method = localStorage.getItem("method");

//     $.ajax({
//         url: "/back-end/subscription.php",
//         method: 'POST',
//         data: {method: method, params: btoa($(this).serialize())},
//         dataType: 'JSON',
//         success:function(data)
//         {
//             $(".progress-subscription").addClass('d-none').removeClass('d-flex');
//             $(".button-confirm-payment").addClass('d-block').removeClass('d-none');
//             printPaymentData(data);
//         },
//         error: function(request, status, error)
//         {
//             var error = JSON.parse(request.responseText);
//             var error_msg = 'Erro efetuar a contribuição';

//             if ( error && error.bill.charges.length > 0 ) {
//                 var charge = error.bill.charges[0];
//                 if ( charge.status == 'pending' ) {
//                     error_msg = charge.last_transaction.gateway_message
//                 }

//             }

//             $(".progress-subscription").addClass('d-none').removeClass('d-flex');
//             $(".button-confirm-payment").addClass('d-block').removeClass('d-none');
//             $("#div-errors-price").text(error_msg).slideDown('fast').effect( "shake" );
//         }
//     });
// }

function validateFields() {

    if ($("#field-email").val() == "") {
        $("#div-errors-price").html("Informe o E-mail").slideDown('fast').effect("shake");
        $("#field-email").addClass('is-invalid').focus();
        return false;
    }
    if (isValidEmail($("#field-email").val()) == false) {
        $("#div-errors-price").html("E-mail inválido").slideDown('fast').effect("shake");
        $("#field-email").addClass('is-invalid').focus();
        return false;
    }
    $("#field-email").removeClass('is-invalid');
    if ($("#field-name").val() == "") {
        $("#div-errors-price").html("Informe o nome").slideDown('fast').effect("shake");
        $("#field-name").addClass('is-invalid').focus();
        return false;
    }
    $("#field-name").removeClass('is-invalid');
    if ($("#field-surname").val() == "") {
        $("#div-errors-price").html("Informe o sobrenome").slideDown('fast').effect("shake");
        $("#field-surname").addClass('is-invalid').focus();
        return false;
    }
    $("#field-surname").removeClass('is-invalid');
    if ($('#is_foreigner').is(':checked') === false)//sOU ESTRANGEIRO
    {
        if ($("#field-cpf").val() == "") {
            $("#div-errors-price").html("Informe o CPF").slideDown('fast').effect("shake");
            $("#field-cpf").addClass('is-invalid').focus();
            return false;
        }

        if (isValidCPF($("#field-cpf").val()) == false) {
            $("#div-errors-price").html("CPF inválido").slideDown('fast').effect("shake");
            $("#field-cpf").addClass('is-invalid').focus();
            return false;
        }
    }
    $("#field-cpf").removeClass('is-invalid');

    if (selectedPayment === 'credit_card') {
        if ($("#field-card-number").val() == "") {
            $("#div-errors-price").html("Informe o número do cartão").slideDown('fast').effect("shake");
            $("#field-card-number").addClass('is-invalid').focus();
            return false;
        }
        $("#field-card-number").removeClass('is-invalid');
        if ($("#field-card-expiration").val() == "") {
            $("#div-errors-price").html("Informe a data de expiração").slideDown('fast').effect("shake");
            $("#field-card-expiration").addClass('is-invalid').focus();
            return false;
        }
        $("#field-card-expiration").removeClass('is-invalid');
        if ($("#field-card-cvc").val() == "") {
            $("#div-errors-price").html("Informe o código CVC").slideDown('fast').effect("shake");
            $("#field-card-cvc").addClass('is-invalid').focus();
            return false;
        }
        $("#field-card-cvc").removeClass('is-invalid');
    }
    else {//Endereço é obrigatório
        if ($("#field-country").val() == "") {
            $("#div-errors-price").html("Selecione o país").slideDown('fast').effect("shake");
            $("#field-country").addClass('is-invalid').focus();
            return false;
        }
        $("#field-country").removeClass('is-invalid');
        if ($("#field-zipcode").val() == "") {
            $("#div-errors-price").html("Informe o CEP").slideDown('fast').effect("shake");
            $("#field-zipcode").addClass('is-invalid').focus();
            return false;
        }
        cep = $("#field-zipcode").val().replace(/\D/g, "");
        if (cep.length < 8) {
            $("#div-errors-price").html("CEP deve conter no mínimo 8 dígitos").slideDown('fast').effect("shake");
            $("#field-zipcode").addClass('is-invalid').focus();
            return false;
        }
        $("#field-zipcode").removeClass('is-invalid');

        if ($("#field-street").val() == "") {
            $("#div-errors-price").html("Informe a rua").slideDown('fast').effect("shake");
            $("#field-street").addClass('is-invalid').focus();
            return false;
        }
        $("#field-street").removeClass('is-invalid');
        if ($("#field-street-number").val() == "") {
            $("#div-errors-price").html("Informe o número da casa").slideDown('fast').effect("shake");
            $("#field-street-number").addClass('is-invalid').focus();
            return false;
        }
        $("#field-street-number").removeClass('is-invalid');
        if ($("#field-district").val() == "") {
            $("#div-errors-price").html("Informe o bairro").slideDown('fast').effect("shake");
            $("#field-district").addClass('is-invalid').focus();
            return false;
        }
        $("#field-district").removeClass('is-invalid');
        if ($("#field-city").val() == "") {
            $("#div-errors-price").html("Informe a cidade").slideDown('fast').effect("shake");
            $("#field-city").addClass('is-invalid').focus();
            return false;
        }
        $("#field-city").removeClass('is-invalid');
        if ($("#field-state").val() == "") {
            $("#div-errors-price").html("Selecione o estado").slideDown('fast').effect("shake");
            $("#field-state").addClass('is-invalid').focus();
            return false;
        }
        $("#field-state").removeClass('is-invalid');
    }



    $("#div-errors-price").slideUp('fast');
    return true;
}

function printPaymentData(data) {
    $("#highlight").html("Muito obrigado!");

    let html = "<p class='text-block2'>Sua doação estímulo a continuar nosso trabalho pela construção de um mundo melhor</p>";

    switch (data.forma_pagamento) {
        case "BOLETO":
            html += "<strong>Vencimento:</strong> " + data.data_vencimento + "<br/>";
            html += "<div class='row'><div class='col-md-12 p-3 mb-3 border text-center fw-bold text-muted' id='bank-slip-bars'><img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data=" + data.boleto_barCode + "&code=Code128&translate-esc=on'/></div>";
            html += "<strong>Linha digitável do boleto</strong><br/>";
            html += "<div class='row'><div class='col-md-12 p-3 mb-3 border text-center fw-bold text-muted' id='bank-slip-code'>" + mascaraCodigoBoleto(data.boleto_identificationField) + "</div></div>";
            html += "<div class='row'>";
            html += "    <div class='col-md-6 text-center'><a href='" + data.link_boleto + "' target='_blank' class='btn btn-lg btn-light w-100'>Download PDF</a></div>";
            html += "    <div class='col-md-6 text-center'><a href=\"javascript:copyToClipboard('#bank-slip-code')\" class='btn btn-lg active  w-100'>Copiar código</a></div>";
            html += "</div>";
            break;
        case "CREDIT_CARD":
            html += "<div class='row'><div class='col-md-12 p-3 mb-3 border text-center fw-bold text-muted'>A contribuição está sendo processada, logo você receberá um e-mail com a confirmação.</div></div>";
            break;
        case "PIX":
            html += "<strong>Expiração:</strong> " + data.pix_expirationDate + "<br/>";
            html += "<div class='row'><div class='col-md-12 p-3 mb-3 border text-center fw-bold text-muted d-flex justify-content-center' id='pix-qrcode'><img src='data:image/png;base64," + data.pix_encodedImage + "' class='img-fluid' /></div></div>";
            html += "<strong>Código Pix</strong><br/>";
            html += "<div class='row'><div class='col-md-12 p-3 mb-3 border text-center fw-bold text-muted' id='pix-qrcode-code' style='white-space: pre-wrap;word-break: break-word;'>" + data.pix_payload + "</div></div>";
            html += "<div class='row'>";
            html += "    <div class='col-md-6 text-center'><a href='data:image/png;base64," + data.pix_encodedImage + "' target='_blank' class='btn btn-lg btn-light w-100'>Abrir QRCode</a></div>";
            html += "    <div class='col-md-6 text-center'><a href=\"javascript:copyToClipboard('#pix-qrcode-code')\" class='btn btn-lg active  w-100'>Copia e cola</a></div>";
            html += "</div>";
            break;

    }

    //data.bill.charges[0].last_transaction.gateway_response_fields.print_url
    //data.bill.charges[0].last_transaction.gateway_response_fields.typeable_barcode
    $("#div-container-form").html(html);
}
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}
function isValidCPF(strCPF) {
    strCPF = strCPF.replace(/\D/g, "");
    let sumMod;
    let modRest;
    sumMod = 0;
    if (
        strCPF == "00000000000"
        || strCPF == "11111111111"
        || strCPF == "22222222222"
        || strCPF == "33333333333"
        || strCPF == "44444444444"
        || strCPF == "55555555555"
        || strCPF == "66666666666"
        || strCPF == "77777777777"
        || strCPF == "88888888888"
        || strCPF == "99999999999"
    ) return false;

    for (i = 1; i <= 9; i++) sumMod = sumMod + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    modRest = (sumMod * 10) % 11;

    if ((modRest == 10) || (modRest == 11)) modRest = 0;
    if (modRest != parseInt(strCPF.substring(9, 10))) return false;

    sumMod = 0;
    for (i = 1; i <= 10; i++) sumMod = sumMod + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    modRest = (sumMod * 10) % 11;

    if ((modRest == 10) || (modRest == 11)) modRest = 0;
    if (modRest != parseInt(strCPF.substring(10, 11))) return false;
    return true;
}
document.addEventListener('DOMContentLoaded', function () {
    var phoneInput = document.getElementById('field-phone');

    phoneInput.addEventListener('input', function () {
        var phoneNumber = this.value.replace(/\D/g, ""); // Remove caracteres não numéricos

        var formattedPhoneNumber = "";

        if (phoneNumber.length > 0) {
            // Formato: (XX) XXXX-XXXX
            formattedPhoneNumber += "(" + phoneNumber.substring(0, 2) + ")";
        }
        if (phoneNumber.length > 2) {
            formattedPhoneNumber += " " + phoneNumber.substring(2, 7);
        }
        if (phoneNumber.length > 7) {
            formattedPhoneNumber += "-" + phoneNumber.substring(7, 11);
        }

        this.value = formattedPhoneNumber;
    });
});
function isValidEmail(input) {
    return String(input).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) != null;
}
function mascaraCodigoBoleto(codigo) {
    // Remover todos os caracteres não numéricos
    codigo = codigo.replace(/\D/g, '');

    // Aplicar a máscara
    codigo = codigo.replace(/(\d{5})(\d{5})(\d{5})(\d{6})(\d{5})(\d{14})/, '$1.$2 $3.$4 $5.$6');

    return codigo;
}
