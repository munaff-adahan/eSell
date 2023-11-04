function changeView() {

    var signInBox = document.getElementById("signInBox");

    var signUpBox = document.getElementById("signUpBox");


    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");

}


function signUp() {

    var signUpError = document.getElementById("signUpError");


    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var SignUpForm = new FormData();

    SignUpForm.append("fname", fname.value);
    SignUpForm.append("lname", lname.value);
    SignUpForm.append("email", email.value);
    SignUpForm.append("password", password.value);
    SignUpForm.append("mobile", mobile.value);
    SignUpForm.append("gender", gender.value);

    var SignUpRequest = new XMLHttpRequest();
    SignUpRequest.onreadystatechange = function() {

        if (SignUpRequest.readyState == 4) {

            var SignUpResponse = SignUpRequest.responseText;



            if (SignUpResponse == "SignUp Success") {

                signUpError.innerHTML = "";

                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                changeView();


            } else {

                signUpError.innerHTML = SignUpResponse;

            }

        }



    };




    SignUpRequest.open("POST", "sign_up_process.php", true);
    SignUpRequest.send(SignUpForm);


}


function SignIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");

    var remember = document.getElementById("remember");


    var SignInForm = new FormData();
    SignInForm.append("email", email.value);
    SignInForm.append("password", password.value);
    SignInForm.append("remember", remember.checked);

    var SignInRequest = new XMLHttpRequest();
    SignInRequest.onreadystatechange = function() {
        if (SignInRequest.readyState == 4) {

            var SignInResponse = SignInRequest.responseText;

            if (SignInResponse == "Success") {

                window.location = "home.php";



            } else {

                document.getElementById("signInError").innerHTML = SignInResponse;



            }






        }









    };







    SignInRequest.open("POST", "login_process.php", true);
    SignInRequest.send(SignInForm);




}

var bootstrapModalForgot;

function forgot_password() {

    var email = document.getElementById("email2");


    var forgotRequest = new XMLHttpRequest();
    forgotRequest.onreadystatechange = function() {
        if (forgotRequest.readyState == 4) {

            var forgotResponse = forgotRequest.responseText;

            if (forgotResponse == "Success.") {

                alert("Password reset verification code is sent to your email please check your inbox.");

                var forgotModal = document.getElementById("resetPasswordModal");
                bootstrapModalForgot = new bootstrap.Modal(forgotModal);
                bootstrapModalForgot.show();

            } else {



                alert(forgotResponse);



            }

        }








    };





    forgotRequest.open("GET", "forgot_process.php?email=" + email.value, true);
    forgotRequest.send();






}


function ResetPassword() {

    var email = document.getElementById("email2");
    var new_password = document.getElementById("new-password");
    var confirm_password = document.getElementById("confirm-password");
    var verification_code = document.getElementById("verification_code");

    var ResetForm = new FormData();
    ResetForm.append("email", email.value);
    ResetForm.append("new_password", new_password.value);
    ResetForm.append("confirm_password", confirm_password.value);
    ResetForm.append("verification_code", verification_code.value);


    var ResetRequest = new XMLHttpRequest();
    ResetRequest.onreadystatechange = function() {
        if (ResetRequest.readyState == 4) {

            var ResetResponse = ResetRequest.responseText;

            alert(ResetResponse);

            if (ResetResponse == "Success") {

                bootstrapModalForgot.hide();

            }






        }







    };






    ResetRequest.open("POST", "reset_pass_process.php", true);
    ResetRequest.send(ResetForm);






}





function goToAddProduct() {

    window.location = "add-product.php";



}

function change_img() {




    var file_chooser = document.getElementById("upload_image");

    var perview_img = document.getElementById("img_preview");




    file_chooser.onchange = function() {

        var file = this.files[0];

        var url = window.URL.createObjectURL(file);

        perview_img.src = url;

    };




}

