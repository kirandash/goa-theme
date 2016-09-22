<?php
    /*
        This is the template for the header
        @package goa-theme
    */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <title><?php bloginfo( 'name' ); wp_title(); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
            <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
    
    <body <?php body_class(); ?>>
        
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <header class="header-container background-image text-center" style="background-image: url(<?php header_image(); ?>); ">
                        
                        <div class="header-content table">
                            <div class="table-cell">
                                <h1 class="site-title goa-icon">
                                    <span class="goa-logo"></span>
                                    <span class="hide"><?php bloginfo( 'name' ); ?></span>
                                </h1>
                                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                            </div>
                        </div><!-- .header-container -->
                        
                        <div class="nav-container">
                            
                            <nav class="navbar navbar-goa">
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location'    => 'primary',
                                        'container'         => false,
                                        'menu_class'        => 'nav navbar-nav'
                                    ) );
                                ?>
                            </nav>
                            
                        </div><!-- .nav-container -->
                        
                    </header><!-- .header-container -->
                </div><!-- .col-xs-12 -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->