$(document).ready(function () {

    var page_no = 1;
    var perPage = 30;

    var vs = {

        getNoun : function(number, one, two, five) {
            number = Math.abs(number);
            number %= 100;
            if (number >= 5 && number <= 20) {
                return five;
            }
            number %= 10;
            if (number == 1) {
                return one;
            }
            if (number >= 2 && number <= 4) {
                return two;
            }
            return five;
        },

        setHandlers: function(){

            $('.cat-item').off('click').on('click', function () {

                if (document.location.href.indexOf('category') > -1) {
                    document.location.href = '/product';
                } else {
                    document.location.href = '/category';
                }


            });

            $('#sidebar-categories-menu li .menu-title').off('click').on('click', function () {

                var li = $(this).parents('li').eq(0);

                if (li.hasClass('open')) {
                    li.removeClass('open');
                } else {
                    li.addClass('open');
                }
                return false;
            });

            $('#sidebar-categories-menu .sub-menu li>a').off('click').on('click', function () {

                var li = $(this).parents('li').eq(0);

                if (li.hasClass('open')) {
                    li.removeClass('open');
                } else {
                    li.addClass('open');
                }

                //return false;
            });

            $('.sc-feedback-init').off('click').on('click', function(){

                var fbHtml =    '<div class="form-group"><input type="text" placeholder="Представьтесь, пожалуйста" class="form-control" /></div>'+
                    '<div class="form-group"><input type="text" placeholder="Ваш телефон" class="form-control" /></div>'+
                    '<div class="form-group"><input type="text" placeholder="Ваша почта" class="form-control" /></div>'+
                    '<div class="form-group"><textarea rows="5" placeholder="Письмо" class="form-control"></textarea>';

                bootbox.dialog({
                    title: 'Форма обратной связи',
                    message: fbHtml,
                    buttons: {
                        success: {
                            label: 'Отправить',
                            className: 'send_feedback',
                            callback: function () {
                            }
                        }
                    }
                });

            });

            $('.first-add-cart, .inc-btn-inc').off('click').on('click', function(){

                var btn = $(this).parents('.product-add-holder').eq(0);
                var pid = btn.attr('data-id');

                if(!btn.hasClass('added')){
                    btn.html('<div class="cart-add-loader-holder"><i class="fa cart-add-loader fa-cog fa-spin"></i></div>');
                }

                var inc_html = '<div class="inc-btn-holder"><div class="inc-btn-dec" data-id="{{pid}}">-</div><div class="inc-btn-value">{{product_count}}</div><div class="inc-btn-inc" data-id="{{pid}}">+</div></div>';


                var o = {
                    command: 'add_product_in_cart',
                    params: {
                        product_id: pid
                    }
                };

                socketQuery_site(o, function(res){

                    var p_count = res.product.product_count;
                    var mO = {product_count: p_count, pid: pid};

                    btn.html(Mustache.to_html(inc_html, mO));
                    btn.addClass('added');


                    console.log(res);

                    vs.updateBasket(res.cart);
                    vs.setHandlers();
                });

            });

            $('.inc-btn-dec').off('click').on('click', function(){

                var btn = $(this).parents('.product-add-holder').eq(0);
                var pid = btn.attr('data-id');

                var inc_html = '<div class="inc-btn-holder"><div class="inc-btn-dec" data-id="{{pid}}">-</div><div class="inc-btn-value">{{product_count}}</div><div class="inc-btn-inc" data-id="{{pid}}">+</div></div>';

                var o = {
                    command: 'remove_product_from_cart',
                    params: {
                        product_id: pid
                    }
                };

                socketQuery_site(o, function(res){

                    if(!res.code){
                        var p_count = res.product.product_count;
                        var mO = {product_count: p_count, pid: pid};

                        if(p_count > 0){
                            btn.html(Mustache.to_html(inc_html, mO));
                        }else{
                            btn.html('<div class="first-add-cart">В корзину</div>');
                            btn.removeClass('added');
                        }

                        console.log(res);

                        vs.updateBasket(res.cart);
                        vs.setHandlers();
                    }



                });

            });

            $('.cart-item-qnt-inc').off('click').on('click', function(){

                var pid = $(this).attr('data-id');
                var value_place = $(this).parents('.cart-item-qnt').eq(0).find('.cart-item-qnt-value');
                var item_total = $(this).parents('.cart-item-prices').eq(0).find('.cart-item-total-value');
                var item_price = $(this).attr('data-price');


                var o = {
                    command: 'add_product_in_cart',
                    params: {
                        product_id: pid
                    }
                };

                socketQuery_site(o, function(res){

                    if(!res.code){
                        var p_count = res.product.product_count;

                        value_place.html(p_count);

                        item_total.html(parseFloat(p_count * item_price).toFixed(2));

                        vs.updateBasket(res.cart);
                        vs.setHandlers();
                    }else{
                        toastr['error']('Ошибка: '+res.code + ' Сообщите нам пожалуйста, +7 906 063 88 66');
                    }




                });

            });


            $('.cart-item-qnt-dec').off('click').on('click', function(){

                var pid = $(this).attr('data-id');
                var parent_row = $(this).parents('.cart-item').eq(0);
                var value_place = $(this).parents('.cart-item-qnt').eq(0).find('.cart-item-qnt-value');
                var item_total = $(this).parents('.cart-item-prices').eq(0).find('.cart-item-total-value');
                var item_price = $(this).attr('data-price');


                var o = {
                    command: 'remove_product_from_cart',
                    params: {
                        product_id: pid
                    }
                };

                socketQuery_site(o, function(res){

                    if(!res.code){
                        var p_count = res.product.product_count;

                        if(p_count == 0){

                            parent_row.remove();

                            if(res.cart.products.length == 0){
                                $('.empty-basket-holder').removeClass('hidden');
                                $('.cart-prepare-order, .cart-clear').addClass('disabled');
                            }

                        }else{
                            value_place.html(p_count);
                            item_total.html(parseFloat(p_count * item_price).toFixed(2));
                        }

                        vs.updateBasket(res.cart);
                        vs.setHandlers();
                    }else{
                        toastr['error']('Ошибка: '+res.code + ' Сообщите нам пожалуйста, +7 906 063 88 66');
                    }

                });

            });


            $('.load-next').off('click').on('click', function(){

                var btn = $(this);

                btn.html('<i class="fa fa-cog fa-spin"></i>');

                var cat_id = $(this).data('category');
                var search_keyword = $(this).data('search');
                var before = $('.load-next-row');

                page_no = page_no+1;

                var o = {
                    command: 'get_product',
                    params: {
                        limit: perPage,
                        page_no: page_no
                    }
                };



                if(cat_id != 'EMPTY'){
                    o.params.category_id = cat_id;
                }

                if(search_keyword != 'EMPTY'){
                    o.params.search_keyword = search_keyword;
                }

                socketQuery_site(o, function(res){

                    var tpl =   '{{#products}}<div class="col-md-4 notd">'+
                        '<div class="product-item" data-id="{{id}}">'+
                        '<a href="/product_{{id}}"><div class="product-image-holder"><img src="{{image}}" alt="{{name}}"/></div></a>'+
                        '<a href="/product_{{id}}"><div class="product-title-holder">{{name}}</div></a>'+
                        '<div class="product-price-holder">{{price}}&nbsp;<i class="fa fa-ruble"></i></div>'+


                        '<div class="product-add-holder sc-product-add"  data-id="{{id}}">' +
                        '{{{btn_html}}}' +
                        '</div>'+


                        '</div>'+
                        '</div>{{/products}}';

                    var jRes = jsonToObj(res);
                    var count = Object.keys(jRes).length;

                    var mO = {
                        products: []
                    };

                    for(var i in jRes){
                        jRes[i].btn_html = (jRes[i]['in_basket_count'] > 0)? '<div class="inc-btn-holder"><div class="inc-btn-dec" data-id="'+jRes[i]['id']+'">-</div><div class="inc-btn-value">'+jRes[i]['in_basket_count']+'</div><div class="inc-btn-inc" data-id="'+jRes[i]['id']+'">+</div></div>' : '<div class="first-add-cart">В корзину</div>';
                        mO.products.push(jRes[i]);
                    }

                    before.before(Mustache.to_html(tpl, mO));

                    btn.html('Загрузить еще');

                    if(count < perPage){
                        btn.remove();
                    }

                    vs.setHandlers();
                });

            });

            $('a.disabled').on('click', function(){
                return false;
            });

            $('.cart-clear').off('click').on('click', function(){

                if($(this).hasClass('disabled')){
                    return;
                }

                var o = {
                    command: 'clear_cart',
                    params: {}
                };

                socketQuery_site(o, function(res){

                    if(!res.code){

                        document.location.reload();

                    }else{
                        toastr['error']('Ошибка: '+res.code + ' Сообщите нам пожалуйста, +7 906 063 88 66');
                    }

                });


            });

            $('.cart-confirm-order').off('click').on('click', function(){

                var address =           $('#address').val();
                var name =              $('#name').val();
                var phone =             $('#phone').val();
                var email =             $('#email').val();
                var gate =              $('#gate').val();
                var gatecode =          $('#gatecode').val();
                var level =             $('#level').val();
                var flat =              $('#flat').val();
                var comment =           $('#comment').html();
                var agreement =         $('#agreement')[0].checked;
                var subscription =      $('#subscription')[0].checked;

                if(phone.length == 0 || !agreement){
                    toastr['error']('Заполните обязательные поля, помеченные звездочкой.');
                }else{

                    var o = {
                        command: 'create_order',
                        params: {
                            address         :address,
                            name            :name,
                            phone           :phone,
                            email           :email,
                            gate            :gate,
                            gatecode        :gatecode,
                            level           :level,
                            flat            :flat,
                            comment         :comment,
                            agreement       :agreement,
                            subscription    :subscription
                        }
                    };

                    socketQuery_site(o, function(res){

                        if(!res.code){

                            console.log(res);

                            document.location.href = '/success/?order_id='+res.id;

                        }else{
                            toastr['error']('Ошибка: '+res.code + ' Сообщите нам пожалуйста, +7 906 063 88 66');
                        }

                    });

                }

            });


        },

        updateBasket: function(cart){

            cart.total_products_count = cart.total_products_count || cart.product_count;

            var d = new Date();
            var delivery_price = (d.getHours() >= 0 && d.getHours() < 10) ? 250  : 150 ;


            var with_delivery = +cart.amount + +delivery_price;


            if(cart.total_products_count > 0){
                if($('.cart-amount-holder').hasClass('first-time-update')){

                    $('.cart-products-count').html(cart.total_products_count + ' ' + vs.getNoun(cart.total_products_count, 'Товар', 'Товара', 'Товаров'));

                    $('.cart-amount-holder').html(cart.amount + '&nbsp;<i class="fa fa-ruble"></i>');
                    //$('.cart-amount-holder').after('&nbsp;<i class="fa fa-ruble"></i>');

                    $('.cart-amount-holder').removeClass('first-time-update');


                    $('.current-delivery-price').html(delivery_price + ' руб');
                    $('.cart-amount-with-delivery').html(parseFloat(with_delivery).toFixed(2) + '&nbsp;<i class="fa fa-ruble"></i>')


                }else{

                    $('.cart-products-count').html(cart.total_products_count + ' ' + vs.getNoun(cart.total_products_count, 'Товар', 'Товара', 'Товаров'));

                    $('.cart-amount-holder').html(cart.amount + '&nbsp;<i class="fa fa-ruble"></i>');

                    $('.current-delivery-price').html(delivery_price + ' руб');
                    $('.cart-amount-with-delivery').html(parseFloat(with_delivery).toFixed(2) + '&nbsp;<i class="fa fa-ruble"></i>')

                }
            }else{

                $('.cart-products-count').html('0 Товаров');
                $('.cart-amount-holder').html('0.00&nbsp;<i class="fa fa-ruble"></i>');
                $('.current-delivery-price').html(delivery_price + ' руб');
                $('.cart-amount-with-delivery').html('-');

            }






        }


    };

    vs.setHandlers();


    $(document).scroll(function(){

        var scTop = $(document).scrollTop();

        if(scTop >= 57+260){
            $('body').addClass('scrolled');
        }else{
            $('body').removeClass('scrolled');
        }

    });


    setTimeout(function(){
        $('.just_loaded').removeClass('just_loaded');
    }, 3000);


});
