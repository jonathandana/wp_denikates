<?php
    class HelperFunctions{
        public static $posts_per_page;


        public static function get_term_data_child($termId , $taxonomy){

            //$termchildren = get_term_children($termId,$taxonomy);
            $termchildren = new WP_Term_Query(array('parent'=> $termId,'hide_empty' => !DEVELOPMENT_MODE));

            $data = [];

            foreach ( $termchildren as $child ) {
                $term = get_term_by('id', $child, $taxonomy);

                /*is not posts relation*/
                if(!DEVELOPMENT_MODE && $term->count <= 0){
                    continue;
                }

                $data[] = [
                   'link' => get_term_link($child, $taxonomy),
                   'name' => $term->name,
                   'termId' =>$term->term_id
                ];

            }

            return $data;

        }


        public static function get_post_by_category($term){

            if(is_array($term)){
                $term = $term[count($term)-1];
            }

            $args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $term->taxonomy,
                        'field'    => 'id',
                        'terms'    => $term->term_id,
                    ),
                ),
            );

            return $query = new WP_Query($args);

        }



        public static function get_relation_post($post_type,$post_id){
            self::$posts_per_page = 3;
            $args = array(
                'post_type'=>$post_type,
                'posts_per_page'=>self::$posts_per_page,
                'orderby'=> 'rand',
                'post__not_in'=>array($post_id)
            );

            return new WP_Query($args);
        }


        
        public static function loadMore(){
            $errors = [];
            $data = [];
            $result = [];

            $posts_per_page = filter_input(INPUT_GET, "posts_per_page", FILTER_SANITIZE_STRING);
            $post_type = filter_input(INPUT_GET, "post_type", FILTER_SANITIZE_STRING);
            $paged = filter_input( INPUT_GET, 'paged', FILTER_VALIDATE_INT );
            $termId = filter_input(INPUT_GET, "termId", FILTER_SANITIZE_STRING);
            $taxonomy = filter_input(INPUT_GET, "taxonomy", FILTER_SANITIZE_STRING);

            $posts_per_page = $posts_per_page ? $posts_per_page  : '10';

            if(!$post_type){
                $errors[] = "No post type";
            }

            if(!$paged){
                $errors[] = 'Paged is not valid';
            }

            if (count($errors)) {
                $result[] =["status"=>"false","errors"=>$errors];
                echo json_encode($result);
                exit;
            }

            $args = array(
                'post_type'=>$post_type,
                'posts_per_page' => $posts_per_page,
                'paged' => $paged,
            );

            if($termId && $taxonomy){
                $args['tax_query'] = array(array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'term_id',
                    'terms'    => $termId,
               ));
            }
            $query = new WP_Query($args);
            while ($query->have_posts()){
                $query->the_post();
                $url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
                $data[] = [
                    'url' => get_the_permalink(),
                    'title'=>get_the_title(),
                    'excerpt' => get_the_excerpt(),
                    'img_url' => $url[0]
                ];
            }

            $result[] =["status"=>"true","show_more"=>true,"data"=>$data];

            if(intval($query->max_num_pages) == $paged){
                $result[0]["show_more"] = false;
            }

            echo json_encode($result);
            exit;

        }
        //TODO
        //http://local.denikates.co.il:9080/wp-admin/admin-ajax.php?action=loadMore&paged=2&post_type=products&posts_per_page=10&termId=19&taxonomy=products-categories

    }
