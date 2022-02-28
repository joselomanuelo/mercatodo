<?php

namespace App\Constants;

class RouteNames extends Constant
{
    //users
    public const INDEX_USERS = 'admin.users.index';
    public const SHOW_USERS = 'admin.users.show';
    public const UPDATE_USERS = 'admin.users.update';
    public const DESTROY_USERS = 'admin.users.destroy';
    public const EDIT_USERS = 'admin.users.edit';
    public const TOGGLE_USERS = 'admin.users.toggle';

    //products
    public const INDEX_PRODUCTS = 'admin.products.index';
    public const SHOW_PRODUCTS = 'admin.products.show';
    public const UPDATE_PRODUCTS = 'admin.products.update';
    public const DESTROY_PRODUCTS = 'admin.products.destroy';
    public const CREATE_PRODUCTS = 'admin.products.create';
    public const STORE_PRODUCTS = 'admin.products.store';
    public const EDIT_PRODUCTS = 'admin.products.edit';

    //auth
    public const REGISTER = 'register';
    public const LOGIN = 'login';
    public const LOGIN_ATTEMP = 'login.attemp';
    public const LOGOUT = 'logout';
    public const PASSWORD_REQUEST = 'password.request';
    public const PASSWORD_EMAIL = 'password.email';
    public const PASSWORD_RESET = 'password.reset';
    public const PASSWORD_UPDATE = 'password.update';
    public const PASSWORD_CONFIRM = 'password.confirm';
    public const VERIFICATION_NOTICE = 'verification.notice';
    public const VERIFICATION_VERIFY = 'verification.verify';
    public const VERIFICATION_SEND = 'verification.send';
    public const TOKEN = 'token';

    //buyers
    public const BUYER_INDEX_PRODUCTS = 'buyer.products.index';
    public const BUYER_SHOW_PRODUCTS = 'buyer.products.show';

    //app
    public const DASHBOARD = 'dashboard';
    public const WELCOME = 'welcome';

    //api
    public const API_CATEGORIES = 'api.categories';
    public const API_PRODUCTS = 'api.products';
    public const API_ORDERS = 'api.orders';
    public const API_STORE_ORDERS = 'api.orders.store';
}
