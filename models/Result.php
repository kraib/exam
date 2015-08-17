<!DOCTYPE html>
<?php $settings = get_option(SH_NAME.'_theme_options');global $woocommerce;?>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description');?>" />
    <meta name="keywords" content="" />
    <?php echo ( sh_set( $settings, 'favicon' ) ) ? '<link rel="icon" type="image/png" href="'.esc_attr(sh_set( $settings, 'favicon' )).'">': '';?>
    <?php wp_head();?>
</head>
<?php $body_pattern = (sh_set($settings, 'header_five_pattern') && sh_set($settings, 'custom_header') == 'header6') ? 'style="background:url('.esc_html(sh_set($settings, 'header_five_pattern')).')"':'';?>
<?php $body_class = (sh_set($settings, 'custom_header') == 'header6') ? 'sideheader-page' : '';?>
<body <?php body_class($body_class);?> <?php echo $body_pattern;?>>

<div class="theme-layout <?php echo (sh_set($settings, 'boxed_layout_status')) ? 'boxed' : '';?> <?php echo ((!(is_home() || is_front_page()) && sh_set($settings, 'custom_header') == 'header5') || (sh_set($settings, 'custom_header') == 'header5' && $wp_query->is_posts_page)) ? 'header-inner' : '';?>" <?php echo (sh_set($settings, 'boxed_top') && sh_set($settings, 'boxed_layout_status')) ? 'style="margin-top:'.sh_set($settings, 'boxed_top').';"' : '';?>>
    <?php include "header-1.php";?>
    <?php do_action('_sh_responsive_header');?>
    <?php if(sh_set($settings, 'show_cart') || (sh_set($settings, 'show_login') && !is_user_logged_in())):?>
        <div class="sticky-btns">
            <?php if(sh_set($settings, 'show_cart') && is_object($woocommerce)):?>
                <a class="shopping-btn" href="#" title=""><img src="<?php echo get_template_directory_uri()?>/images/cart-icon.png" alt="" /><span><?php echo WC()->cart->cart_contents_count; ?></span></a>
            <?php endif;?>
            <?php if(sh_set($settings, 'show_login') && !is_user_logged_in()):?>
                <a class="login-btn" href="#" title=""><img src="<?php echo get_template_directory_uri()?>/images/user-icon.png" alt="" /></a>
            <?php elseif(is_user_logged_in() && sh_set($settings, 'show_login')):?>
                <a class="logout-btn" href="<?php echo wp_logout_url(home_url()); ?>" title=""><img src="<?php echo get_template_directory_uri()?>/images/logout-icon.png" alt="" /></a>
            <?php endif;?>
            <?php echo sh_wish_list_button($settings);?>
        </div>
    <?php endif;?>
    <?php do_action('_sh_product_cart');?>
    <?php do_action('_sh_user_authentication');?>


    <!DOCTYPE html>
    <?php $settings = get_option(SH_NAME.'_theme_options');global $woocommerce;?>
    <html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo('description');?>" />
        <meta name="keywords" content="" />
        <?php echo ( sh_set( $settings, 'favicon' ) ) ? '<link rel="icon" type="image/png" href="'.esc_attr(sh_set( $settings, 'favicon' )).'">': '';?>
        <?php wp_head();?>
    </head>
    <?php $body_pattern = (sh_set($settings, 'header_five_pattern') && sh_set($settings, 'custom_header') == 'header6') ? 'style="background:url('.esc_html(sh_set($settings, 'header_five_pattern')).')"':'';?>
    <?php $body_class = (sh_set($settings, 'custom_header') == 'header6') ? 'sideheader-page' : '';?>
    <body <?php body_class($body_class);?> <?php echo $body_pattern;?>>

    <div class="theme-layout <?php echo (sh_set($settings, 'boxed_layout_status')) ? 'boxed' : '';?> <?php echo ((!(is_home() || is_front_page()) && sh_set($settings, 'custom_header') == 'header5') || (sh_set($settings, 'custom_header') == 'header5' && $wp_query->is_posts_page)) ? 'header-inner' : '';?>" <?php echo (sh_set($settings, 'boxed_top') && sh_set($settings, 'boxed_layout_status')) ? 'style="margin-top:'.sh_set($settings, 'boxed_top').';"' : '';?>>
        <?php include "header-1.php" ?>
        <?php do_action('_sh_responsive_header');?>
        <?php if(sh_set($settings, 'show_cart') || (sh_set($settings, 'show_login') && !is_user_logged_in())):?>
            <div class="sticky-btns">
                <?php if(sh_set($settings, 'show_cart') && is_object($woocommerce)):?>
                    <a class="shopping-btn" href="#" title=""><img src="<?php echo get_template_directory_uri()?>/images/cart-icon.png" alt="" /><span><?php echo WC()->cart->cart_contents_count; ?></span></a>
                <?php endif;?>
                <?php if(sh_set($settings, 'show_login') && !is_user_logged_in()):?>
                    <a class="login-btn" href="#" title=""><img src="<?php echo get_template_directory_uri()?>/images/user-icon.png" alt="" /></a>
                <?php elseif(is_user_logged_in() && sh_set($settings, 'show_login')):?>
                    <a class="logout-btn" href="<?php echo wp_logout_url(home_url()); ?>" title=""><img src="<?php echo get_template_directory_uri()?>/images/logout-icon.png" alt="" /></a>
                <?php endif;?>
                <?php echo sh_wish_list_button($settings);?>
            </div>
        <?php endif;?>
        <?php do_action('_sh_product_cart');?>
        <?php do_action('_sh_user_authentication');?>
