<?php get_header(); ?>
            
            <div id="content">
            
                <div id="inner-content" class="wrap clearfix">
            
                    <div id="main" class="eightcol first clearfix" role="main">
                        
                        
                        <section id="news" class="lozenge">
                            <h2>News</h2>
                            <ul>
                            <?php
                                /* 
                                ################################################
                                LATEST NEWS
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
                        <section id="reviews" class="lozenge">
                            <h2>News</h2>
                            <ul>
                            <?php
                                /* 
                                ################################################
                                LATEST NEWS
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

                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
                        
                            <header class="article-header">
                            
                                <h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                            
                                <p class="byline vcard"><?php _e('Posted', 'bonestheme'); ?> <time class="updated" datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time> <?php _e('by', 'bonestheme'); ?> <span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&</span> <?php _e('filed under', 'bonestheme'); ?> <?php the_category(', '); ?>.</p>
                        
                            </header> <!-- end article header -->
                    
                            <section class="entry-content clearfix">
                                <?php the_content(); ?>
                            </section> <!-- end article section -->
                        
                            <footer class="article-footer">

                                <p class="tags"><?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>

                            </footer> <!-- end article footer -->
                            
                            <?php // comments_template(); // uncomment if you want to use them ?>
                    
                        </article> <!-- end article -->
                    
                        <?php endwhile; ?>    
                    
                            <?php if (function_exists('bones_page_navi')) { ?>
                                <?php bones_page_navi(); ?>
                            <?php } else { ?>
                                <nav class="wp-prev-next">
                                    <ul class="clearfix">
                                        <li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
                                        <li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
                                    </ul>
                                </nav>
                            <?php } ?>        
                    
                        <?php else : ?>
                        
                            <article id="post-not-found" class="hentry clearfix">
                                <header class="article-header">
                                    <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
                                </header>
                                <section class="entry-content">
                                    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
                                </section>
                                <footer class="article-footer">
                                    <p><?php _e("This is the error message in the index.php template.", "bonestheme"); ?></p>
                                </footer>
                            </article>
                    
                        <?php endif; ?>
            
                    </div> <!-- end #main -->
    
                    <?php get_sidebar(); ?>
                    
                </div> <!-- end #inner-content -->
    
            </div> <!-- end #content -->

<?php get_footer(); ?>