function add_product() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var product_title = document.getElementById("product_title");


    var condition = "";


    if (document.getElementById("condition1").checked) {

        condition = 1;



    } else if (document.getElementById("condition2").checked) {

        condition = 2;



    }

    var colour_length = document.getElementsByName("colour_add_produ").length;




    var colour = "";

    for (var colour_count = 1; colour_count <= colour_length; colour_count++) {




        if (document.getElementById("color" + colour_count).checked) {

            colour = colour_count;




        }



    }




    var qty = document.getElementById("qty");
    var cost_p_i = document.getElementById("cost_p_i");
    var pwc = document.getElementById("pwc");
    var poc = document.getElementById("poc");
    var description = document.getElementById("description");
    var upload_image = document.getElementById("upload_image");




    var form = new FormData();

    form.append("category", category.value);
    form.append("brand", brand.value);
    form.append("model", model.value);
    form.append("product_title", product_title.value);
    form.append("condition", condition);
    form.append("colour", colour);
    form.append("qty", qty.value);
    form.append("cost_p_i", cost_p_i.value);
    form.append("pwc", pwc.value);
    form.append("poc", poc.value);
    form.append("description", description.value);


    for (var upload_image_count = 0; upload_image_count < upload_image.files.length; upload_image_count++) {


        form.append("upload_image" + upload_image_count, upload_image.files[upload_image_count]);


    }
    form.append("upload_image_length", upload_image.files.length);

    var productListError = document.getElementById("productListError");

    var productListsuccess = document.getElementById("productListsuccess");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;

            if (response != "Product added successfully!") {
                productListError.innerHTML = response;

                productListsuccess.innerHTML = "";

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })


            } else {

                swal("The product has been successfully added after the admin approves the product you will get an email!", {
                    icon: "success",
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location = "add-product.php";

                    }
                });


                productListsuccess.innerHTML = response;
                productListError.innerHTML = "";
            }




        }







    };


    request.open("POST", "add_product_process.php", true);
    request.send(form);





}


function SignOut() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;

            window.location = "home.php";




        }






    };

    request.open("POST", "logout.php", true);
    request.send();

}

function goToIndex() {

    window.location = "index.php";


}



function change_img_profile() {




    var file_chooser = document.getElementById("profile_img_selector");

    var perview_img = document.getElementById("img_pro_prev");




    file_chooser.onchange = function() {

        var file = this.files[0];

        var url = window.URL.createObjectURL(file);

        perview_img.src = url;

    };




}

function update_profile() {


    var profile_img_selector = document.getElementById("profile_img_selector");
    var first_name = document.getElementById("first_name_regis");
    var last_name = document.getElementById("last_name_regis");
    var mobile = document.getElementById("mobile_regis");
    var address_line_1 = document.getElementById("address_line_1");
    var address_line2 = document.getElementById("address_line2");
    var city_pro = document.getElementById("city_pro");

    var updateProfiletError = document.getElementById("updateProfiletError");


    var profile_form = new FormData();
    profile_form.append("profile_img_selector", profile_img_selector.files[0]);
    profile_form.append("first_name", first_name.value);
    profile_form.append("last_name", last_name.value);
    profile_form.append("mobile", mobile.value);
    profile_form.append("address_line_1", address_line_1.value);
    profile_form.append("address_line2", address_line2.value);
    profile_form.append("city_pro", city_pro.value);


    var profile_resquest = new XMLHttpRequest();
    profile_resquest.onreadystatechange = function() {


        if (profile_resquest.readyState == 4) {


            var profile_response = profile_resquest.responseText;


            if (profile_response == "Success") {

                swal({
                    title: "Profile successfully updated!",
                    icon: "success",
                    button: "OK",
                });

            } else {

                swal({
                    title: profile_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })

            }





        }



    };


    profile_resquest.open("POST", "update_pro_process.php", true);
    profile_resquest.send(profile_form);


}


function search(page) {




    var search_txt = document.getElementById("search_txt_basic").value;
    var search_filter = document.getElementById("search_filter").value;

    var search_request = new XMLHttpRequest();
    search_request.onreadystatechange = function() {


        if (search_request.readyState == 4) {

            var search_response = search_request.responseText;





            document.getElementById("search_result_basic_box").innerHTML = search_response;







        }






    };

    search_request.open("GET", "search_result.php?search_txt=" + search_txt + "&search_filter=" + search_filter + "&p=" + page, true);
    search_request.send();





}



function filterProduct() {

    var search = document.getElementById("search_fil");
    var age1 = document.getElementById("age1_fil");
    var age2 = document.getElementById("age2_fil");
    var qty1 = document.getElementById("qty1_fil");
    var qty2 = document.getElementById("qty2_fil");
    var condition1 = document.getElementById("condition1_fil");
    var condition2 = document.getElementById("condition2_fil");

    var age = "";

    if (age1.checked) {

        age = 1;


    } else if (age2.checked) {

        age = 2;


    }


    var qty = "";

    if (qty1.checked) {

        qty = 1;


    } else if (qty2.checked) {

        qty = 2;


    }




    var condition = "";

    if (condition1.checked) {

        condition = 1;


    } else if (condition2.checked) {

        condition = 2;


    }

    var form = new FormData();
    form.append("search", search.value);
    form.append("age", age);
    form.append("qty", qty);
    form.append("condition", condition);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;

            if (response != "Please type the keyword.") {

                document.getElementById("product_box_fil").innerHTML = response;
            }

        }





    };


    request.open("POST", "filter_process.php", true);
    request.send(form);



}


