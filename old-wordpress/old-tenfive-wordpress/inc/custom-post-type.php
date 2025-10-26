<?php
/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
カスタム投稿
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
add_action('init', function() {
	register_post_type(
		'blog-tenfive',
		array(
			'labels'        => array('name' => 'テンファイブ ブログ', 'singular_name' => 'テンファイブ ブログ', 'all_items' => 'テンファイブ ブログ一覧', 'menu_name' => 'テンファイブ ブログ'),
			'public'        => true, 
			'has_archive'   => true,
			'menu_position' => 5,
			'rewrite'       => array('slug' => 'blog-tenfive', 'with_front' => false),
			'supports'      => array('title',  'editor',  'author', 'thumbnail', 'revisions', 'page-attributes'),
			'show_in_rest'  => true,
		)
	);

	register_taxonomy(
		'blog-tenfive_category',
		'blog-tenfive',
		array(
			'label'             => 'カテゴリー',
			'hierarchical'      => true,
			'rewrite'           => array('slug' => 'blog-tenfive', 'with_front' => false, 'hierarchical' => true),
			'show_admin_column' => true,
			'show_in_rest'      => true,
		)
	);

	register_taxonomy(
    'blog-tenfive_tag',
    'blog-tenfive',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );

	register_post_type(
		'member',
		array(
			'labels'        => array('name' => 'メンバー', 'singular_name' => 'メンバー', 'all_items' => 'メンバー一覧', 'menu_name' => 'メンバー'),
			'public'        => true, 
			'has_archive'   => true,
			'menu_position' => 5,
			'rewrite'       => array('slug' => 'member', 'with_front' => false),
			'supports'      => array('title', 'editor', 'author', 'thumbnail', 'revisions', 'page-attributes'),
			'show_in_rest'  => true,
		)
	);

	register_taxonomy(
		'member_category',
		'member',
		array(
			'label'             => 'カテゴリー',
			'hierarchical'      => true,
			'rewrite'           => array('slug' => 'member', 'with_front' => false, 'hierarchical' => true),
			'show_admin_column' => true,
			'show_in_rest'      => true,
		)
	);
	
	register_taxonomy(
    'member_tag',
    'member',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
	
	register_post_type(
		'recruit',
		array(
			'labels'        => array('name' => '採用情報', 'singular_name' => '採用情報', 'all_items' => '採用情報一覧', 'menu_name' => '採用情報'),
			'public'        => true, 
			'has_archive'   => true,
			'menu_position' => 5,
			// 'rewrite'       => array('slug' => 'recruit', 'with_front' => false),
			//'rewrite' => array('slug' => 'recruit/%recruit_category%', 'with_front' => false),
			'supports'      => array('title', 'editor', 'author', 'thumbnail', 'revisions', 'page-attributes'),
			'show_in_rest'  => true,
		)
	);

	register_taxonomy(
		'recruit_category',
		'recruit',
		array(
			'label'             => 'カテゴリー',
			'hierarchical'      => true,
			// 'rewrite'           => array('slug' => 'recruit', 'with_front' => false, 'hierarchical' => true),
			'rewrite' => array('slug' => 'recruit', 'with_front' => false),
			'show_admin_column' => true,
			'show_in_rest'      => true,
		)
	);
	
	
	register_taxonomy(
    'recruit_tag',
    'recruit',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );

  // 新しいカスタム投稿タイプ: AIツール紹介
  register_post_type(
    'ai-tool',
    array(
      'labels'        => array('name' => 'AIツール紹介', 'singular_name' => 'AIツール紹介', 'all_items' => 'AIツール紹介一覧', 'menu_name' => 'AIツール紹介'),
      'public'        => true, 
      'has_archive'   => true,
      'menu_position' => 5,
      'rewrite'       => array('slug' => 'ai-tool', 'with_front' => false),
      'supports'      => array('title', 'editor', 'author', 'thumbnail', 'revisions', 'page-attributes'),
      'show_in_rest'  => true,
    )
  );

  register_taxonomy(
    'ai-tool_category',
    'ai-tool',
    array(
      'label'             => 'カテゴリー',
      'hierarchical'      => true,
      'rewrite'           => array('slug' => 'ai-tool', 'with_front' => false, 'hierarchical' => true),
      'show_admin_column' => true,
      'show_in_rest'      => true,
    )
  );

  register_taxonomy(
    'ai-tool_tag',
    'ai-tool',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
	
});

add_filter('post_type_link', function($link, $post) {
	$post_type = $post->post_type;
	$post_id   = $post->ID;
	$link = home_url($post_type . '/' . $post_id . '/');

	return $link;
}, 10, 2);

add_filter('rewrite_rules_array', function($rules) {
	$rules = array(
		'blog-tenfive/([0-9]+)/?$'              => 'index.php?post_type=blog-tenfive&p=$matches[1]',
		'blog-tenfive/page/([0-9]+)/?$'         => 'index.php?post_type=blog-tenfive&paged=$matches[1]',
		'blog-tenfive/([^/]+)/?$'               => 'index.php?post_type=blog-tenfive&blog-tenfive_category=$matches[1]',
		'blog-tenfive/([^/]+)/([0-9]+)/?$'      => 'index.php?post_type=blog-tenfive&blog-tenfive_category=$matches[1]&p=$matches[2]',
		'blog-tenfive/([^/]+)/page/([0-9]+)/?$' => 'index.php?post_type=blog-tenfive&blog-tenfive_category=$matches[1]&paged=$matches[2]',

		'member/([0-9]+)/?$'                  => 'index.php?post_type=member&p=$matches[1]',
		'member/page/([0-9]+)/?$'             => 'index.php?post_type=member&paged=$matches[1]',
		'member/([^/]+)/?$'                   => 'index.php?post_type=member&member_category=$matches[1]',
		'member/([^/]+)/([0-9]+)/?$'          => 'index.php?post_type=member&member_category=$matches[1]&p=$matches[2]',
		'member/([^/]+)/page/([0-9]+)/?$'     => 'index.php?post_type=member&member_category=$matches[1]&paged=$matches[2]',

		'recruit/([0-9]+)/?$'                 => 'index.php?post_type=recruit&p=$matches[1]',
		'recruit/page/([0-9]+)/?$'            => 'index.php?post_type=recruit&paged=$matches[1]',
		'recruit/([^/]+)/?$'                  => 'index.php?post_type=recruit&recruit_category=$matches[1]',
		'recruit/([^/]+)/([0-9]+)/?$'         => 'index.php?post_type=recruit&recruit_category=$matches[1]&p=$matches[2]',
		'recruit/([^/]+)/page/([0-9]+)/?$'    => 'index.php?post_type=recruit&recruit_category=$matches[1]&paged=$matches[2]',

    'ai-tool/([0-9]+)/?$'                 => 'index.php?post_type=ai-tool&p=$matches[1]',
    'ai-tool/page/([0-9]+)/?$'            => 'index.php?post_type=ai-tool&paged=$matches[1]',
    'ai-tool/([^/]+)/?$'                  => 'index.php?post_type=ai-tool&ai-tool_category=$matches[1]',
    'ai-tool/([^/]+)/([0-9]+)/?$'         => 'index.php?post_type=ai-tool&ai-tool_category=$matches[1]&p=$matches[2]',
    'ai-tool/([^/]+)/page/([0-9]+)/?$'    => 'index.php?post_type=ai-tool&ai-tool_category=$matches[1]&paged=$matches[2]',
	) + $rules;

	return $rules;
});

add_action('restrict_manage_posts', function($post_type) {
	if (in_array($post_type, CUSTOM_POST_TYPES)) {
		$taxonomy = $post_type . '_category';
		wp_dropdown_categories(
			array(
				'show_option_all' => 'カテゴリー一覧',
				'hide_empty'      => false,
				'name'            => $taxonomy,
				'selected'        => get_query_var($taxonomy),
				'taxonomy'        => $taxonomy,
				'hide_if_empty'   => true,
				'value_field'     => 'slug',
			)
		);
	}
}, 10, 2);