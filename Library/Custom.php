<?php

namespace Cekurte\Library;

/**
 * Custom
 *
 * Classe básica para registrar Custom Post Types e Custom Taxonomy
 *
 * @author     João Paulo Cercal
 * @version    1.0
 */
class Custom {
	
	/**
	 * Registra um Custom Post
	 * 
	 * @param string $genero a ou o
	 * @param string $slug
	 * @param array $label
	 * 
	 * @return object|WP_Error
	 */
    public function registerPostType($genero, $slug, $label) {
    	
    	$labels = array(
    		'name'                => _x( $label['plural'], 'Post Type General Name', 'cekurte' ),
    		'singular_name'       => _x( $label['singular'], 'Post Type Singular Name', 'cekurte' ),
    		'menu_name'           => __( $label['singular'], 'cekurte' ),
    		'parent_item_colon'   => __( $label['singular'] . ' Base:', 'cekurte' ),
    		'all_items'           => __( sprintf('Tod%ss %ss %s', $genero, $genero, $label['plural']), 'cekurte' ),
    		'view_item'           => __( 'Visualizar ' . $label['singular'], 'cekurte' ),
    		'add_new_item'        => __( sprintf('Adicionar nov%s %s', $genero, $label['singular']), 'cekurte' ),
    		'add_new'             => __( sprintf('Nov%s %s', $genero, $label['singular']), 'cekurte' ),
    		'edit_item'           => __( 'Editar ' . $label['singular'], 'cekurte' ),
    		'update_item'         => __( 'Atualizar ' . $label['singular'], 'cekurte' ),
    		'search_items'        => __( 'Procurar ' . $label['plural'], 'cekurte' ),
    		'not_found'           => __( sprintf('Nenhum %s encontrad%s', $label['singular'], $genero), 'cekurte' ),
    		'not_found_in_trash'  => __( sprintf('Nenhum %s encontrad%s na lixeira', $label['singular'], $genero), 'cekurte' ),
    	);
    	 
    	$rewrite = array(
    		'slug'                => $slug,
    		'with_front'          => true,
    		'pages'               => true,
    		'feeds'               => true,
    	);
    	 
    	$capabilities = array(
    		'edit_post'		 		=> 'edit_post',
    		'read_post'		 		=> 'read_post',
    		'delete_post'		 	=> 'delete_post',
    		'edit_posts'		 	=> 'edit_posts',
    		'edit_others_posts'	 	=> 'edit_others_posts',
    		'publish_posts'		 	=> 'publish_posts',
    		'read_private_posts'	=> 'read_private_posts',
    		'delete_posts'          => 'delete_posts',
    		'delete_private_posts'  => 'delete_private_posts',
    		'delete_published_posts'=> 'delete_published_posts',
    		'delete_others_posts'   => 'delete_others_posts',
    		'edit_private_posts'    => 'edit_private_posts',
    		'edit_published_posts'  => 'edit_published_posts',
    	);
    	 
    	$args = array(
    		'label'               => __( $label['singular'], 'cekurte' ),
    		'description'         => __( sprintf('Páginas de informações d%s %s', $genero,  $label['singular']), 'cekurte' ),
    		'labels'              => $labels,
    		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
    		'taxonomies'          => array(),
    		'hierarchical'        => false,
    		'public'              => true,
    		'show_ui'             => true,
    		'show_in_menu'        => true,
    		'show_in_nav_menus'   => true,
    		'show_in_admin_bar'   => true,
    		'menu_position'       => 5,
    		'menu_icon'           => get_template_directory_uri() . '/images/' . $slug . '-icon.png',
    		'can_export'          => true,
    		'has_archive'         => true,
    		'exclude_from_search' => false,
    		'publicly_queryable'  => true,
    		'query_var'           => $slug,
    		'rewrite'             => $rewrite,
    		'capabilities'        => $capabilities,
    		'map_meta_cap'		  => true,
    	);
    	 
    	return register_post_type('ck_' . $slug, $args);
    }
    