function addToWhichlist(product_id) {


    var wichlist_form = new FormData();
    wichlist_form.append("product_id", product_id);

    var wichlist_request = new XMLHttpRequest();
    wichlist_request.onreadystatechange = function() {

        if (wichlist_request.readyState == 4) {

            var wichlist_response = wichlist_request.responseText;





            if (wichlist_response == "This product is already added to the watchlist !") {

                swal({
                    title: wichlist_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (wichlist_response == "First sign in!") {

                swal({
                    title: wichlist_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else {

                swal({
                    title: "Product successfully added to the watchlist!",
                    icon: "success",
                    button: "OK",
                }).then((willDelete) => {
                    if (willDelete) {

                        window.location = "watchlist.php";

                    }
                });


            }




        }






    };

    wichlist_request.open("POST", "add_watchlist_process.php", true);
    wichlist_request.send(wichlist_form);



}


function remove_from_watchlist(product_id) {

    var form = new FormData();
    form.append("product_id", product_id);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;

            window.location = "watchlist.php";



        }





    };


    request.open("POST", "watchlist_remove.php", true);
    request.send(form);


}

function search_watchlist() {


    var search_txt = document.getElementById("watchlist_search");


    var form = new FormData();

    form.append("search_txt", search_txt.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;


            document.getElementById("watch_product_box").innerHTML = response;



        }










    };




    request.open("POST", "watch_search.php", true);
    request.send(form);

}


function goToHome() {

    window.location = "home.php";


}



function change_img_update() {




    var file_chooser = document.getElementById("upload_image_update");

    var perview_img = document.getElementById("img_preview_update");




    file_chooser.onchange = function() {

        var file = this.files[0];

        var url = window.URL.createObjectURL(file);

        perview_img.src = url;

    };




}


function find_update_details() {








    var search_txt = document.getElementById("product_update_name");

    var category = document.getElementById("update_category");

    var brand = document.getElementById("update_brand");
    var model = document.getElementById("update_model");
    var product_title = document.getElementById("title_update");


    var condition = "";




    var qty = document.getElementById("qty_update");
    var cost_p_i = document.getElementById("cost_p_i_update");
    var pwc = document.getElementById("pwc_update");
    var poc = document.getElementById("poc_update");
    var description = document.getElementById("description_update");
    var upload_image = document.getElementById("upload_image_update");
    var img_preview_update = document.getElementById("img_preview_update");

    var form = new FormData();
    form.append("search_txt", search_txt.value);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {

            var response = request.responseText;



            if (response == "Invalid product.") {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })


            } else {


                var update_json = JSON.parse(response);

                category.value = update_json.category;
                brand.value = update_json.brand_name;
                model.value = update_json.model_name;
                product_title.value = update_json.title;
                qty.value = update_json.qty;
                cost_p_i.value = update_json.price;
                pwc.value = update_json.delivery_fee_colombo;
                poc.value = update_json.delivery_fee_other;
                description.value = update_json.description;
                img_preview_update.src = "product_images//" + update_json.product_img1;




                if (update_json.condition_id == 1) {


                    document.getElementById("condition1_update").checked = true;

                } else if (update_json.condition_id == 2) {


                    document.getElementById("condition2_update").checked = true;

                }


                document.getElementById("update_btn_product").onclick = function() {


                    update_product(update_json.id);





                };


                var colour_length = document.getElementsByName("colour_update_produ").length;


                for (var colour_count = 1; colour_count <= colour_length; colour_count++) {


                    if (update_json.color_id == colour_count) {


                        document.getElementById("color" + colour_count + "_update").checked = true;

                    }

                }




            }





        }





    };


    request.open("POST", "update_search.php", true)
    request.send(form);

}


function update_product(product_id) {


    var product_title = document.getElementById("title_update");
    var qty = document.getElementById("qty_update");
    var cost_p_i = document.getElementById("cost_p_i_update");
    var pwc = document.getElementById("pwc_update");
    var poc = document.getElementById("poc_update");
    var description = document.getElementById("description_update");
    var upload_image = document.getElementById("upload_image_update");



    var form = new FormData();



    form.append("product_id", product_id);
    form.append("product_title", product_title.value);
    form.append("qty", qty.value);
    form.append("cost_p_i", cost_p_i.value);
    form.append("pwc", pwc.value);
    form.append("poc", poc.value);
    form.append("description", description.value);
    form.append("upload_image", upload_image.files[0]);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {


        if (request.readyState == 4) {


            var response = request.responseText;


            if (response == "Product successfully updated!") {

                swal("Product successfully updated!", {
                    icon: "success",
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location = "update-product.php";

                    }
                });

            } else {


                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })
            }



        }







    };




    request.open("POST", "update_process.php", true);
    request.send(form);


}

