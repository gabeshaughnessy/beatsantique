<div class="post listing six columns">
<a href="<?php the_permalink(); ?>" title="read more"><?php the_title(); ?></a>
<div class="media embed video fit-vid"><?php ba_media_embed(300, 300 ,'video_url');
?></div>
<p class="details"><span class="short-description"><?php the_excerpt(); ?></span><a href="<?php the_permalink(); ?>" title="read more">Read More</a></p>
</div>