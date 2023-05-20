// const bootstrap = require("./bootstrap");

function changeView() {
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");


}

function signUp() {
    var f = document.getElementById("f");
    var l = document.getElementById("l");
    var e = document.getElementById("e");
    var p = document.getElementById("p");
    var m = document.getElementById("m");
    var g = document.getElementById("g");


    var form = new FormData;

    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            // alert(text);
            if (text == "success") {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msg").className = "bi bi-check-circle-fill";
                document.getElementById("alertdiv").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msgdiv").className = "d-blck";
            }
        }
    }

    request.open("POST", "proccess.php", true);
    request.send(form);


}

function singIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberMe");

    var f = new FormData();

    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }
            // alert(t);
        }
    };

    r.open("POST", "signInProccess.php", true);
    r.send(f);

}

var bm;

function frogotPassword() {
    // alert("ok");





    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("verification code has sent to your email. please check your inbox");


                var m = document.getElementById("frogotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "frogotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function showPassword() {

    var input = document.getElementById("inp");

    var eye = document.getElementById("e1");

    if (input.type == "password") {

        input.type = "text";
        eye.className = "bi bi-eye-fill";

    } else {

        input.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function showPassword2() {
    var input = document.getElementById("rnp");

    var eye = document.getElementById("e1");


    if (input.type == "password") {

        input.type = "text";
        eye.className = "bi bi-eye-fill";

    } else {

        input.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }
}

function resetpw() {
    var email = document.getElementById("email2");
    var np = document.getElementById("inp");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");

    var f = new FormData();



    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                bm.hide();
                alert("Password reset success");
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "resetPassword.php", true);
    r.send(f);



}

function signOut() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }


        }
    }
    r.open("GET", "signoutProcess.php", true);
    r.send();
}

function changeImage() {
    var view = document.getElementById("viweImage");
    var file = document.getElementById("profileimg");

    file.onchange = function() {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }

}

function updateMyProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("Province");
    var distric = document.getElementById("distric");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimg");

    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("mb", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", distric.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);

    if (image.files.length == 0) {
        var confriamation = confirm("Are you sure don't want to update profle image?");

        if (confriamation) {
            alert("you have not select any image");
        }
    } else {
        f.append("image", image.files[0]);
    }


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "sucsess") {
                window.location.reload();
            } else {
                alert(t);
            }


        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);

}

function changeProductImage() {


    var image = document.getElementById("imageuploder");

    image.onchange = function() {


        var file_count = image.files.length;


        if (file_count <= 3) {
            // alert(file_count);
            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }
        } else {
            alert("please select 3 or less than 3 image ");
        }
    }
}

function addProduct() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("tittle");

    var condition = 0;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }




    var clr = document.getElementById("clr");
    var clr_in = document.getElementById("clr_in");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploder");


    var f = new FormData();

    f.append("ca", category.value);
    f.append("br", brand.value);
    f.append("mo", model.value);
    f.append("ti", title.value);
    f.append("co", condition);
    f.append("clr", clr.value);
    f.append("clr_in", clr_in.value);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {

        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest;

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            if (t == "product image saved and product update sucsessfully") {
                alert("product registration succsessfully");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);


}

function loadbrand() {
    var category = document.getElementById("category").value;
    alert(category);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("brand").innerHTML = t;
        }
    }

    r.open("GET", "loadbrand.php?c=" + category, true)
    r.send();
}

function loadmodel() {
    var brand = document.getElementById("brand").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("model").innerHTML = t;
            // alert(t);
        }
    }

    r.open("GET", "loadmodel.php?b=" + brand, true);
    r.send();

}

function statusChange(id) {
    var product_id = id;

    var r = new XMLHttpRequest;

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deactivated") {
                alert("Product Deactivated");
                window.location.reload();
            } else if (t == "Activated") {
                alert("Product Activated");
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }


    r.open("GET", "statusChangeProcess.php?p=" + product_id, true);
    r.send();
}

function sort1(x) {
    // alert("ok");
    var search = document.getElementById("s");
    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }
    var qty = "0";
    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }

    var condition = "0";

    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    }
    var f = new FormData();

    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", condition);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST", "sortProduct.php", true);
    r.send(f);


}

function sendId(id) {
    // alert(id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "success") {

                window.location = "updateProduct.php";
                // alert("hello");
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendProductIdProcess.php?id=" + id, true)
    r.send();

}

function deletsort() {
    window.location.reload();
}

