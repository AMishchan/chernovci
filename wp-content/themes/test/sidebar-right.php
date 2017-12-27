<div class="wrapper-aside-right col-sm-3">
    <aside class="aside-right">
        <div class="hidden-xs">
            <?php dynamic_sidebar('easywp-right-sidebar'); ?>
        </div>
<!--                <div class="aside-right-image">-->
<!--                    <img src="--><?php //echo get_stylesheet_directory_uri();?><!--/images/Winner-PNG-Clipart.png" alt="Winner-PNG-Clipart-logo">-->
<!--                </div>-->
        <?php
        wp_nav_menu( array(
            'theme_location'  => 'right',
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

<!--        <ul>-->
<!---->
<!--            <li class="aside-right-items"><a href="#">-->
<!--                    <div class="wrapper-aside-right-items-img">-->
<!--                        <img src="--><?php //echo get_stylesheet_directory_uri();?><!--/images/partnership.png" alt="partnership-icon">-->
<!--                    </div>-->
<!--                    <div class="wrapper-aside-right-items-text">-->
<!--                        <span>Партнери</span>-->
<!--                    </div></a>-->
<!--            </li>-->
<!---->
<!--            <li class="aside-right-items"><a href="#">-->
<!--                    <div class="wrapper-aside-right-items-img">-->
<!--                        <img src="--><?php //echo get_stylesheet_directory_uri();?><!--/images/ukraine-icon.png" alt="ukraine-icon">-->
<!--                    </div>-->
<!--                    <div class="wrapper-aside-right-items-text">-->
<!--                        <span>Органи державної влади і місцевого самоврядування</span>-->
<!--                    </div></a>-->
<!--            </li>-->
<!---->
<!--            <li class="aside-right-items"><a href="#">-->
<!--                    <div class="wrapper-aside-right-items-img">-->
<!--                        <img src="--><?php //echo get_stylesheet_directory_uri();?><!--/images/three-buildings.png" alt="three-buildings-icon">-->
<!--                    </div>-->
<!--                    <div class="wrapper-aside-right-items-text">-->
<!--                        <span>Житлово-комунальні підприємства Чернівців</span>-->
<!--                    </div></a>-->
<!--            </li>-->
<!---->
<!--            <li class="aside-right-items"><a href="#">-->
<!--                    <div class="wrapper-aside-right-items-img">-->
<!--                        <img src="--><?php //echo get_stylesheet_directory_uri();?><!--/images/list.png" alt="list-icon">-->
<!--                    </div>-->
<!--                    <div class="wrapper-aside-right-items-text">-->
<!--                        <span>Перелік боржників</span>-->
<!--                    </div></a>-->
<!--            </li>-->
<!--        </ul>-->
    </aside>
</div>