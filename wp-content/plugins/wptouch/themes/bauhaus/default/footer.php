		<?php do_action( 'wptouch_body_bottom' ); ?>

		<?php get_template_part( 'footer-top' ); ?>
		
		<div class="<?php wptouch_footer_classes(); ?>">
			<?php wptouch_footer(); ?>
		</div>
		
		<?php if ( !is_front_page() ) { ?>
			<a href="#" class="back-to-top"><?php _e( 'Back to top', 'wptouch-pro' ); ?></a>
		<?php } ?>

		<?php do_action( 'wptouch_language_insert' ); ?>

		<?php get_template_part( 'switch-link' ); ?>
	</dv><!-- content wrap -->
	</div><!-- page wrapper -->


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

</body>
</html>