function delete_prev(product_id, refresh_url) {


    swal({
            title: "Are you sure that you want to delete this product?",
            text: " If you click OK this product will be permanently deleted!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                delete_product(product_id, refresh_url);
                swal("Your product has been successfully deleted!", {
                    icon: "success",
                });
            }
        });




}

function delete_product(product_id, refresh_url) {


    var form = new FormData();
    form.append("product_id", product_id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {


        if (request.readyState == 4) {

            var response = request.responseText;



            if (response == "Invalid Product!") {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })

            } else {


                location.reload();

            }

        }



    };

    request.open("POST", "delete_pro_process.php", true);
    request.send(form);





}

function update_product_redirect() {


    window.location = "update-product.php";


}



function changeStatus(product_id) {




    var form = new FormData();
    form.append("product_id", product_id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;




            if (response == "Invalid Product!") {


                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })


            } else {

                var status_txt = document.getElementById("status_txt" + product_id);

                var json_status = JSON.parse(response);

                status_txt.innerHTML = json_status.status_txt;

            }




        }





    };


    request.open("POST", "status_process.php", true);
    request.send(form);


}




function clear_filter() {



    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;


            document.getElementById("product_box_fil").innerHTML = response;

            document.getElementById("search_fil").value = "";
            document.getElementById("age1_fil").checked = false;
            document.getElementById("age2_fil").checked = false;
            document.getElementById("qty1_fil").checked = false;
            document.getElementById("qty2_fil").checked = false;
            document.getElementById("condition1_fil").checked = false;
            document.getElementById("condition2_fil").checked = false;




        }





    };


    request.open("POST", "clear_filter.php", true);
    request.send();



}


function advanced_search(page) {


    var search_txt = document.getElementById("advanced_txt");
    var category = document.getElementById("category_ad");
    var brand = document.getElementById("brand_ad");
    var model = document.getElementById("model_ad");
    var condition = document.getElementById("condition_ad");
    var color = document.getElementById("color_ad");
    var price_from = document.getElementById("pri_fro");
    var price_to = document.getElementById("pri_to");


    var form = new FormData();

    form.append("search_txt", search_txt.value);
    form.append("p", page);
    form.append("category", category.value);
    form.append("brand", brand.value);
    form.append("model", model.value);
    form.append("condition", condition.value);
    form.append("color", color.value);
    form.append("price_from", price_from.value);
    form.append("price_to", price_to.value);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;


            document.getElementById("advanced_search_box").innerHTML = response;





        }




    };

    request.open("POST", "advanced_search_process.php", true);
    request.send(form);








}


function goToAdvanced() {


    window.location = "advanced-search.php";




}



function addToCart(product_id) {

    var qty = 0;

    if (document.getElementById("qty_selector" + product_id)) {

        qty = document.getElementById("qty_selector" + product_id).value;


    } else if (document.getElementById("buy_now_qty")) {

        qty = document.getElementById("buy_now_qty").value;



    } else if (document.getElementById("qty_selector_watch" + product_id)) {

        qty = document.getElementById("qty_selector_watch" + product_id).value;



    } else if (document.getElementById("qty_selector_advanced" + product_id)) {

        qty = document.getElementById("qty_selector_advanced" + product_id).value;



    }

    var cart_form = new FormData();
    cart_form.append("product_id", product_id);
    cart_form.append("qty", qty);

    var cart_request = new XMLHttpRequest();
    cart_request.onreadystatechange = function() {

        if (cart_request.readyState == 4) {

            var cart_response = cart_request.responseText;



            if (cart_response == "This product is already added to the cart !") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "First sign in!") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "Please enter a qty.") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "The  qty can't be greater than the product's qty.") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "The qty can't be less than 1.") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "success!") {

                swal({
                    title: "Product successfully added to the cart!",
                    icon: "success",
                    button: "OK",
                }).then((willDelete) => {
                    if (willDelete) {

                        window.location = "cart.php";

                    }
                });


            }




        }






    };

    cart_request.open("POST", "add_cart_process.php", true);
    cart_request.send(cart_form);




}

function addToCart2(product_id) {




    var qty = document.getElementById("qty_selector_single" + product_id).value;





    var cart_form = new FormData();
    cart_form.append("product_id", product_id);
    cart_form.append("qty", qty);

    var cart_request = new XMLHttpRequest();
    cart_request.onreadystatechange = function() {

        if (cart_request.readyState == 4) {

            var cart_response = cart_request.responseText;



            if (cart_response == "This product is already added to the cart !") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "First sign in!") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "Please enter a qty.") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "The  qty can't be greater than the product's qty.") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "The qty can't be less than 1.") {

                swal({
                    title: cart_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (cart_response == "success!") {

                swal({
                    title: "Product successfully added to the cart!",
                    icon: "success",
                    button: "OK",
                }).then((willDelete) => {
                    if (willDelete) {

                        window.location = "cart.php";

                    }
                });
            }




        }






    };

    cart_request.open("POST", "add_cart_process.php", true);
    cart_request.send(cart_form);






}


