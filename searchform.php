<?php defined( 'ABSPATH' ) or die(); ?>

<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
    <label class="screen-reader-text" for="s"><?php esc_html_e( 'Search', 'ikonwp' ); ?></label>
    <div class="input-group input-group-sm">
        <input type="text" name="s" id="s" class="form-control"
               placeholder="<?php esc_attr_e( 'Start typing...', 'ikonwp' ); ?>" value="<?php the_search_query(); ?>">
        <div class="input-group-append">
            <input class="submit btn btn-primary" id="searchsubmit" name="submit" type="submit"
                   value="<?php esc_attr_e( 'Search', 'ikonwp' ); ?>">
        </div>
    </div>
</form>