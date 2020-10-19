

//home
//oneproduct.html.twig
$("#oneproduct button.addproductincarte").click(function(e){
    let productid = $(this).attr("data-id");
    $.get(
        "/panier/addoneproduct/"+productid,
        function (response) {
            $("#nav1 #carte #total").html(response);
        }
    );

});