function remove_cart_product(product_id) {

    var form = new FormData();
    form.append("product_id", product_id);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;

            window.location = "cart.php";



        }





    };


    request.open("POST", "cart_remove.php", true);
    request.send(form);


}


function search_cart() {


    var search_txt = document.getElementById("cart_search");


    var form = new FormData();

    form.append("search_txt", search_txt.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;


            document.getElementById("cart_box").innerHTML = response;



        }










    };




    request.open("POST", "cart_search.php", true);
    request.send(form);

}


function chage_single(single_img) {


    var single_src = document.getElementById(single_img).src;


    document.getElementById("main_single").src = single_src;



}

function goToSingle(product_id) {



    if (document.getElementById("qty_selector" + product_id)) {

        var qty = document.getElementById("qty_selector" + product_id).value;


        if (qty != 1) {


            window.location = "view-product.php?product_id=" + product_id + "&qty=" + qty;

        } else {

            window.location = "view-product.php?product_id=" + product_id;

        }


    } else {

        window.location = "view-product.php?product_id=" + product_id;


    }


}


function buy_now(product_id, btn_id) {


    var qty = 1;

    if (document.getElementById("buy_now_qty")) {

        qty = document.getElementById("buy_now_qty").value;

    }





    var form = new FormData();
    form.append("product_id", product_id);
    form.append("qty", qty);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;



            if (response == "Sign In First!") {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (response == "Invalid Product.") {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (response == "The product is out of stock!") {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (response == "Please update your address first!") {

                swal({
                        title: "Please update your address first!",
                        text: " To update the address you will be redirected to the my profile page.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            window.location = "my-profile.php";

                        }
                    });


            } else if (response == "Please enter a qty.") {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (response == "The qty can't be greater the original qty.") {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (response == "The qty can't be less than 1.") {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else {






                var json_final = JSON.parse(response);



                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    create_invoice(orderId, json_final.email, json_final.total, json_final.price, qty, product_id);

                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1217851", // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/view-product.php?product_id=" + product_id, // Important
                    "cancel_url": "http://localhost/eshop/view-product.php?product_id=" + product_id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": json_final.order_id,
                    "items": json_final.title,
                    "amount": json_final.total,
                    "currency": "LKR",
                    "first_name": json_final.fname,
                    "last_name": json_final.lname,
                    "email": json_final.email,
                    "phone": json_final.mobile,
                    "address": json_final.address,
                    "city": json_final.district,
                    "country": "Sri Lanka",
                    "delivery_address": json_final.address,
                    "delivery_city": json_final.district,
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                document.getElementById(btn_id).onclick = function(e) {
                    payhere.startPayment(payment);
                };






            }





        }





    };


    request.open("POST", "buy_now_process.php", true);
    request.send(form);












}


function create_invoice(order_id, email, total_price, unit_price, qty, product_id) {







    var form = new FormData();
    form.append("order_id", order_id);
    form.append("email", email);
    form.append("total_price", total_price);
    form.append("unit_price", unit_price);
    form.append("qty", qty);
    form.append("product_id", product_id);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;



            window.location = "invoice.php?order_id=" + order_id;



        }





    };


    request.open("POST", "create_invoice_process.php", true);
    request.send(form);








}
var bootstrapModaladmin;

function admin_sign_in() {


    var email = document.getElementById("admin_email");

    var form = new FormData();
    form.append("email", email.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;


            if (response == "The signin verification verification code is sent to your email please check your inbox.") {




                var adminModal = document.getElementById("admin_signin_model");
                bootstrapModaladmin = new bootstrap.Modal(adminModal);
                bootstrapModaladmin.show();



            }


            alert(response);





        }





    };


    request.open("POST", "admin_sign_in_process.php", true);
    request.send(form);









}


function verify_admin() {


    var email = document.getElementById("admin_email");

    var verification_code = document.getElementById("verification_code_admin");

    var form = new FormData();
    form.append("email", email.value);
    form.append("verification_code", verification_code.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;


            if (response == "Success.") {



                window.location = "admin.php";



            }


            alert(response);





        }





    };


    request.open("POST", "admin_final_signin_process.php", true);
    request.send(form);







}

function goToCart() {

    window.location = "cart.php";


}

