$(document).ready(function () {
    $('.increment-btn').click(function (e) {
        e.preventDefault();
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $('.decrement-btn').click(function (e) {
        e.preventDefault();
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 0) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });
    $('.AddToCart-btn').click(function (e) { 
        e.preventDefault();
            var qty = $(this).closest('.product_data').find('.input-qty').val();
            var prod_id = $(this).val();
            $.ajax({
            method: "POST",
            url: "function/handlecart.php",
            data: {
            "prod_id": prod_id,
            "prod_qty": qty,
            "scope": "add"
            },
            dataType: "dataType",
            success: function (response) {
                console.log(response);
                if(response==201){
                    alert("Product added to cart");
                }
                else if(response=="existing"){
                    alert("Product already in cart");
                }
                else if(response==401){
                    alert("login to continue");
                }
                else if(response==500){
                    alert("Something went wrong");
                }
            }
            });
            });
    $(document).on('click','.updateQty', function(){
        var qty= $(this).closest('.product_data').find('.input-qty').val(); 
        var prod_id= $(this).closest('.product_data').find('.prodId').val();
        console.log("ok");
        $.ajax({
                    method: "POST",
                    url: "function/handlecart.php",
                    data: {
                    "prod_id": prod_id,
                    "prod_qty": qty,
                    "scope": "update"
                    
                    },
                    
                    success: function (response) {
                        
                        if (response == 200) {
                            alert("Cart updated successfully");
                            location.reload();
                        } else {
                            alert("Failed to update cart: " + response);
                        }
                    }
                });
    });
    $(document).on('click', '.deleteItem', function () {
    var cart_id = $(this).val();
    $.ajax({
        method: "POST",
        url: "function/handlecart.php",
        data: {
            "cart_id": cart_id,
            "scope": "delete"
        },
        success: function (response) {
            if (response == 200) {
                alert("Item deleted successfully");
                location.reload();
            } else {
                alert(response);
            }
        }
    });
});

});

