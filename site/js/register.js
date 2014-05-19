var receipt = {};

function redrawRegister (){
    $('#receiptProducts').html('');
    $('#receiptTotal').html('');
    var totalReceiptPrice = 0.0;
    if(Object.keys(receipt).length > 0){
        for (receiptProductKey in receipt) {
            $('#receiptProducts').append('<li class="product"><span class="label">' + receipt[receiptProductKey]['label'] + '</span><span class="price">&euro;' + parseFloat(receipt[receiptProductKey]['price']).toFixed(2) + '</span><span class="amount">' + receipt[receiptProductKey]['amount'] + '</span><span class="price total">&euro;' + parseFloat((receipt[receiptProductKey]['price'] * receipt[receiptProductKey]['amount'])).toFixed(2) + '</span><a class="remove" onclick="removeSingleProductFromRegister(\'' + receiptProductKey + '\')">-1</a></li>');
            totalReceiptPrice = totalReceiptPrice + (parseFloat(receipt[receiptProductKey]['price'] * parseInt(receipt[receiptProductKey]['amount'])));
        }
        $('#receiptProducts').append('<li class="button"><a onclick="registerCheckout()">Afrekenen</a></li>');
    }
    $('#receiptTotal').html('&euro;' + totalReceiptPrice.toFixed(2));
}

function addProductToRegister (productId){
    $.getJSON("helpers/jsonHelper.php?f=getProduct&p=" + productId, function(json) {
        if(Object.keys(json).length > 0){
            if(receipt.hasOwnProperty(productId)){
                receipt[productId]['amount'] = parseInt(receipt[productId]['amount']) + 1;
            }else{
                receipt[productId] = {};
                receipt[productId]['label'] = json['label'];
                receipt[productId]['price'] = json['price'];
                receipt[productId]['amount'] = 1;
            }
        }
        redrawRegister();
    });
}

function removeSingleProductFromRegister(productId){
    if(receipt.hasOwnProperty(productId)){
        if(receipt[productId]['amount'] > 1){
            receipt[productId]['amount'] = parseInt(receipt[productId]['amount']) - 1;
        }else{
            delete receipt[productId];
        }
    }
    redrawRegister();
}

function exitRegisterWarning(){
    if(Object.keys(receipt).length > 0){
        return "Je verlaat de kassa met producten op de rekening.";
    }
}
window.onbeforeunload = exitRegisterWarning;

function registerCheckout(){
    $('#receiptForm').html("");
    if(Object.keys(receipt).length > 0){
        for (receiptProductKey in receipt) {
            $('#receiptForm').append('<input name="products[' + receiptProductKey + ']" value="' + receipt[receiptProductKey]['amount'] + '" />');
        }
        receipt = {};
        document.getElementById("receiptForm").submit();
    }
}