function updateProduct() {
    // alert("done");

    var title = document.getElementById("t");
    var qty = document.getElementById("q");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var images = document.getElementById("imageuploder");


    var f = new FormData;

    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);

    var img_count = images.files.length;

    for (var x = 0; x < img_count; x++) {
        f.append("i" + x, images.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = this.responseText;
            if (t == "success") {
                alert("update succes");
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "updateProcess.php", true);
    r.send(f);




}

function basicSearch(x) {
    // alert("ok");
    var txt = document.getElementById("bacic_search_txt");
    var select = document.getElementById("bacic_search_select");

    // alert(txt.value);
    // alert(select.value);

    var f = new FormData;

    f.append("t", txt.value);
    f.append("s", select.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);



}

function advancedSearch(x) {
    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b");
    var model = document.getElementById("m");
    var condition = document.getElementById("c2");
    var color = document.getElementById("c3");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("pf", from.value);
    f.append("to", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advanceSearchProcess.php", true);
    r.send(f);
}

function loadMainImg(id) {
    var img = document.getElementById("productImg" + id).src;
    var main = document.getElementById("main_img");
    main.style.backgroundImage = "url(" + img + ")";
}

function checkValue(qty) {
    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        alert("Quantitu must be 1 or more");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Maximum quntity achived");
        input.value = qty;
    }
}

function qty_inc(qty) {
    var input = document.getElementById("qty_input");
    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();

    } else {
        alert("Maximum quntity has achieved");
        input.value = qty;
    }
}

function qty_dec(qty) {
    var input = document.getElementById("qty_input");
    if (input.value < qty) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();

    } else {
        alert("Minimum quntity has achieved");
        input.value = 1;
    }
}

function addTowatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "removed") {
                window.location.reload();
                document.getElementById("heart" + id).style.className = "text-dark";

                window.location.reload();
            } else if (t == "added") {
                window.location.reload();
                document.getElementById("heart" + id).style.className = "text-danger";


            } else {
                alert(t);
            }

        }
    }
    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();
}

function removeFromWatchlist(id) {
    // alert(id);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert(t);

                window.location.reload();
            } else {
                alert(t);
            }


        }
    }

    r.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    r.send();
}

function addToCart(id) {
    // alert(id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = this.responseText;
            alert(t);
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();

}

function deleteFromCart(x) {
    // alert(x);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "sucsess") {
                alert("Product Removed From Card");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "deletFromCartprocess.php?id=" + x, true);
    r.send();
}

function viewMassages(email) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;


            // alert(t);
        }
    }

    r.open("GET", "viewMassagePocess.php?e=" + email, true);
    r.send();
}

// function viewMassages(email) {
//     alert(email);
// }

function send_msg() {
    var email = document.getElementById("rmail");
    var txt = document.getElementById("msg_txt");

    var f = new FormData();

    f.append("e", email.innerHTML);
    f.append("t", txt.value);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "msgSendProcess.php", true);
    r.send(f);
}

function payNow(id) {



    var qty = document.getElementById("qty_input").value;


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            var obj = JSON.parse(t);
            var mail = obj["mail"];
            var amount = obj["amount"];
            // alert(mail);
            if (t == "1") {
                alert("Pleace log in or sign up");
                window.location = "index.php";
            } else if (t == 2) {
                alert("Pleace Update your profile");
                window.location = "updateProduct.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    window.location = "invoice.php";
                    console.log("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221376", // Replace your Merchant ID
                    "return_url": "http://localhost/eshopf/singelProductViwe.php?id" + id, // Important
                    "cancel_url": "http://localhost/eshopf/singelProductViwe.php?id" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": "ItemNo12345",
                    "items": obj["id"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function(e) {
                payhere.startPayment(payment);
                // };
            }
        }
    }

    r.open("GET", "buyNowPocess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

function saveInvoice(orderId, id, mail, amount, qty) {
    alert("ok");
    alert(orderId);
    alert(id);
    alert(mail);
    alert(amount);
    alert(qty);
    var f = new FormData();

    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);



    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }


        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);
}

function prinInvoice() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;

}

function exportPdf() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    // document.body.innerHTML = page;
    // // window.exportPdf
    // document.body.innerHTML = body;

    html2pdf()
        .from(page)
        .save();
}
var md;

function addFeedback(id) {
    var feed = document.getElementById("feedbackModl" + id);
    md = new bootstrap.Modal(feed);
    md.show();
    // alert(id);
}

function saveFeedback(id) {

    // alert(id);
    var type;
    if (document.getElementById("type1").checked) {
        type = 1;
    } else if (document.getElementById("type2").checked) {
        type = 2;
    } else if (document.getElementById("type3").checked) {
        type = 3;
    }

    // alert(type);

    var feedback = document.getElementById("textarea");

    // alert(feedback);

    var f = new FormData();

    f.append("t", type);
    f.append("p", id);
    f.append("f", feedback.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "1") {
                md.hide();
                // alert("success");
            } else {
                alert(t);
            }
        }
    }

    r.open("post", "saveFeedbachProcess.php", true);
    r.send(f);
}

var av;

function adminVerification() {


    var email = document.getElementById("e");

    var f = new FormData();



    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                var adminVerificationModal = document.getElementById("verificationmodel");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}

