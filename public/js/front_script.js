$(document).on("ready", function() {
    // Sorting listing ajax
    $("#sort").on("change", function() {
        var sort = $(this).val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            data: { sort: sort, url: url },
            success: function(data) {
                $(".filter_products").html(data);
            }
        });
    });

    $("#getPrice").on("change", function() {
        var size = $(this).val();
        var product_id = $(this).attr("product-id");
        if (size == "") {
            Swal.fire("Gagal !", "Harap pilih ukuran/dimensi barang", "error");
            return false;
        }

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr(
                    "content"
                )
            }
        });

        $.ajax({
            url: "/get-product-price",
            data: { size: size, product_id: product_id },
            type: "post",
            success: function(resp) {
                // alert(resp["product_price"]);
                // return false;
                if (resp["discount"] > 0) {
                    var money = new Number(
                        resp["product_price"]
                    ).toLocaleString("id-ID");
                    var moneyDisc = new Number(
                        resp["final_price"]
                    ).toLocaleString("id-ID");
                    $(".getAttrPrice").html(
                        "<del>Rp. " + money + "</del>" + "  Rp. " + moneyDisc
                    );
                } else {
                    var money = new Number(
                        resp["product_price"]
                    ).toLocaleString("id-ID");
                    $(".getAttrPrice").html("Rp. " + money);
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    $(document).on("click", ".btnItemUpdate", function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr(
                    "content"
                )
            }
        });

        if ($(this).hasClass("qtyMinus")) {
            var quantity = $(this)
                .prev()
                .val();
            if (quantity <= 1) {
                Swal.fire(
                    "Gagal !",
                    "Jumlah item setidak nya harus 1 barang atau lebih",
                    "error"
                );
                return false;
            } else {
                new_qty = parseInt(quantity) - 1;
            }
        }
        if ($(this).hasClass("qtyPlus")) {
            var quantity = $(this)
                .prev()
                .prev()
                .val();
            new_qty = parseInt(quantity) + 1;
        }
        // alert(new_qty);
        var cartId = $(this).data("cartid");
        // alert(cartId);
        $.ajax({
            data: { cartid: cartId, qty: new_qty },
            url: "/update-cart-item-qty",
            type: "post",
            success: function(resp) {
                if (resp.status == false) {
                    alert(resp.message);
                }
                $(".totalCartItems").html(resp.totalCartItems);
                $("#AppendCartItems").html(resp.view);
            },
            error: function() {
                alert("Error");
            }
        });
    });

    //Delete cart item
    $(document).on("click", ".btnItemDelete", function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr(
                    "content"
                )
            }
        });

        var cartId = $(this).data("cartid");
        Swal.fire({
            title: "Yakin untuk menghapus item ini?",
            text: "Tindakan ini tidak bisa diulang!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iya, Hapus"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    data: { cartid: cartId },
                    url: "/delete-cart-item",
                    type: "post",
                    success: function(resp) {
                        $("#AppendCartItems").html(resp.view);
                        $(".totalCartItems").html(resp.totalCartItems);
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }
        });
    });

    $("#registerForm").validate({
        rules: {
            name: "required",
            mobile: {
                required: true,
                minlength: 10,
                maxlength: 12,
                digits: true
            },
            password: {
                required: true,
                minlength: 6
            },
            email: {
                required: true,
                email: true,
                remote: "check-email"
            },
            agree: "required"
        },
        messages: {
            name: "Please enter your name",
            mobile: {
                required: "Please enter a mobile number",
                minlength:
                    "Your mobile number must consist of at least 10 digits",
                maxlength:
                    "Your mobile number must consist of at least 10 digits",
                digits: "Please enter your valid Mobile Number"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter valid email",
                remote: "Email already Exist !"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            }
        }
    });

    $("#loginForm").validate({
        rules: {
            password: {
                required: true,
                minlength: 6
            },
            email: {
                required: true,
                email: true
                // remote: "check-email"
            }
        },
        messages: {
            email: {
                required: "Please enter your email",
                email: "Please enter valid email"
            },
            password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 5 characters long"
            }
        }
    });

    $("#forgotPasswordForm").validate({
        rules: {
            email: {
                required: true,
                email: true
                // remote: "check-email"
            }
        },
        messages: {
            email: {
                required: "Please enter your email",
                email: "Please enter valid email"
            }
        }
    });

    $("#accountForm").validate({
        rules: {
            name: {
                required: true,
                lettersonly: true
            },
            mobile: {
                required: true,
                minlength: 10,
                maxlength: 12,
                digits: true
            }
        },
        messages: {
            name: {
                required: "Please enter your Name",
                lettersonly: "Please enter valide Name"
            },
            mobile: {
                required: "Please enter a mobile number",
                minlength:
                    "Your mobile number must consist of at least 10 digits",
                maxlength:
                    "Your mobile number must consist of at least 10 digits",
                digits: "Please enter your valid Mobile Number"
            }
        }
    });

    //Check current user password
    $("#current_pwd").keyup(function(e) {
        var current_pwd = $(this).val();
        $.ajax({
            type: "post",
            url: "/check-user-password",
            data: { current_pwd: current_pwd },
            success: function(resp) {
                // alert(resp);
                if (resp == "false") {
                    $("#chkPwd").html(
                        "<font style='margin-top: 80px;' color='red'><b style='margin-top: 80px;'>Current Password is Incorrect</b></font>"
                    );
                } else if (resp == "true") {
                    $("#chkPwd").html(
                        "<font style='margin-top: 80px;' color='green'><b style='margin-top: 80px;'>Current Password is Correct</b></font>"
                    );
                }
            },
            error: function(params) {
                alert("Error");
            }
        });
    });

    $("#passwordForm").validate({
        rules: {
            current_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirm_password: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_password"
            }
        },
        messages: {
            current_pwd: {
                required: "Please enter your Current Password",
                minlength: "Your password must be at least 5 characters long"
            },
            new_password: {
                required: "Please enter your New Password",
                minlength: "Your password must be at least 5 characters long"
            },
            confirm_password: {
                required: "Please enter your Confirm Password",
                minlength: "Your password must be at least 5 characters long"
            }
        }
    });

    // Apply coupon code
    $("#applyCoupon").on("submit", function() {
        var user = $(this).attr("user");
        if (user == 1) {
            // do nothing
        } else {
            Swal.fire("Gagal !", "Harap login terlebih dahulu untuk", "error");
            return false;
        }
        var code = $("#code").val();
        $.ajax({
            type: "post",
            data: { code: code },
            url: "/apply-coupon",
            success: function(resp) {
                if (resp.message != "") {
                    alert(resp.message);
                }
                $("#AppendCartItems").html(resp.view);
                $(".totalCartItems").html(resp.totalCartItems);
                if (resp.grand_total >= 0) {
                    $(".grand_total").html("Rp. " + resp.grand_total);
                }
                if (resp.couponAmount >= 0) {
                    $(".couponAmount").text("Rp. " + resp.couponAmount);
                } else {
                    $(".couponAmount").text("Rp. 0");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    //Delete delivery address
    $(document).on("click", ".addressDelete", function() {
        var result = confirm("Want to delete this Address ?");
        if (!result) {
            return false;
        }
    });

    $("input[name=address_id]").bind("change", function() {
        var shipping_charges = $(this).attr("shipping_charges");
        var total_price = $(this).attr("total_price");
        var coupon_amount = $(this).attr("coupon_amount");
        var codpincodeCount = $(this).attr("codpincodeCount");

        if (codpincodeCount > 0) {
            $(".cod_payment").show();
        } else {
            $(".cod_payment").hide();
        }

        if (coupon_amount == "") {
            coupon_amount = 0;
        }
        var grand_total =
            parseInt(total_price) +
            parseInt(shipping_charges) -
            parseInt(coupon_amount);
        $(".grand_total").html("Rp. " + grand_total);
    });

    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".selectt")
                .not(targetBox)
                .hide();
            $(targetBox).show();
            // alert("Radio button " + inputValue + " is selected");
        });
    });

    $("#checkPincode").click(function() {
        var pincode = $("#pincode").val();
        if (pincode == "") {
            Swal.fire("Gagal !", "Harap input kodepos", "error");
            return false;
        }

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr(
                    "content"
                )
            }
        });

        $.ajax({
            data: { pincode: pincode },
            url: "/check-pincode",
            type: "post",
            success: function(resp) {
                alert(resp);
            },
            error: function() {
                alert("Error");
            }
        });
    });

    $("form").on("change", ".file-upload-field", function() {
        $(this)
            .parent(".file-upload-wrapper")
            .attr(
                "data-text",
                $(this)
                    .val()
                    .replace(/.*(\/|\\)/, "")
            );
    });

    $(".userLogin").on("click", function() {
        Swal.fire(
            "Gagal",
            "Harap melakukan login untuk bisa menambahkan barang wishlist",
            "error"
        );
    });

    $(".batalpesanan").on("click", function(e) {
        var reason = $("#cancelReason").val();
        var form = $(this).parents("form");
        e.preventDefault();
        if (reason == "") {
            Swal.fire("Gagal", "Harap pilih alasan pembatalan order", "error");
        } else {
            Swal.fire({
                title: "Yakin untuk membatalkan pesanan ini?",
                text: "Tindakan ini tidak bisa diulang!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, Hapus"
            }).then(result => {
                if (result.isConfirmed) {
                    form.submit();
                    return true;
                }
            });
        }
    });

    $(".updateWishlist").on("click", function() {
        var product_id = $(this).data("productid");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr(
                    "content"
                )
            }
        });

        $.ajax({
            type: "post",
            url: "/update-wishlist",
            data: { product_id: product_id },
            success: function(resp) {
                if (resp.action == "add") {
                    $(".totalWishlistItems").html(resp.totalWishlistItems);
                    $("button[data-productid=" + product_id + "]").html(
                        '<i class="fa fa-heart"></i>'
                    );
                    Swal.fire(
                        "Berhasil",
                        "Barang ditambahkan ke wishlist",
                        "success"
                    );
                } else if (resp.action == "remove") {
                    $(".totalWishlistItems").html(resp.totalWishlistItems);
                    $("button[data-productid=" + product_id + "]").html(
                        '<i class="fa fa-heart-o"></i>'
                    );
                    Swal.fire(
                        "Berhasil",
                        "Barang Dihapus dari wishlist",
                        "info"
                    );
                }
            },
            error: function() {
                alert("error");
            }
        });
    });

    $(".wishlistItemDelete").on("click", function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        var wishlistId = $(this).data("wishlistid");

        Swal.fire({
            title: "Yakin untuk menghapus item ini?",
            text: "Tindakan ini tidak bisa diulang!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iya, Hapus"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "/delete-wishlist-item",
                    data: { wishlistId: wishlistId },
                    success: function(resp) {
                        $(".AjaxWishlistItems").html(resp.view);
                        $(".totalWishlistItems").html(resp.totalWishlistItems);
                        setTimeout(function() {
                            location.reload();
                        }, 0);
                    },
                    error: function() {
                        alert("error");
                    }
                });
            }
        });
    });
});
