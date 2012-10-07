<?php get_header(); ?>
            
            <div id="content">
            
                <div id="inner-content" class="wrap clearfix">
            
                    <div id="main" class="eightcol first clearfix" role="main">
                        
                        
                        <section class="updates lozenge">
                            <h1>Updates</h1>
                            <ul>
                            <?php
                                /* 
                                ################################################
                                UDPATES
                                ################################################
                                */ 
                                
                                // LOOP TRU THE POSTS, WE ONLY WANT TO DISPLAY THE LATEST
                                $postCounter = 1;
                                $args = array( 'numberposts' => 20, 'category_name' => 'News, Reviews' );
                                $articles = get_posts( $args );
                                $ns = "";
                        
                                foreach( $articles as $article ) : setup_postdata( $article );
                        
                                    // NEWS 411 FROM POST DATA
                                    $id = $article          -> ID;
                                    $title = $article       -> post_title;
                                    $excerpt = $article     -> post_excerpt;
                                    $date = $article        -> post_date;
                                    
                                    // LOOKUP OTHER DATA
                                    $link = $article        =  get_permalink( $id );
                                    $image                  =  get_the_post_thumbnail( $id, 'thumbnail' );
                                    $category               =  get_category(); // this is wrong, as posts may have many cats...?
                        
                                    // PROCESS DATE
                                    $dateformatted = date( 'dS M', strtotime( $date ) );
                                    
                                    if ( $postCounter <= 8 ) {
                                        $neko_box_class = "neko_box_large";
                                    } else if ( $postCounter > 8 && $postCounter <= 14) {
                                        $neko_box_class = "neko_box_medium";
                                    } else if ( $postCounter > 14 ) {
                                        $neko_box_class = "neko_box_small";
                                    }
                                    ?>
                        
                                    <li>
                                        <article class="neko_box <?php echo $neko_box_class?>">
                                            <?php echo $image;?>
                                            <header>
                                                Anime Review
                                                <?php echo $category;?>
                                            </header>
                                            <section class="details">
                                                <h3><a href="<?php echo $link;?>"><?php echo $title;?></a></h3>
                                                <p><?php echo $excerpt;?></p>
                                            </section>
                                            <section class="image">
                                                <!--<a href="<?php echo $link;?>"><?php echo $image;?></a>-->
                                                <!--<div class="news_item_date"><?php echo $dateformatted;?></div>-->
                                            </section>
                                            <footer></footer>
                                        </article>
                                    </li>
                                    
                                    <?php
                                endforeach;
                            ?>
                            </ul>
                            
                        </secion>
                        
                        
                    </div> <!-- end #main -->
    
                    <?php get_sidebar(); ?>
                    
                </div> <!-- end #inner-content -->
    
            </div> <!-- end #content -->

<?php get_footer(); ?>