var bootstrapModalFeed;

function open_feedback_model(model_id) {

    var feedModal = document.getElementById("feedback_modal" + model_id);
    bootstrapModalFeed = new bootstrap.Modal(feedModal);
    bootstrapModalFeed.show();



}


function send_feedback(product_id, feedback_txt) {



    var feedback_txt = document.getElementById("feedback_txt" + feedback_txt).value;

    var form = new FormData();

    form.append("product_id", product_id);
    form.append("feedback_txt", feedback_txt);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;

            alert(response);


            if (response == "Feedback successfully made!") {


                bootstrapModalFeed.hide();

                feedback_txt.value = "";

            }


        }









    };


    request.open("POST", "feedback_process.php", true);
    request.send(form);


}



// sendmessage

function sendmessage(mail) {



    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                document.getElementById("msgtxt").value = "";

                alert("Message Sent Successfully");



            } else {
                alert("t");
            }
        }
    }

    r.open("POST", "sendmessageprocess.php", true);
    r.send(f);

}

// refresher


var mess_email;

function refresher(email) {

    mess_email = email;

    setInterval(refreshmsgare, 500);
    setInterval(refreshrecentarea, 500);
}

// refres msg view area

function refreshmsgare() {





    var chatrow = document.getElementById("chatrow");

    var f = new FormData();
    f.append("e", mess_email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            chatrow.innerHTML = t;

            // refresher(mail);

        }
    }

    r.open("POST", "refreshmsgareaprocess.php", true);
    r.send(f);

}

// refreshrecentarea

function refreshrecentarea() {

    var rcv = document.getElementById("rcv");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;
        }
    }

    r.open("POST", "refreshrecentareaprocess.php", true);
    r.send();

}


function goToChat(email) {

    window.location = "messages.php?email=" + email;

}

function status_change_product(product_id, btn_id) {

    var status_btn = document.getElementById("product_status_change" + btn_id);

    var form = new FormData();
    form.append("product_id", product_id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;

            if (response == "Blocked") {

                status_btn.className = "btn btn-success";
                status_btn.innerHTML = "Unblock";

            } else if (response == "Unblocked") {

                status_btn.className = "btn btn-danger";
                status_btn.innerHTML = "Block";

            }


        }







    };


    request.open("POST", "status_product_change.php", true);
    request.send(form);


}


function add_category() {


    var category_txt = document.getElementById("category_txt").value;

    var form = new FormData();

    form.append("category_txt", category_txt);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;




            if (response == "Category sucessfully added!") {

                document.getElementById("category_txt").value = "";



                paginate_category(1);

                swal("The category has been successfully added!", {
                    icon: "success",
                });


            } else {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            }




        }





    };

    request.open("POST", "add_category.php", true);
    request.send(form);



}


function status_change_user(email, btn_id) {




    var status_btn = document.getElementById("user_status_change" + btn_id);

    var form = new FormData();
    form.append("email", email);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;





            if (response == "Blocked") {

                status_btn.className = "btn btn-success";
                status_btn.innerHTML = "Unblock";

            } else if (response == "Unblocked") {

                status_btn.className = "btn btn-danger";
                status_btn.innerHTML = "Block";

            }


        }







    };


    request.open("POST", "status_user_change.php", true);
    request.send(form);

}

function fil_date_sell() {

    var from = document.getElementById("fil_f_date").value;
    var to = document.getElementById("fil_t_date").value;


    window.location = "selling-history.php?f=" + from + "&t=" + to;




}


function print_invoice() {

    var previous_body = document.body.innerHTML;

    var invoice = document.getElementById("invoice_box").innerHTML;

    document.body.innerHTML = invoice;

    window.print();

    document.body.innerHTML = previous_body;


}

function search_manage_product() {


    var search_txt = document.getElementById("searchtxt_manage_product").value;

    var form = new FormData();

    form.append("search_txt", search_txt);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;


            document.getElementById("m_p_box").innerHTML = response;

        }





    };

    request.open("POST", "search_manage_product.php", true);
    request.send(form);


}


function delete_from_history(invoice_id) {


    swal({
            title: "Are you sure that you want to delete this product from the purchase history?",
            text: " If you click OK this product from the purchase history!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                delete_from_history_confirm(invoice_id);
                swal("The product has been successfully deleted from the purchase history!", {
                    icon: "success",
                });
            }
        });




}


function delete_from_history_confirm(invoice_id) {


    var form = new FormData();
    form.append("invoice_id", invoice_id);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;

            if (response == "Success") {

                window.location = "purchase-history.php";

            }



        }





    };


    request.open("POST", "delete_from_history.php", true);
    request.send(form);

}


