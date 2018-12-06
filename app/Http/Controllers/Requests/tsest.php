<?php
add_theme_support( 'post-thumbnails' );
?>
<?php
add_filter( 'manage_post_posts_columns', 'my_manage_customfield_posts_columns' );
function my_manage_customfield_posts_columns( $columns ) {
    $columns['artistsname'] = esc_html__( 'artistsname');

    return $columns;
}
?>
<?php
function comment_loop_cd( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            ?>
            <li class="post pingback">
            <p>بازتاب: <?php comment_author_link(); ?><?php edit_comment_link( 'ویرایش', '<span class="edit-link">', '</span>' ); ?></p>
            <?php
            break;
        default :
            ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <footer class="comment-meta">
                    <div class="br-com"></div>
                    <div class="comment-author vcard">
                        <?php
                        $avatar_size = 40;
                        if ( '0' != $comment->comment_parent )
                            $avatar_size = 40;

                        echo get_avatar( $comment, $avatar_size );

                        /* translators: 1: comment author, 2: date and time */
                        printf( '%1$s',
                            sprintf( '<span class="fn">%s می گه:</span>', get_comment_author_link() ),
                            sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                get_comment_time( 'c' ),
                                /* translators: 1: date, 2: time */
                                sprintf( '%1$s ، %2$s', get_comment_date("d M Y"), get_comment_time() )
                            )
                        );
                        ?>
                        <div class="comment-date"><?php
                            $d =comment_time('H:i').' مورخه '."d M y";
                            $comment_date = get_comment_date( $d, $comment_ID );
                            echo $comment_date;
                            ?></div>
                        <?php edit_comment_link( '(ویرایش)', '<span class="edit-link">', '</span>' ); ?>
                    </div><!-- .comment-author .vcard ronakweb.com - rkianoosh.ir -->
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em class="comment-awaiting-moderation">نظر شما بعد از تائید نمایش داده میشود.</em>
                        <br>
                    <?php endif; ?>
                </footer>
                <div class="comment-content"><?php comment_text(); ?></div>
                <div class="clear comment-replay"><?php echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'])); ?> </div>
                <div class="clear"></div>
            </article><!-- #comment-## ronakweb.com - rkianoosh.ir -->
            <?php
            break;
    endswitch;
}
function comment_form_cd( $args = array(), $post_id = null ) {
    global $id;
    if ( null === $post_id )
        $post_id = $id;
    else
        $id = $post_id;
    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = ! empty( $user->ID ) ? $user->display_name : '';
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(
        'author' => '<div class="right-commentss"><p class="comment-form-author">' . '<input id="author" class="meta" name="author" type="text" placeholder="نام ( مورد نیاز )" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
        'email'  => '<p class="comment-form-email"><input id="email" class="meta" name="email" type="text" placeholder="پست الکترونیکی (مورد نیاز)" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
        'url'    => '<p class="comment-form-url">' . '<input id="url" class="meta" name="url" type="text" placeholder="عنوان" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div>',
    );
    $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
    $defaults = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="11" aria-required="true" placeholder="نظرتان را بنویسید"></textarea></p>',
        'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'comment_notes_before' => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => __( '' ),
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => 'ارسال دیدگاه',
    );
    //'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) ); ?>
    <?php if ( comments_open() ) : ?>
        <?php do_action( 'comment_form_before' ); ?>
        <div id="respond">
            <h3 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
            <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                <?php echo $args['must_log_in']; ?>
                <?php do_action( 'comment_form_must_log_in_after' ); ?>
            <?php else : ?>
                <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
                    <?php do_action( 'comment_form_top' ); ?>
                    <?php if ( is_user_logged_in() ) : ?>
                        <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                        <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                    <?php else : ?>
                        <?php echo $args['comment_notes_before']; ?>
                        <?php
                        do_action( 'comment_form_before_fields' );
                        foreach ( (array) $args['fields'] as $name => $field ) {
                            echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                        }
                        do_action( 'comment_form_after_fields' );
                        ?>
                    <?php endif; ?>
                    <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
                    <?php echo $args['comment_notes_after']; ?>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
                        <?php comment_id_fields( $post_id ); ?>
                    </p>
                    <?php do_action( 'comment_form', $post_id ); ?>
                </form>
            <?php endif; ?>
        </div><!-- #respond ronakweb.com - rkianoosh.ir -->
        <?php do_action( 'comment_form_after' ); ?>
    <?php else : ?>
        <?php do_action( 'comment_form_comments_closed' ); ?>
    <?php endif; ?>
    <?php
}
?>