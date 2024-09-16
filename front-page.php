<?php
get_header();

?>


        <?php
        if (have_posts() ):
            while ( have_posts() ) : the_post() ; ?>
                <?php
                if ( have_rows('page-partials' )  ) {
                    while( have_rows('page-partials') )
                    {
                        the_row();
                        $layout = get_row_layout();
                        $inclusion = get_stylesheet_directory() . DIRECTORY_SEPARATOR . "partials" . DIRECTORY_SEPARATOR ."{$layout}.php";

                        if( file_exists( $inclusion ) )
                        {
                            include( $inclusion );
                        }

                    }
                }

            endwhile;
        endif;
        ?>

<?php
get_sidebar();
get_footer();