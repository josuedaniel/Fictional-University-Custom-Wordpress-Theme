<div class="event-summary">
                            <a href="<?php the_permalink(); ?>" class="event-summary__date t-center">
                                <span class="event-summary__month"><?php 
                                    //show the custom chosen event_date through acf's get_field and format it to up as M
                                    $eventDate = new DateTime(get_field('event_date'));
                                    echo $eventDate->format('M')
                                    
                                ?></span>
                                <span class="event-summary__day"><?php 
                                    //show the custom chosen event_date through acf's get_field and format it to up as d                                    
                                    echo $eventDate->format('d')
                                ?></span>
                            </a>
                            <div class="event-summary__content">
                                <h5 class="event-summary__title headline headline--tiny"><a href="<?php 
                                the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <!-- get the custom excerpt or the trimmed first 18 words --> 
                                <p><?php if (has_excerpt()) {
                                    echo get_the_excerpt();
                                } else {
                                    echo wp_trim_words(get_the_content(), 18);
                                }
                                 ?><a href="<?php the_permalink(); ?>" class="nu gray">
                                Learn more</a></p>
                            </div>
                        </div>