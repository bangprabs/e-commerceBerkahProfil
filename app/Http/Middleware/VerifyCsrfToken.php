<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admin/check-current-pwd",
        "admin/update-catblog-status",
        "admin/update-blog-status",
        "admin/update-banner-status",
        "/admin/update-sections-status",
        "/admin/update-category-status",
        "/admin/update-product-status",
        "/admin/update-attribute-status",
        "/admin/update-images-status",
        "/get-product-price",
        "/update-cart-item-qty",
        "/delete-cart-item",
        "/check-user-password",
        "/admin/update-coupon-status",
        "/apply-coupon",
        "/admin/update-shipping-status",
        "/check-pincode",
        "/admin/update-user-status",
        "/admin/update-page-status",
        "/admin/update-admin-status",
        "/admin/update-rating-status",
        "/update-wishlist",
        "/delete-wishlist-item"
    ];
}