function delete_all_history() {


    swal({
            title: "Are you sure that you want to delete all the products from the purchase history?",
            text: " If you click OK all the products from the purchase history!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {






                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {

                    if (request.readyState == 4) {

                        var response = request.responseText;



                        if (response == "Success") {




                            window.location = "purchase-history.php";

                            swal("The products has been successfully deleted from the purchase history!", {
                                icon: "success",
                            });


                        }



                    }





                };


                request.open("POST", "delete_from_history_all.php", true);
                request.send();



            }
        });





}

function search_manage_user() {


    var search_txt = document.getElementById("search_txt_manage_user").value;

    var form = new FormData();

    form.append("search_txt", search_txt);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;


            document.getElementById("manage_users_search_box").innerHTML = response;

        }





    };

    request.open("POST", "search_manage_users.php", true);
    request.send(form);


}


function cart_buy_prev() {



    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;



            if (response == "Sign In First!") {

                alert(response);


            } else if (response == "Invalid Product.") {

                alert(response);


            } else if (response == "The qty can't be greater the original qty..") {

                alert(response);


            } else if (response == "Please update your address first!") {

                swal({
                        title: "Please update your address first!",
                        text: " To update the address you will be redirected to the my profile page.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            window.location = "my-profile.php";

                        }
                    });


            } else {






                var json_final = JSON.parse(response);


                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    create_invoice_cart(orderId);

                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1217851", // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/cart.php", // Important
                    "cancel_url": "http://localhost/eshop/cart.php", // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": json_final.order_id,
                    "items": json_final.prod_amount,
                    "amount": json_final.total,
                    "currency": "LKR",
                    "first_name": json_final.fname,
                    "last_name": json_final.lname,
                    "email": json_final.email,
                    "phone": json_final.mobile,
                    "address": json_final.address,
                    "city": json_final.district,
                    "country": "Sri Lanka",
                    "delivery_address": json_final.address,
                    "delivery_city": json_final.district,
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                document.getElementById('payhere-payment').onclick = function(e) {
                    payhere.startPayment(payment);
                };






            }





        }





    };


    request.open("POST", "buy_now_process_cart.php", true);
    request.send();







}



function create_invoice_cart(invoice_id) {


    var form = new FormData();
    form.append("order_id", invoice_id);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;

            window.location = "invoice.php?order_id=" + invoice_id;



        }





    };


    request.open("POST", "create_invoice_process_cart.php", true);
    request.send(form);



}


function update_cart_qty(product_id) {


    var qty = document.getElementById("cart_qty_cart_buy_now" + product_id).value;




    var form = new FormData();

    form.append("product_id", product_id);
    form.append("qty", qty);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;

            var sub_response = response.substring(0, 72);



            if (response == "Product not found in the cart!") {


                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (sub_response == "The cart's qty can't be greater than the product's original qty which is") {


                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            } else if (response == "Please update your address first!") {


                swal({
                        title: "Please update your address first!",
                        text: " To update the address you will be redirected to the my profile page.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            window.location = "my-profile.php";

                        }
                    });


            } else {




                var cart_json = JSON.parse(response);



                document.getElementById("cart_requested" + product_id).innerHTML = cart_json.requeted_total;

                document.getElementById("cart_prod_qty" + product_id).innerHTML = cart_json.product_qty;

                document.getElementById("total_cart_price").innerHTML = cart_json.total_price;

                document.getElementById("price_with_delivery_cart").innerHTML = cart_json.total_price_with_ship;

            }




        }





    };


    request.open("POST", "update_cart_qty.php", true);
    request.send(form);



}

function sign_out_admin() {


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;

            window.location = "admin.php";




        }






    };

    request.open("POST", "logout_admin.php", true);
    request.send();




}

function paginate_category(page) {



    var form = new FormData();
    form.append("page", page);

    var search_request = new XMLHttpRequest();
    search_request.onreadystatechange = function() {


        if (search_request.readyState == 4) {

            var search_response = search_request.responseText;





            document.getElementById("category_box").innerHTML = search_response;







        }






    };

    search_request.open("POST", "paginate_category.php", true);
    search_request.send(form);





}

function paginate_brand(page) {


    var form = new FormData();
    form.append("page", page);

    var search_request = new XMLHttpRequest();
    search_request.onreadystatechange = function() {


        if (search_request.readyState == 4) {

            var search_response = search_request.responseText;





            document.getElementById("brand_box").innerHTML = search_response;







        }






    };

    search_request.open("POST", "paginate_brand.php", true);
    search_request.send(form);



}


