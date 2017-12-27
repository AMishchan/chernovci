<?php
/**
 * Template part for displaying posts.
 */
?>
<div class="social-net-block">
    <div class="wrapper-icons">

        <?php if (easywp_get_option('facebooklink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('facebooklink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Facebook', 'easywp'); ?>">
                <img class="logo-img-facebook" src="<?php echo get_stylesheet_directory_uri();?>/images/f.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('googlelink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('googlelink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Google Plus', 'easywp'); ?>">
                <img class="logo-img-google" src="<?php echo get_stylesheet_directory_uri();?>/images/g.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('pinterestlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('pinterestlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Pinterest', 'easywp'); ?>">
                <img class="logo-img-pinterest" src="<?php echo get_stylesheet_directory_uri();?>/images/pinterest.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('linkedinlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('linkedinlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Linkedin', 'easywp'); ?>">
                <img class="logo-img-linkedin" src="<?php echo get_stylesheet_directory_uri();?>/images/linkedin.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('instagramlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('instagramlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Instagram', 'easywp'); ?>">
                <img class="logo-img-instagram" src="<?php echo get_stylesheet_directory_uri();?>/images/instagram.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('flickrlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('flickrlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Flickr', 'easywp'); ?>">
                <img class="logo-img-flickr" src="<?php echo get_stylesheet_directory_uri();?>/images/flickr.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('youtubelink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('youtubelink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('youtube', 'easywp'); ?>">
                <img class="logo-img-youtube" src="<?php echo get_stylesheet_directory_uri();?>/images/youtube.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('vimeolink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('vimeolink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Vimeo', 'easywp'); ?>">
                <img class="logo-img-vimeo" src="<?php echo get_stylesheet_directory_uri();?>/images/vimeo.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('soundcloudlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('soundcloudlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Soundcloud', 'easywp'); ?>">
                <img class="logo-img-soundcloud" src="<?php echo get_stylesheet_directory_uri();?>/images/soundcloud.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('lastfmlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('lastfmlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('lastfm', 'easywp'); ?>">
                <img class="logo-img-lastfm" src="<?php echo get_stylesheet_directory_uri();?>/images/lastfm.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('githublink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('githublink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Github', 'easywp'); ?>">
                <img class="logo-img-github" src="<?php echo get_stylesheet_directory_uri();?>/images/github.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('bitbucketlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('bitbucketlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Bitbucket', 'easywp'); ?>">
                <img class="logo-img-bitbucket" src="<?php echo get_stylesheet_directory_uri();?>/images/bitbucket.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('tumblrlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('tumblrlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Tumblr', 'easywp'); ?>">
                <img class="logo-img-tumblr" src="<?php echo get_stylesheet_directory_uri();?>/images/tumblr.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('digglink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('digglink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Digg', 'easywp'); ?>">
                <img class="logo-img-digg" src="<?php echo get_stylesheet_directory_uri();?>/images/digg.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('deliciouslink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('deliciouslink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Delicious', 'easywp'); ?>">
                <img class="logo-img-delicious" src="<?php echo get_stylesheet_directory_uri();?>/images/delicious.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('stumblelink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('stumblelink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Stumbleupon', 'easywp'); ?>">
                <img class="logo-img-stumbleupon" src="<?php echo get_stylesheet_directory_uri();?>/images/stumbleupon.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('redditlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('redditlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Reddit', 'easywp'); ?>">
                <img class="logo-img-reddit" src="<?php echo get_stylesheet_directory_uri();?>/images/reddit.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('dribbblelink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('dribbblelink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Dribbble', 'easywp'); ?>">
                <img class="logo-img-dribbble" src="<?php echo get_stylesheet_directory_uri();?>/images/dribbble.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('behancelink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('behancelink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Behance', 'easywp'); ?>">
                <img class="logo-img-behance" src="<?php echo get_stylesheet_directory_uri();?>/images/behance.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('codepenlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('codepenlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Codepen', 'easywp'); ?>">
                <img class="logo-img-codepen" src="<?php echo get_stylesheet_directory_uri();?>/images/codepen.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('jsfiddlelink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('jsfiddlelink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('JSFiddle', 'easywp'); ?>">
                <img class="logo-img-jsfiddle" src="<?php echo get_stylesheet_directory_uri();?>/images/jsfiddle.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('stackoverflowlink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('stackoverflowlink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Stack Overflow', 'easywp'); ?>">
                <img class="logo-img-stackoverflow" src="<?php echo get_stylesheet_directory_uri();?>/images/stackoverflow.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('stackexchangelink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('stackexchangelink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Stack Exchange', 'easywp'); ?>">
                <img class="logo-img-stack-exchange" src="<?php echo get_stylesheet_directory_uri();?>/images/stack-exchange.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('bsalink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('bsalink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('BuySellAds', 'easywp'); ?>">
                <img class="logo-img-buysellads" src="<?php echo get_stylesheet_directory_uri();?>/images/buysellads.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('slidesharelink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('slidesharelink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('SlideShare', 'easywp'); ?>">
                <img class="logo-img-slideshare" src="<?php echo get_stylesheet_directory_uri();?>/images/slideshare.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('skypeusername')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('skypeusername')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Skype', 'easywp'); ?>">
                <img class="logo-img-skype" src="<?php echo get_stylesheet_directory_uri();?>/images/skype.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('emailaddress')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('emailaddress')); ?>"
               target="_blank"
               title="<?php esc_attr_e('Email Us', 'easywp'); ?>">
                <img class="logo-img-email" src="<?php echo get_stylesheet_directory_uri();?>/images/email.png">
            </a>
        <?php endif; ?>

        <?php if (easywp_get_option('rsslink')) : ?>
            <a href="<?php echo esc_url(easywp_get_option('rsslink')); ?>"
               target="_blank"
               title="<?php esc_attr_e('RSS', 'easywp'); ?>">
                <img class="logo-img-rss" src="<?php echo get_stylesheet_directory_uri();?>/images/rss.png">
            </a>
        <?php endif; ?>

    </div>
</div>


