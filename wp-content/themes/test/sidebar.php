<div class="wrapper-aside-left col-sm-3">
    <aside class="aside-left">
    <?php
    wp_nav_menu( array(
    'theme_location'  => 'left',
    'menu'            => '',
    'container'       => '',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'menu',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth'           => 0,
    'walker'          => '',
    ) );
    ?>
        <?php dynamic_sidebar('easywp-left-sidebar'); ?>

<!--        <ul>-->
<!--            <li class="aside-left-items">-->
<!--                <a href="#">-->
<!--                    <div class="wrapper-aside-left-items-img">-->
<!--                        <img src="--><?php //echo get_stylesheet_directory_uri();?><!--/images/man-user.png" alt="man-user-icon">-->
<!--                    </div>-->
<!--                    <div class="wrapper-aside-left-items-text">-->
<!--                        <span>Особистий кабінет</span>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </li>-->

<!--            <li class="aside-left-items">-->
<!--                <a href="#">-->
<!--                    <div class="wrapper-aside-left-items-img"><img src="--><?php //echo get_stylesheet_directory_uri();?><!--/images/invoice.png" alt="invoice-icon"></div>-->
<!--                    <div class="wrapper-aside-left-items-text">-->
<!--                        <span>Подати показання лічильників</span>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </li>-->

<!--            <li class="aside-left-items">-->
<!--                <a href="#">-->
<!--                    <div class="wrapper-aside-left-items-img"><img src="--><?php //echo get_stylesheet_directory_uri();?><!--/images/online-pay.png" alt="online-pay-icon"></div>-->
<!--                    <div class="wrapper-aside-left-items-text">-->
<!--                        <span>Сплатити послуги</span>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </li>-->
<!---->
<!--            <li class="aside-left-items"><a href="#">-->
<!--                    <div class="wrapper-aside-left-items-img"><img src="--><?php //echo get_stylesheet_directory_uri();?><!--/images/group-of-users-silhouette.png" alt="group-of-users-silhouette-icon"></div>-->
<!--                    <div class="wrapper-aside-left-items-text">-->
<!--                        <span>Абонентний відділ</span>-->
<!--                    </div></a>-->
<!--            </li>-->
<!--        </ul>-->
    </aside>
</div>