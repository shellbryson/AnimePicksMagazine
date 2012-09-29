<?php get_header(); ?>
            
            <div id="content">
            
                <div id="inner-content" class="wrap clearfix">
            
                    <div id="main" class="eightcol first clearfix" role="main">
                        
                        
                        <section class="news lozenge">
                            <h2>News</h2>
                            <ul>
                            <?php
                                /* 
                                ################################################
                                NEWS
                                ################################################
                                */ 
                                
                                // LOOP TRU THE POSTS, WE ONLY WANT TO DISPLAY THE LATEST
                                $i = 1;
                                $args = array( 'numberposts' => 20, 'category_name' => 'News' );
                                $newsitems = get_posts( $args );
                                $ns = "";
                        
                                foreach( $newsitems as $news ) : setup_postdata( $news );
                        
                                    // NEWS 411 FROM POST DATA
                                    $id = $news          -> ID;
                                    $title = $news       -> post_title;
                                    $excerpt = $news     -> post_excerpt;
                                    $date = $news        -> post_date;
                                    
                                    // LOOKUP OTHER DATA
                                    $link = $news        =  get_permalink( $id );
                                    $image               =  get_the_post_thumbnail( $id, 'thumbnail' );
                        
                                    // PROCESS DATE
                                    $dateformatted = date( 'dS M', strtotime( $date ) );
                                    
                                    // DISPLAY HTML
                                    ?>
                        
                                    <li class="news_item">
                                        <article>
                                            <section class="details">
                                                <h3><a href="<?php echo $link;?>"><?php echo $title;?></a></h3>
                                                <p><?php echo $excerpt;?></p>
                                            </section>
                                            <section class="image">
                                                <a href="<?php echo $link;?>"><?php echo $image;?></a>
                                                <div class="news_item_date"><?php echo $dateformatted;?></div>
                                            </section>
                                        </article>
                                    </li>
                                    <?php
                                endforeach;
                            ?>
                            </ul>
                            <div class="more"><a href="/category/news/">More news →</a></div>
                        </section>
                        <section class="reviews lozenge">
                            <h2>Reviews</h2>
                            <ul>
                            <?php
                                /* 
                                ################################################
                                REVIEWS
                                ################################################
                                */ 
                                
                                // LOOP TRU THE POSTS, WE ONLY WANT TO DISPLAY THE LATEST
                                $i = 1;
                                $args = array( 'numberposts' => 20, 'category_name' => 'News' );
                                $newsitems = get_posts( $args );
                                $ns = "";
                        
                                foreach( $newsitems as $news ) : setup_postdata( $news );
                        
                                    // NEWS 411 FROM POST DATA
                                    $id = $news          -> ID;
                                    $title = $news       -> post_title;
                                    $excerpt = $news     -> post_excerpt;
                                    $date = $news        -> post_date;
                                    
                                    // LOOKUP OTHER DATA
                                    $link = $news        =  get_permalink( $id );
                                    $image               =  get_the_post_thumbnail( $id, 'thumbnail' );
                        
                                    // PROCESS DATE
                                    $dateformatted = date( 'dS M', strtotime( $date ) );
                                    
                                    // DISPLAY HTML
                                    if ( $i < 4) {
                                        $i++;
                                    ?>
                        
                                    <li class="news_item">
                                        <article>
                                            <section class="details">
                                                <h3><a href="<?php echo $link;?>"><?php echo $title;?></a></h3>
                                                <p><?php echo $excerpt;?></p>
                                            </section>
                                            <section class="image">
                                                <a href="<?php echo $link;?>"><?php echo $image;?></a>
                                                <div class="news_item_date"><?php echo $dateformatted;?></div>
                                            </section>
                                        </article>
                                    </li>
                                    <?php
                                    }
                                endforeach;
                            ?>
                            </ul>
                            <div class="more"><a href="/category/news/">More news →</a></div>
                        </section>
            
                    </div> <!-- end #main -->
    
                    <?php get_sidebar(); ?>
                    
                </div> <!-- end #inner-content -->
    
            </div> <!-- end #content -->

<?php get_footer(); ?>
