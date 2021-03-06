$( document ).ready(function() {
    $('img.loupe').loupe({
        width: "60%", // width of magnifier
        height: 400, // height of magnifier
        loupe: 'loupe' // css class for magnifier
      });

      $('#adminallusers table').DataTable();
});


//base.html.twig
$("#bigimg").click(function(e){
    $("#bigimg").addClass("d-none");
    $("#bigimg img").attr("src","");
});


//carte
//index.html.twig
$("#carte input.modifyquantity").change(function(e){
    let productid = $(this).attr("data-id");
    let value = $(this).val();
    if(value < 1 || value == ""){
        value = 1;
        $(this).val(value);
    }
    let _this = $(this);
    $("#loader").removeClass("d-none");
    $.get(
        "/panier/updatequantity/"+productid + "_" + value,
        function (response) {
            _this.val(response[0]);
            $("#carte #total2").html(response[1]);
            $("#loader").addClass("d-none");
        }
    );

});


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

$("#oneproduct form[name='comment']").submit(function(e){
    e.preventDefault();
    var formSerialize = $(this).serialize();
    var productid = $("#oneproduct .productid").attr("data-id");
    $.post(
            "/addcommenttoproduct/"+productid,
            formSerialize,
            function (response) {
                $("#oneproduct textarea#comment_message").val("");
                $("#oneproduct #allcomments").prepend(response);
            }
    );
});


$("#oneproduct img.showbigimg").click(function(e){
    let url = $(this).attr("src");
    $("#bigimg img").attr("src",url);
    $("#bigimg").removeClass("d-none");
});

//user
//mycommands.html.twig
$("#commands .allmycommands .onecommand .title").click(function(e){
    let check = $(this).next().hasClass("d-none");
    $("#commands .allmycommands .onecommand .content").addClass("d-none");
    if(check)$(this).next().removeClass("d-none");
    else $(this).next().addClass("d-none");
});



//espace personnel - admin
$("#espacemainnav2 .openespacemainnav").click(function(e){
    $(".espacep .espacenav").removeClass("d-none");
});
$("#espacemainnav .closeespacemainnav").click(function(e){
    $(".espacep .espacenav").addClass("d-none");
});

//allcommands.html.twig
$("#adminallcommands button.showonecommand").click(function(e){
    let commandid = $(this).attr("data-id");
    $.get(
        "/admin/user/showonecommand/"+commandid,
        function (response) {
            $('#adminallcommands .modal .modal-body').html(response);
            $('#adminallcommands .modal').modal('show')
        }
    );
});


//modifyproduct.html.twig
let allfiles = [];
$("#adminmodifyproduct input.thefile").change(function(e){
    if (e.target.files && e.target.files[0]) {
        for(let i = 0; i < e.target.files.length; i++) {
            //lire le contenu de fichiers de façon asynchrone
            var reader = new FileReader();
            reader.onload = function (e) {
                //console.log(e.target.result);
                let div = "<div class='col-6 col-md-3 col-lg-2 mb-2'><img src='"+e.target.result+"' alt=''></div>"
                $("#adminmodifyproduct .bloc3 .row").append(div);
                //$("form[name='userpersocv']").find("img").attr("src",e.target.result);
                //$("form[name='userpersocv']").find(".showphoto").removeClass("d-none");
            }
            //démarrer la lecture du contenu pour le blob indiqué
            reader.readAsDataURL(e.target.files[i]);
        }
    }
});

$("#adminmodifyproduct .deleteonephoto").click(function(e){
    let photoid = $(this).attr("data-id");
    let parent = $(this).parent().parent();
    $.get(
        "/admin/product/deleteonephoto/"+photoid,
        function (response) {
            if(response == 1)parent.remove();
        }
    );
});

$(".testemail").click(function(e){
    $.get(
        "/admin/user/testemail",
        function (response) {
            if(response == 1)alert("Your email is sent");
        }
    );
});