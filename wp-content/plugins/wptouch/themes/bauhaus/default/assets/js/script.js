$(document).ready(function () {

    var page_no = 1;
    var perPage = 30;

    var gt_info = 'Внимание! Конечный вес продукта может отличаться от заказанного.';

    var fast_search_keyword = '';

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

        disableGtButtons: function(){

            $('.gt-dd').each(function(i,e){

                var gr_dec = $(e).find('.sc-gr-dec');
                var kg_dec = $(e).find('.sc-kg-dec');

                gr_dec.removeClass('disabled');
                kg_dec.removeClass('disabled');

                var weight = +$(e).find('.gt-value').html();

                if(weight < 0.1){
                    gr_dec.addClass('disabled');
                }

                if(weight < 1){
                    kg_dec.addClass('disabled');
                }

            });

        },

        setGtHandlers: function(){

            $('.sc-gr-dec').off('click').on('click', function(){

                if($(this).hasClass('disabled')){
                    return;
                }

                var p = $(this).parents('.gt-dd').eq(0);
                var weight_holder = p.find('.gt-value');
                var price_holder = p.find('.gt-price-total');
                var weight = +weight_holder.html();

                var price = +p.find('.product-item-price-int').html();

                var newWeight = weight -= 0.1;
                var newPrice = price * newWeight;

                weight_holder.html(parseFloat(newWeight).toFixed(1));
                price_holder.html(parseFloat(newPrice).toFixed(2));

                vs.disableGtButtons();

            });

            $('.sc-gr-inc').off('click').on('click', function(){
                if($(this).hasClass('disabled')){
                    return;
                }


                var p = $(this).parents('.gt-dd').eq(0);
                var weight_holder = p.find('.gt-value');
                var price_holder = p.find('.gt-price-total');
                var weight = +weight_holder.html();
                var price = +p.find('.product-item-price-int').html();

                var newWeight = weight + 0.1;
                var newPrice = price * newWeight;

                weight_holder.html(parseFloat(newWeight).toFixed(1));
                price_holder.html(parseFloat(newPrice).toFixed(2));

                vs.disableGtButtons();

            });

            $('.sc-kg-dec').off('click').on('click', function(){
                if($(this).hasClass('disabled')){
                    return;
                }

                var p = $(this).parents('.gt-dd').eq(0);
                var weight_holder = p.find('.gt-value');
                var price_holder = p.find('.gt-price-total');
                var weight = +weight_holder.html();
                var price = +p.find('.product-item-price-int').html();

                var newWeight = weight -= 1;
                var newPrice = price * newWeight;

                weight_holder.html(parseFloat(newWeight).toFixed(1));
                price_holder.html(parseFloat(newPrice).toFixed(2));

                vs.disableGtButtons();
            });

            $('.sc-kg-inc').off('click').on('click', function(){
                if($(this).hasClass('disabled')){
                    return;
                }

                var p = $(this).parents('.gt-dd').eq(0);
                var weight_holder = p.find('.gt-value');
                var price_holder = p.find('.gt-price-total');
                var weight = +weight_holder.html();
                var price = +p.find('.product-item-price-int').html();

                var newWeight = weight += 1;
                var newPrice = price * newWeight;

                weight_holder.html(parseFloat(newWeight).toFixed(1));
                price_holder.html(parseFloat(newPrice).toFixed(2));

                vs.disableGtButtons();
            });

            $('.gt-cancel').off('click').on('click', function(){

                var p = $(this).parents('.gt-dd').eq(0);
                p.remove();

            });

            $('.gt-confirm').off('click').on('click', function(){

                var p = $(this).parents('.gt-dd').eq(0);
                var pid = p.parents('.product-item').eq(0).attr('data-id') || p.parents('.cart-item').eq(0).attr('data-id');
                var weight = p.find('.gt-value').html();


                var o = {
                    command: 'add_product_in_cart',
                    params: {
                        product_id: pid,
                        is_replace: true,
                        product_count: parseFloat(weight).toFixed(1)
                    }
                };

                if($(this).parents('.cart-item').length > 0){
                    vs.loader(true, p, 'Загрузка...');
                }else{
                    vs.loader(true, p, 'Загрузка...');
                }

                socketQuery_site(o, function(res){
                    if(res.code){
                        console.log(res);
                        toastr[res.toastr.type](res.toastr.message);
                        vs.loader(false);
                        return false;
                    }
                    console.log(res);

                    vs.updateBasket(res.cart);
                    vs.reloadGtCard(pid);
                });

            });


        },

        reloadGtCard: function(pid){

            var o = {
                command: 'get_product',
                params: {
                    id: pid
                }
            };

            socketQuery_site(o, function (res) {

                if(!res.code){

                    var jRes = jsonToObj(res);

                    var btn_html = '';
                    var added = '';

                    if(jRes[0].in_basket_count == 0){
                        btn_html = '<div class="first-add-cart gramm-type">В корзину</div>';
                    }else{
                        added = 'added';
                        btn_html = '<div class="modify-gt-value gramm-type added" data-id="{{id}}">'+
                            '<div class="gt-ib-values-holder">'+
                            '<div class="gt-ib-count">'+
                            '<span class="gt-ib-count-int">{{in_basket_count}}</span>'+
                            'кг</div>'+
                            '</div>'+
                            '<div class="gt-ib-modify">'+
                            '<div class="gt-ib-amount">{{amount}} р.</div>'+
                            '<div class="gt-ib-modify-text">Изменить</div>';
                    }



                    var product_tpl =   '<div class="product-item" data-id="{{id}}">'+
                        '<div class="product-image-holder">'+
                            '<img src="{{image}}" alt="{{name}}"></div>'+
                            '<div class="product-info-holder">'+
                                '<div class="product-name-holder">Перец оранжевый 1кг</div>'+
                                '<div class="product-price-holder">'+
                                    '<span class="product-item-price-int">329.70</span>'+
                                    '<span class="price-rub">&nbsp;руб/кг</span>'+
                                '</div>'+
                            '</div>'+
                        '<div class="product-add-holder sc-product-add '+added+'" data-id="{{id}}">'+

                        btn_html+

                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';

                    jRes[0].amount = parseFloat(parseFloat(jRes[0].price_site).toFixed(2) * parseFloat(jRes[0].in_basket_count).toFixed(2)).toFixed(2);


                    if(document.location.href.indexOf('cart') > -1 || document.location.href.indexOf('prepare_order') > -1){

                        var cart_item_card = $('.cart-item[data-id="'+pid+'"]');

                        if(jRes[0].in_basket_count == 0){
                            cart_item_card.remove();
                        }else{
                            cart_item_card.find('.cart-item-qnt-value').html(jRes[0].in_basket_count);
                            cart_item_card.find('.cart-item-total-value').html(jRes[0].amount);
                            cart_item_card.find('.gt-dd').remove();
                        }



                    }else{
                        $('.product-item[data-id="'+pid+'"]').replaceWith(Mustache.to_html(product_tpl, jRes[0]));
                    }


                    vs.setHandlers();

                }else{
                    console.log('ERROR');
                }


                vs.loader(false);
            });




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

            $('.first-add-cart, .inc-btn-inc, .modify-gt-value').off('click').on('click', function(){

                var btn = $(this).parents('.product-add-holder').eq(0);
                var pid = btn.attr('data-id');

                var p_card = btn.parents('.product-item').eq(0);
                var price_html = p_card.find('.product-price-holder').html();
                var p_card_width = p_card.outerWidth();

                var name = p_card.find('.product-name-holder').html();

                var current_weight = '0.0';
                var current_amount = '0.00';

                if(!isNaN(parseFloat(p_card.find('.gt-ib-count-int').html()).toFixed(1))){
                    current_weight = parseFloat(p_card.find('.gt-ib-count-int').html()).toFixed(1);
                    current_amount = parseFloat(parseFloat(p_card.find('.product-item-price-int').html()).toFixed(2) * current_weight).toFixed(2);
                }

                if($(this).hasClass('gramm-type')){

                    var dd = '<div class="gt-dd" style="">' +
                        '<div class="gt-dd-inner">' +

                        '<div class="gt-name">'+name+'</div>' +
                        '<div class="gt-price">Цена: '+price_html+'</div>' +

                        '<div class="gt-gr-controls">' +
                        '<div class="gr-dec sc-gr-dec gt-control unselectable">100 гр<i class="fa fa-minus"></i></div>' +
                        '<div class="gr-inc sc-gr-inc gt-control unselectable">100 гр<i class="fa fa-plus"></i></div>' +
                        '</div>' +

                        '<div class="gt-kg-controls">' +
                        '<div class="kg-dec sc-kg-dec gt-control unselectable">1 кг<i class="fa fa-minus"></i></div>' +
                        '<div class="kg-inc sc-kg-inc gt-control unselectable">1 кг<i class="fa fa-plus"></i></div>' +
                        '</div>' +

                        '<div class="gt-value-holder"><span class="gt-value">'+current_weight+'</span> кг</div>' +

                        '<div class="gt-total-price-holder"><span class="gt-price-total">'+current_amount+'</span> руб.</div>' +

                        '<div class="gt-info">'+gt_info+'</div>' +

                        '<div class="gt-buttons-holder">' +
                        '<div class="gt-cancel">Отмена</div>'+
                        '<div class="gt-confirm">Подтвердить</div>' +
                        '</div>'+

                        '</div>' +
                        '</div>';

                    btn.prepend(dd);
                    vs.setGtHandlers();
                    vs.disableGtButtons();

                }else{
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

                }










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


                var btn = $(this).parents('.cart-item-qnt').eq(0);
                var pid = $(this).attr('data-id');
                var p_card = btn.parents('.cart-item').eq(0);
                var value_place = $(this).parents('.cart-item-qnt').eq(0).find('.cart-item-qnt-value');
                var item_total = $(this).parents('.cart-item-prices').eq(0).find('.cart-item-total-value');
                var item_price = $(this).attr('data-price');
                var price_html = p_card.find('.cart-item-single-price').html();
                var name = p_card.find('.cart-item-title').html();

                var current_weight = '0.0';
                var current_amount = '0.00';

                if(!isNaN(parseFloat(p_card.find('.cart-item-qnt-value').html()).toFixed(1))){
                    current_weight = parseFloat(p_card.find('.cart-item-qnt-value').html()).toFixed(1);
                    current_amount = parseFloat(parseFloat(p_card.find('.product-item-price-int').html()).toFixed(2) * current_weight).toFixed(2);
                }

                if($(this).hasClass('gramm-type')){

                    var dd = '<div class="gt-dd">' +
                        '<div class="gt-dd-inner">' +

                        '<div class="gt-name">'+name+'</div>' +
                        '<div class="gt-price">'+price_html+'</div>' +

                        '<div class="gt-gr-controls">' +
                        '<div class="gr-dec sc-gr-dec gt-control unselectable">100 гр<i class="fa fa-minus"></i></div>' +
                        '<div class="gr-inc sc-gr-inc gt-control unselectable">100 гр<i class="fa fa-plus"></i></div>' +
                        '</div>' +

                        '<div class="gt-kg-controls">' +
                        '<div class="kg-dec sc-kg-dec gt-control unselectable">1 кг<i class="fa fa-minus"></i></div>' +
                        '<div class="kg-inc sc-kg-inc gt-control unselectable">1 кг<i class="fa fa-plus"></i></div>' +
                        '</div>' +

                        '<div class="gt-value-holder"><span class="gt-value">'+current_weight+'</span> кг</div>' +

                        '<div class="gt-total-price-holder"><span class="gt-price-total">'+current_amount+'</span> руб.</div>' +

                        '<div class="gt-info">'+gt_info+'</div>' +

                        '<div class="gt-buttons-holder">' +
                        '<div class="gt-cancel">Отмена</div>'+
                        '<div class="gt-confirm">Подтвердить</div>' +
                        '</div>'+

                        '</div>' +
                        '</div>';

                    btn.prepend(dd);
                    vs.setGtHandlers();
                    vs.disableGtButtons();

                }else{
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
                            toastr[res.toastr.type](res.toastr.message);
                        }




                    });
                }




            });


            $('.cart-item-qnt-dec').off('click').on('click', function(){

                var btn = $(this).parents('.cart-item-qnt').eq(0);
                var parent_row = $(this).parents('.cart-item').eq(0);
                var value_place = $(this).parents('.cart-item-qnt').eq(0).find('.cart-item-qnt-value');
                var item_total = $(this).parents('.cart-item-prices').eq(0).find('.cart-item-total-value');
                var item_price = $(this).attr('data-price');
                var pid = $(this).attr('data-id');
                var p_card = btn.parents('.cart-item').eq(0);
                var price_html = p_card.find('.cart-item-single-price').html();
                var name = p_card.find('.cart-item-title').html();
                var current_weight = '0.0';
                var current_amount = '0.00';

                if(!isNaN(parseFloat(p_card.find('.cart-item-qnt-value').html()).toFixed(1))){
                    current_weight = parseFloat(p_card.find('.cart-item-qnt-value').html()).toFixed(1);
                    current_amount = parseFloat(parseFloat(p_card.find('.product-item-price-int').html()).toFixed(2) * current_weight).toFixed(2);
                }

                if($(this).hasClass('gramm-type')){

                    var dd = '<div class="gt-dd">' +
                        '<div class="gt-dd-inner">' +

                        '<div class="gt-name">'+name+'</div>' +
                        '<div class="gt-price">'+price_html+'</div>' +

                        '<div class="gt-gr-controls">' +
                        '<div class="gr-dec sc-gr-dec gt-control unselectable">100 гр<i class="fa fa-minus"></i></div>' +
                        '<div class="gr-inc sc-gr-inc gt-control unselectable">100 гр<i class="fa fa-plus"></i></div>' +
                        '</div>' +

                        '<div class="gt-kg-controls">' +
                        '<div class="kg-dec sc-kg-dec gt-control unselectable">1 кг<i class="fa fa-minus"></i></div>' +
                        '<div class="kg-inc sc-kg-inc gt-control unselectable">1 кг<i class="fa fa-plus"></i></div>' +
                        '</div>' +

                        '<div class="gt-value-holder"><span class="gt-value">'+current_weight+'</span> кг</div>' +

                        '<div class="gt-total-price-holder"><span class="gt-price-total">'+current_amount+'</span> руб.</div>' +

                        '<div class="gt-info">'+gt_info+'</div>' +

                        '<div class="gt-buttons-holder">' +
                        '<div class="gt-cancel">Отмена</div>'+
                        '<div class="gt-confirm">Подтвердить</div>' +
                        '</div>'+

                        '</div>' +
                        '</div>';

                    btn.prepend(dd);
                    vs.setGtHandlers();
                    vs.disableGtButtons();

                }else{
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

                                if(document.location.href.indexOf('account') == -1){
                                    parent_row.remove();
                                }else{
                                    parent_row.find('.cart-item-qnt-value').html(0);
                                    parent_row.find('.cart-item-total-value').html(0.00);
                                }



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
                            toastr[res.toastr.type](res.toastr.message);
                        }

                    });
                }



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

                if(fast_search_keyword.length > 0){
                    o.params.search_keyword = fast_search_keyword;
                }


                if(cat_id != 'EMPTY'){
                    o.params.category_id = cat_id;
                }

                if(search_keyword != 'EMPTY'){
                    o.params.search_keyword = search_keyword;
                }

                socketQuery_site(o, function(res){


                    var tpl = '{{#products}}<a class="product-item" data-id="{{id}}">'+
                                '<div class="product-image-holder"><img src="{{image}}" alt=" {{name}}"/></div>'+
                                '<div class="product-info-holder"><div class="product-name-holder">{{name}}</div>'+
                                '<div class="product-price-holder">{{price_site}}&nbsp;<i class="fa fa-ruble"></i></div></div>'+

                                '<div class="product-add-holder sc-product-add "  data-id="{{id}}">{{{btn_html}}}</div></a>{{/products}}';



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
                        toastr[res.toastr.type](res.toastr.message);
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
                var comment =           $('#comment').val();
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
                            toastr[res.toastr.type](res.toastr.message);
                        }

                    });

                }

            });

            $('.to-top').off('click').on('click', function(){

                $('html,body').animate({
                    scrollTop: 0
                }, 350, function(){

                });

            });

            $('#sidebar-search').off('input').on('input', function(){

                var v = $(this).val().toLowerCase();
                var elems = $('.product-item');

                fast_search_keyword = v;

                elems.show(0);

                elems.each(function(i,e){

                    var title = $(e).find('.product-name-holder').html().toLowerCase();

                    if(title.indexOf(v) == -1){

                        $(e).hide(0);

                    }

                });



            });

            $('.to-pa').off('click').on('click', function(){

                document.location.href = '/account/';

            });



            $('.pa-btn').off('click').on('click', function(){

                var html = '<div class="pa-m-header">Вход в личный кабинет</div>' +
                    '<div class="pa-m-body">' +
                    '<div class="pa-m-form">' +
                    '<label class="pa-m-label">Логин (Ваш адрес эл. почты):</label>' +
                    '<input class="pa-m-input" type="email" id="pa-login" placeholder="E-mail"/>' +
                    '<label class="pa-m-label">Пароль:</label>' +
                    '<input class="pa-m-input" type="password" id="pa-password" placeholder="Пароль"/>' +
                    '</div>' +
                    '<div class="pa-m-forgot">Забыли пароль?</div>' +
                    '<div class="pa-m-registration">Регистрация</div>' +
                    '<div class="pa-m-login-holder"><div class="pa-m-login pa-button"><i class="fa fa-unlock"></i>&nbsp;&nbsp;Войти</div></div>' +
                    '</div>';

                var r_html = '<div class="pa-m-header">Регистрация</div>' +
                    '<div class="pa-m-body">' +
                    '<div class="pa-m-form">' +
                    '<label class="pa-m-label">Укажите Ваш адрес эл. почты:</label>' +
                    '<input class="pa-m-input" type="email" id="pa-login" placeholder="E-mail"/>' +
                    '<label class="pa-m-label">Придумайте пароль:</label>' +
                    '<input class="pa-m-input" type="password" id="pa-password" placeholder="Пароль"/>' +
                    '<label class="pa-m-label">Повторите пароль:</label>' +
                    '<input class="pa-m-input" type="password" id="pa-password-rpt" placeholder="Пароль ещё раз"/>' +
                    '<label class="pa-m-label pa-m-small-label" ><input class="pa-m-input" type="checkbox" checked id="pa-subscr"/>Я согласен(а) получать информационные рассылки по проводимым акциям и скидкам.</label>' +
                    '<div class="pa-m-label pa-agree">Нажимая зарегистрироваться Вы принимаете <a target="_blank" href="http://valet24.ru/docs/main_agreement.pdf">условия пользовательского соглашения</a>.</div>' +
                    '</div>' +
                    '<div class="pa-m-back-to-login"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Вход в личный кабинет</div>' +
                    '<div class="pa-m-login-holder"><div class="pa-m-register pa-button"><i class="fa fa-user"></i>&nbsp;&nbsp;Зарегистрироваться</div></div>' +
                    '</div>';

                var inner_handlers = function(){

                    $('.pa-m-registration').off('click').on('click', function(){

                        vs.faderModal(true, r_html, inner_handlers);

                    });

                    $('.pa-m-back-to-login').off('click').on('click', function(){

                        vs.faderModal(true, html, inner_handlers);

                    });


                    $('.pa-m-register').off('click').on('click', function(){



                        var email = $('#pa-login').val();
                        var pass = $('#pa-password').val();
                        var pass2 = $('#pa-password-rpt').val();

                        if(email.length == 0){
                            toastr['warning']('Заполните поле Email');
                        }
                        if(pass.length == 0){
                            toastr['warning']('Заполните поле Пароль');
                        }
                        if(pass2.length == 0){
                            toastr['warning']('Заполните поле Повторите пароль');
                        }

                        if(pass.length == 0 || email.length == 0 || pass2.length == 0){
                            return;
                        }else if(pass !== pass2){
                            toastr['warning']('Пароли должны совпадать.');
                        }else{

                            var o = {
                                command: 'registration',
                                params: {
                                    email: email,
                                    password: pass,
                                    password_2: pass2
                                }
                            };

                            socketQuery_site(o, function(res){

                                if(!res.code){

                                    document.location.href = '/confirm_email/';

                                }else{

                                    toastr['error'](res.toastr.message);

                                }

                            });
                        }
                    });

                    $('.pa-m-login').off('click').on('click', function(){

                        var email = $('#pa-login').val();
                        var pass = $('#pa-password').val();

                        if(email.length == 0){
                            toastr['warning']('Заполните поле Email');
                        }
                        if(pass.length == 0){
                            toastr['warning']('Заполните поле Пароль');
                        }
                        if(pass.length == 0 || email.length == 0){
                            return;
                        }else{

                            var o = {
                                command: 'login',
                                params: {
                                    email: email,
                                    password: pass
                                }
                            };

                            socketQuery_site(o, function(res){

                                if(!res.code){

                                    document.location.reload();

                                }else{

                                    toastr['error'](res.toastr.message);

                                }

                            });
                        }
                    });

                    $('.pa-m-forgot').off('click').on('click', function(){

                        var email = $('#pa-login').val();

                        if(email.length == 0){
                            toastr['warning']('Укажите Ваш Email');
                        }else{
                            var o = {
                                command: 'restore_account',
                                params: {
                                    email: $('#pa-login').val()
                                }
                            };

                            socketQuery_site(o, function(res){

                                if(!res.code){

                                    toastr['info']('На Вашу почту была отправлена ссылка на восстановление пароля');

                                }else{

                                    toastr['error'](res.toastr.message);

                                }

                            });


                        }





                    });

                };

                vs.faderModal(true, html, inner_handlers);

            });

            $('.site-fader-close').off('click').on('click', function(){
                vs.faderModal(false);
            });





            $('.cart-item-to-favorite').off('click').on('click', function(){

                var o = {};
                var self = this;

                if($(self).hasClass('in_favorite')){

                    o.command = 'remove_product_from_favorite';

                }else{

                    o.command = 'add_product_to_favorite';
                }

                o.params = {
                    product_id: $(self).attr('data-id')
                };

                socketQuery_site(o, function(res){

                    if(!res.code){


                        if($(self).hasClass('in_favorite')){

                            if($(self).parents('.favorites-list').length > 0){

                                toastr['info']('Продукт удален из избранного.');

                                $(self).parents('.cart-item').eq(0).remove();

                            }else{
                                toastr['info']('Продукт удален из избранного.');

                                $(self).removeClass('in_favorite');
                            }



                        }else{

                            toastr['info']('Продукт добавлен в избранное!');

                            $(self).addClass('in_favorite');

                        }



                    }else{
                        toastr[res.toastr.type](res.toastr.message);
                    }

                });

            });

            $('.account-exit').off('click').on('click', function(){


                var o = {
                    command: 'logout',
                    params: {
                        id: $(this).attr('data-id')
                    }
                };

                socketQuery_site(o, function(res){

                    if(!res.code){

                        document.location.href = '/';

                    }else{

                        toastr['error'](res.toastr.message);

                    }

                });


            });

            $('.c-item-open').off('click').on('click', function(){

                var self = this;
                var o_id = $(self).attr('data-id');
                var p = $(self).parents('.c-item-wrapper');

                if(p.hasClass('opened')){
                    p.toggleClass('opened');
                }else{

                    var o = {
                        command: 'get_order_products',
                        params: {
                            order_id: o_id
                        }
                    };

                    socketQuery_site(o, function(res){

                        var jRes = jsonToObj(res);

                        if(!res.code){

                            console.log(jRes);

                            var tpl = '{{#products}}<div class="cart-item cart-sidebar-tpl" data-id="{{product_id}}">'+
                                            '<div class="cart-item-image-holder">'+
                                                '<img src="{{image}}" alt="{{name}}"/>'+
                                            '</div>'+
                                            '<div class="cart-item-info-holder">'+
                                                '<div class="cart-item-title">{{name}}<span class="obp-count">х{{product_count}}</span></div>'+
                                                '<div class="cart-item-prices">'+
                                                    '<div class="cart-item-price">'+
                                                        '<div class="cart-item-single-price">Цена: <span class="product-item-price-int">{{price}}</span> <i class="fa fa-ruble"></i></div>'+
                                                        '<div class="cart-item-qnt">'+
                                                            '<div class="cart-item-qnt-dec {{is_gramm_html}} fa fa-minus-circle" data-id="{{product_id}}" data-price="{{price}}"></div>'+
                                                            '<div class="cart-item-qnt-value-holder"><span class="cart-item-qnt-value">{{in_basket_count}}</span> {{it_or_kg}}</div>'+
                                                            '<div class="cart-item-qnt-inc {{is_gramm_html}} fa fa-plus-circle" data-id="{{product_id}}" data-price="{{price}}"></div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
//                                            '<div class="cart-item-total"><span class="cart-item-total-value">{{total}}</span> <i class="fa fa-ruble"></i></div>'+
                                            '</div>'+
                                        '</div>{{/products}}';


                            var mO = {
                                products: []
                            };



                            for(var i in jRes){

                                jRes[i].image = (jRes[i].image.length > 0) ? jRes[i]['image'] : global_images_dir + 'cat-default.jpg';

                                jRes[i].is_gramm = (jRes[i]['qnt_type_sys'] == 'KG');

                                jRes[i].is_gramm_html = (jRes[i].is_gramm)? 'gramm-type': '';

                                jRes[i].it_or_kg = jRes[i]['qnt_type'];

                                jRes[i]['product_count'] = parseFloat(jRes[i]['product_count']);

                                jRes[i].in_basket_count = jRes[i]['in_basket_count'] || 0;

                                jRes[i].total = parseFloat(jRes[i]['price'] * jRes[i].in_basket_count).toFixed(2);



                                mO.products.push(jRes[i]);
                            }

                            $('.cart-list-holder[data-id="'+o_id+'"]').html(Mustache.to_html(tpl, mO));


                            vs.setHandlers();

                            var p = $(self).parents('.c-item-wrapper');
                            p.toggleClass('opened');

                        }else{
                            toastr[res.toastr.type](res.toastr.message);
                        }

                    });


                }

            });

            $('.account-edit-back').off('click').on('click', function(){

                document.location.href = '/account/';

            });

            $('.account-edit').off('click').on('click', function(){

                document.location.href = '/account_edit/';

            });

            $('.save-account').off('click').on('click', function(){

                var address =           $('#address').val();
                var name =              $('#name').val();
                var phone =             $('#phone').val();
                var email =             $('#email').val();
                var gate =              $('#gate').val();
                var gatecode =          $('#gatecode').val();
                var level =             $('#level').val();
                var flat =              $('#flat').val();

                var o = {
                    command: 'modify_account',
                    params: {
                        address         :address,
                        name            :name,
                        phone           :phone,
                        email           :email,
                        gate            :gate,
                        gatecode        :gatecode,
                        level           :level,
                        flat            :flat,
                        id              : $('.save-account').attr('data-id')
                    }
                };


                $('.save-account').html('<i class="fa fa-spin fa-spinner"></i>');

                socketQuery_site(o, function(res){

                    if(!res.code){

                        document.location.reload();

                    }else{
                        toastr[res.toastr.type](res.toastr.message);
                    }

                });

            });

            $('.pa-m-register-order').off('click').on('click', function(){

                var pass = $('#pa-o-password').val();
                var pass2 = $('#pa-o-password-rpt').val();
                var key = $('.pa-m-register-order').attr('data-key');
                var key2 = $('.pa-m-register-order').attr('data-key2');

                if(pass.length == 0){
                    toastr['warning']('Заполните поле Пароль');
                }
                if(pass2.length == 0){
                    toastr['warning']('Заполните поле Повторите пароль');
                }

                if(pass.length == 0 || pass2.length == 0){
                    return;
                }else if(pass !== pass2){
                    toastr['warning']('Пароли должны совпадать.');
                }else{

                    var o = {
                        command: 'confirm_registration',
                        params: {
                            password: pass,
                            password_2: pass2,
                            confirm_key: key,
                            confirm_key2: key2
                        }
                    };

                    socketQuery_site(o, function(res){

                        if(!res.code){

                            document.location.href = '/account/';

                        }else{

                            toastr['error'](res.toastr.message);

                        }

                    });
                }


            });

            $('.c-item-to-basket').off('click').on('click', function(){

                var self = this;

                var o = {
                    command: 'repeat_order',
                    params: {
                        order_id: $(self).attr('data-id')
                    }
                };

                socketQuery_site(o, function(res){

                    if(!res.code){

                        toastr[res.toastr.type](res.toastr.message);

                        vs.updateBasket(res.cart);
                        vs.setHandlers();


                    }else{
                        toastr[res.toastr.type](res.toastr.message);
                    }

                });


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






        },

        loader: function(state, elem, text){

            if(!elem){
                $('.mbw-loader-holder').remove();
                return false;
            }

            if(state){
                text = text || '';
                var tpl = '<div class="mbw-loader-holder" style="display: block;">' +
                    '<div class="mbw-loader-gif"></div>' +
                    '<div class="mbw-loader-text">'+text+'</div>' +
                    '<div class="mbw-loader-buttons"></div></div>';
                elem.prepend(tpl);
            }else{
                elem.find('.mbw-loader-holder').remove();
            }
        },

        faderModal: function(state, html, cb){

            var f_h = $('.site-fader-holder');
            var f_c = $('.site-fader-content');


            f_c.html('');

            html = html || '';

            if(state){

                f_c.html(html);

                f_h.css({zIndex: 10020});

                f_h.animate({
                    opacity: 1
                }, 320, function(){

                    if(typeof cb == 'function'){
                        cb();
                    }


                });

            }else{

                f_h.animate({
                    opacity: 0
                }, 320, function(){
                    f_h.css({zIndex: -1});

                    if(typeof cb == 'function'){
                        cb();
                    }

                });

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


    uiTabs();

});
