<?php
/**
 * dashboard customize
 *
 * @package Wordpress
 */


/**
 * disable default dashboard widgets
 */

function disable_default_dashboard_widgets() {
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );    // Right Now Widget
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         // Plugins Widget
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core' );  // Quick Press Widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         //
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       //
	// removing plugin dashboard boxes
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );         // Yoast's SEO Plugin Widget
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' );
	/*
	have more plugin widgets you'd like to remove?
	share them with us so we can get a list of
	the most commonly used. :D
	https://github.com/eddiemachado/bones/issues
	*/
}
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );


/**
 * ロゴのリンクをwordpress.org からサイトURLへ変更
 */
function custom_login_url() {  return home_url(); }
function custom_login_title() { return get_option( 'blogname' ); } // alt属性をサイト名に

/**
 * //ダッシュボード内のwordpressへのリンク(ロゴ)部分を削除
 */

function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' ); //ロゴ
    $wp_admin_bar->remove_node( 'new-post' ); //投稿
    $wp_admin_bar->remove_menu('comments'); //コメント
    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    $wp_admin_bar->remove_menu('new-content');      // Remove the content link
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

/**
 * 作成者アーカイブを無効化します。(WordPressのサイトアドレスURL/?author=1 などでアクセスされた際にURLにユーザー名が表示される機能も無効にします)
 */
function author_archive_404( $query ) {
	if ( ! is_admin() && is_author() ) {
		$query->set_404();
		status_header( 404 );
		nocache_headers();
	}
}
add_filter( 'parse_query', 'author_archive_404' );

// Custom Backend Footer
function custom_admin_footer() {
	_e( '<span id="footer-thankyou">ご利用ありがとうございます。</span>' );
}
add_filter( 'admin_footer_text', 'custom_admin_footer' );

/*
* スラッグ名が日本語だったら自動的に投稿タイプ＋id付与へ変更（スラッグを設定した場合は適用しない）
*/
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
        $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );


/*
* デフォルトで差し込まれるfaviconを無効にする
*/
function wp_favicon_delete(){
	exit;
}
add_action('do_faviconico', 'wp_favicon_delte');