    /**
     * Registra um Custom Taxonomy
     * 
     * @param string $genero
     * @param string $slug
     * @param string $post_type
     * @param array $label
     * 
     * @return NULL|WP_Error
     */
    public function registerTaxonomy($genero, $slug, $post_type, $label) {
    	
    	$labels = array(
    		'name'                       => _x( $label['plural'], 'Taxonomy General Name', 'cekurte' ),
    		'singular_name'              => _x( $label['singular'], 'Taxonomy Singular Name', 'cekurte' ),
    		'menu_name'                  => __( $label['singular'], 'cekurte' ),
    		'all_items'                  => __( sprintf('Tod%ss %ss %s', $genero, $genero, $label['plural']), 'cekurte' ),
    		'parent_item'                => __( $label['singular'] . ' Base', 'cekurte' ),
    		'parent_item_colon'          => __( $label['singular'] . ' Base:', 'cekurte' ),
    		'new_item_name'              => __( sprintf('Nov%s nome d%s %s', $genero, $genero, $label['singular']), 'cekurte' ),
    		'add_new_item'               => __( sprintf('Adicionar nov%s %s', $genero, $label['singular']), 'cekurte' ),
    		'edit_item'                  => __( 'Editar ' . $label['singular'], 'cekurte' ),
    		'update_item'                => __( 'Atualizar ' . $label['singular'], 'cekurte' ),
    		'separate_items_with_commas' => __( sprintf('Separe %ss %s com vírgulas', $genero, $label['plural']), 'cekurte' ),
    		'search_items'               => __( 'Procurar ' . $label['plural'], 'cekurte' ),
    		'add_or_remove_items'        => __( 'Adicionar ou Remover ' . $label['plural'], 'cekurte' ),
    		'choose_from_most_used'      => __( sprintf('Escolha %s %s mais utilizad%ss', ($genero == 'a') ? 'uma das' : 'um dos', $label['plural'], $genero), 'cekurte' ),
    	);
    	
    	$rewrite = array(
    		'slug'                       => $slug,
    		'with_front'                 => true,
    		'hierarchical'               => true,
    	);
    	
    	$capabilities = array(
    		'manage_terms'               => 'manage_categories',
    		'edit_terms'                 => 'manage_categories',
    		'delete_terms'               => 'manage_categories',
    		'assign_terms'               => 'manage_categories',
    	);
    	
    	$args = array(
    		'labels'                     => $labels,
    		'hierarchical'               => true,
    		'public'                     => true,
    		'show_ui'                    => true,
    		'show_admin_column'          => true,
    		'show_in_nav_menus'          => true,
    		'show_tagcloud'              => true,
    		'query_var'                  => $slug,
    		'rewrite'                    => $rewrite,
    		'capabilities'               => $capabilities,
    	);
    	
    	return register_taxonomy( 'ck_cat_' . $slug, $post_type, $args );
    }
    
    /**
     * Adiciona novos supports para um ou mais post types
     * 
     * @param array $addSupport
     * 
     * @return \Cekurte\Library\Custom
     */
    public function addPostTypeSupports(array $addSupport) {
    	if (!empty($addSupport)) {
    		foreach ($addSupport as $postType => $supports) {
    			foreach ($supports as $support) {
    				add_post_type_support($postType, $support);
    			}
    		}
    	}
    	return $this;
    }
    
    /**
     * Remove supports para um ou mais post types
     *
     * @param array $removeSupport
     *
     * @return \Cekurte\Library\Custom
     */
    public function removePostTypeSupports(array $removeSupport) {
    	if (!empty($removeSupport)) {
    		foreach ($removeSupport as $postType => $supports) {
    			foreach ($supports as $support) {
    				remove_post_type_support($postType, $support);
    			}
    		}
    	}
    	return $this;
    }
} 