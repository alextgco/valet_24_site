<?php
/**
 * Created by PhpStorm.
 * User: aig
 * Date: 29.07.2016
 * Time: 21:23
 */

include 'service_features.php';
?>




<div class="site-footer">

    <div class="container posRel">

        <div class="row">

            <div class="col-sm-4 col-md-4 footer-border-left">
                Информация:
            </div>

            <div class="col-sm-4 col-md-4 footer-border-left">
                Районы обслуживания:
            </div>

            <div class="col-sm-4 col-md-4 footer-border-left">
                Контакты:
            </div>

        </div>

    </div>

    <div class="footer-border-row">

    </div>

    <div class="container posRel">

        <div class="row footer-body">

            <div class="col-sm-4 col-md-4">
                <?php
                    $args = array(
                        'menu'            => 'footer_menu',     // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                        // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                        'container'       => 'ul',            // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                        'container_class' => 'footer-menu',     // (string) class контейнера (div тега)
                        'container_id'    => '',              // (string) id контейнера (div тега)
                        'menu_class'      => '',              // (string) class самого меню (ul тега)
                        'menu_id'         => '',              // (string) id самого меню (ul тега)
                        'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
                        'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                        'before'          => '',              // (string) Текст перед <a> каждой ссылки
                        'after'           => '',              // (string) Текст после </a> каждой ссылки
                        'link_before'     => '',              // (string) Текст перед анкором (текстом) ссылки
                        'link_after'      => '',              // (string) Текст после анкора (текста) ссылки
                        'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                        'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
                        'theme_location'  => ''               // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
                    );

                    wp_nav_menu($args)
                ?>
            </div>
            <div class="col-sm-4 col-md-4">
                <ul>
                    <li>Гагаринский</li>
                    <li>Академический</li>
                    <li>Ломоносовский</li>
                    <li>Черемушки</li>
                </ul>
            </div>
            <div class="col-sm-4 col-md-4">
                <ul>
                    <li class="footer-phone">+7 (495) 134-39-12</li>
                    <li>info@valet24.ru</li>
                    <li>Москва, Профсоюзная ул. 22</li>
                    <li class="feedback-init sc-feedback-init">Написать нам</li>
                </ul>
            </div>

        </div>
    </div>

</div>
<div class="site-after-footer">

    <div class="container posRel">

        <div class="copyright">Valet24.ru © 2017  Все права защищены.</div>

        <a target="_blank" href="http://ccs.msk.ru/?utm_source=valet24_site" class="developer">
            <div class="developed-by">Powered by</div>
            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/ccs_logo.png">
        </a>

    </div>
</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter41459989 = new Ya.Metrika({
                    id:41459989,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/41459989" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-98009298-1', 'auto');
    ga('send', 'pageview');

</script>