function add_brand() {


    var brand_txt = document.getElementById("brand_txt").value;

    var form = new FormData();

    form.append("brand_txt", brand_txt);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;




            if (response == "Brand sucessfully added!") {


                document.getElementById("brand_txt").value = "";

                paginate_brand(1);

                swal("The brand has been successfully added!", {
                    icon: "success",
                });




                var search_request = new XMLHttpRequest();
                search_request.onreadystatechange = function() {


                    if (search_request.readyState == 4) {

                        var search_response = search_request.responseText;





                        document.getElementById("brand_select").innerHTML = search_response;







                    }






                };

                search_request.open("POST", "get_brands.php", true);
                search_request.send();






            } else {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            }




        }





    };

    request.open("POST", "add_brand.php", true);
    request.send(form);




}

function paginate_model(page) {




    var form = new FormData();
    form.append("page", page);

    var search_request = new XMLHttpRequest();
    search_request.onreadystatechange = function() {


        if (search_request.readyState == 4) {

            var search_response = search_request.responseText;





            document.getElementById("model_box").innerHTML = search_response;







        }






    };

    search_request.open("POST", "paginate_model.php", true);
    search_request.send(form);









}

function add_model() {




    var model_txt = document.getElementById("model_txt").value;

    var form = new FormData();

    form.append("model_txt", model_txt);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;




            if (response == "Model sucessfully added!") {


                document.getElementById("model_txt").value = "";

                paginate_model(1);

                swal("The model has been successfully added!", {
                    icon: "success",
                });


                var search_request = new XMLHttpRequest();
                search_request.onreadystatechange = function() {


                    if (search_request.readyState == 4) {

                        var search_response = search_request.responseText;





                        document.getElementById("model_select").innerHTML = search_response;







                    }






                };

                search_request.open("POST", "get_models.php", true);
                search_request.send();




            } else {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            }




        }





    };

    request.open("POST", "add_model.php", true);
    request.send(form);



}


function paginate_color(page) {


    var form = new FormData();
    form.append("page", page);

    var search_request = new XMLHttpRequest();
    search_request.onreadystatechange = function() {


        if (search_request.readyState == 4) {

            var search_response = search_request.responseText;





            document.getElementById("color_box").innerHTML = search_response;







        }






    };

    search_request.open("POST", "paginate_color.php", true);
    search_request.send(form);




}

function add_color() {


    var color_txt = document.getElementById("color_txt").value;

    var form = new FormData();

    form.append("color_txt", color_txt);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;




            if (response == "Colour sucessfully added!") {


                document.getElementById("color_txt").value = "";

                paginate_color(1);

                swal("The colour has been successfully added!", {
                    icon: "success",
                });



            } else {

                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            }




        }





    };

    request.open("POST", "add_color.php", true);
    request.send(form);






}




function paginate_match(page) {


    var form = new FormData();
    form.append("page", page);

    var search_request = new XMLHttpRequest();
    search_request.onreadystatechange = function() {


        if (search_request.readyState == 4) {

            var search_response = search_request.responseText;





            document.getElementById("match_box").innerHTML = search_response;







        }






    };

    search_request.open("POST", "paginate_match.php", true);
    search_request.send(form);





}


function match_brand_model() {


    var brand = document.getElementById("brand_select").value;

    var model = document.getElementById("model_select").value;





    var form = new FormData();
    form.append("brand", brand);
    form.append("model", model);


    var search_request = new XMLHttpRequest();
    search_request.onreadystatechange = function() {


        if (search_request.readyState == 4) {

            var search_response = search_request.responseText;









            if (search_response == "Success") {

                swal("The model and brand has been successfully matched!", {
                    icon: "success",
                });


                paginate_match(1);

                document.getElementById("brand_select").value = "";
                document.getElementById("model_select").value = "";



            } else {

                swal({
                    title: search_response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })



            }










        }






    };

    search_request.open("POST", "math_brand_model.php", true);
    search_request.send(form);








}



function approve_product(product_id) {




    var form = new FormData();
    form.append("product_id", product_id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;


            if (response == "The product has been successfully approved!") {


                swal(response, {
                    icon: "success",
                }).then((willDelete) => {
                    if (willDelete) {
                        location.reload();

                    }
                });


            } else {



                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })

            }




        }



    };



    request.open("POST", "approve_process.php", true);
    request.send(form);






}



function unapprove_product(product_id) {


    var form = new FormData();
    form.append("product_id", product_id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {


            var response = request.responseText;


            if (response == "The product has been successfully rejected!") {


                swal(response, {
                    icon: "success",
                }).then((willDelete) => {
                    if (willDelete) {
                        location.reload();

                    }
                });


            } else {



                swal({
                    title: response,

                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                })

            }




        }



    };



    request.open("POST", "unapprove_process.php", true);
    request.send(form);













}