function verify() {
    var verification = document.getElementById("vcode");


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "sucsess") {
                av.hide();
                window.location = "adminPanel.php";
            } else {
                alert(t);
            }
            // alert(t);
        }
    }

    r.open("GET", "verificationProcess.php?v=" + verification.value, true);
    r.send();
}

function backToHome() {
    // alert("hello");
    window.location = "index.php";
}

function blockProduct(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("pb" + id).innerHTML = "Unblock";
                document.getElementById("pb" + id).classList = "btn btn-success";
            } else if (txt == "unblocked") {
                document.getElementById("pb" + id).innerHTML = "Block";
                document.getElementById("pb" + id).classList = "btn btn-danger";
            } else {
                alert(txt);
            }
        }
    }

    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();

}

function blockUser(email) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("ub" + email).innerHTML = "Unblock";
                document.getElementById("ub" + email).classList = "btn btn-success";
            } else if (txt == "unblocked") {
                document.getElementById("ub" + email).innerHTML = "Block";
                document.getElementById("ub" + email).classList = "btn btn-danger";
            } else {
                alert(txt);
            }
        }
    }

    request.open("GET", "userBlockProcess.php?email=" + email, true);
    request.send();

}



var mm;

function viewMsgModal(email) {
    var m = document.getElementById("userMsgModal" + email);
    mm = new bootstrap.Modal(m);
    mm.show();

    // // alert(email);

}

function a(email) {
    // alert("hello");
    // alert(email);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("btn").classList = "d-none";
            document.getElementById("msg_box").innerHTML = t;
            // alert(t);
        }
    }

    r.open("GET", "viewmsgProcess.php?e=" + email, true);
    r.send();
}
var pm;

function viewProductModel(id) {

    var m = document.getElementById("viewProductModel" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

var cm;

function addNewCategory() {
    var m = document.getElementById("addCategoryModel");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var vc;
var e;
var n;

function verifyCategory() {
    var ncm = document.getElementById("addCategoryVerificationModel");
    vc = new bootstrap.Modal(ncm);
    vc.show();

    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var f = new FormData();
    f.append("email", e);
    f.append("name", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                cm.hide();
                vc.show();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "addNewCatogoryProcess.php", true);
    r.send(f);
}

function saveCategory() {
    var txt = document.getElementById("text").value;

    var f = new FormData();

    f.append("t", txt);
    f.append("e", e);
    f.append("n", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = this.responseText;
            if (t == "success") {
                vc.hide();
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "SaveCategoryProcess.php", true);
    r.send(f);
}

function changeStatus(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = this.responseText;
            // alert(t);
            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
                document.getElementById("btn" + id).classList = "btn btn-warning fw-bold  mt-1 mb-1";
                window.location.reload();

            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
                document.getElementById("btn" + id).classList = "btn btn-info fw-bold  mt-1 mb-1";
                window.location.reload();


            } else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shiping";
                document.getElementById("btn" + id).classList = "btn btn-primary fw-bold  mt-1 mb-1";
                window.location.reload();


            } else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivery";
                document.getElementById("btn" + id).classList = "btn btn-danger fw-bold  mt-1 mb-1";
                window.location.reload();


            }
        }
    }

    r.open("GET", "changeinvoiceStatusProcess.php?id=" + id, true);
    r.send();

}

function searchInvoiceId() {
    var txt = document.getElementById("serchTxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("pageination").classList = "d-none";
            // alert(t);
            document.getElementById("viewArea").innerHTML = t;
        }
    }

    r.open("GET", "searchInvoiceProcess.php?id=" + txt, true);
    r.send();

}

function findselling() {

    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    // alert(from);
    // alert(to);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            document.getElementById("viewArea").innerHTML = t;

        }
    }

    r.open("GET", "findSellingProcess.php?f=" + from + "&t=" + to, true);
    r.send();

}

var cam;

function contactAdmin(email) {
    var m = document.getElementById("contactAdmin");
    cam = new bootstrap.Modal(m);
    cam.show();
}

function sendAdminMs(email) {


    var txt = document.getElementById("msgtxt").value;
    // alert(email);




    var f = new FormData();

    f.append("t", txt);
    f.append("e", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "sucsess1") {
                alert("Massage Sending Sucsess");

            } else {
                alert("Massage Sending Fail");
            }

        }
    }

    r.open("POST", "sendCustomerMasseageProcess.php", true);
    r.send(f);
}

function sendAdminMsg(email) {

    // alert(email);
    var txt = document.getElementById("a").value;


    // alert(t);

    var f = new FormData();

    f.append("t", txt);
    f.append("r", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);

        }
    }

    r.open("POST", "sendAdminMasseageProcess.php", true);
    r.send(f);
}

// function viewMsg() {
//     alert("hello");
// }