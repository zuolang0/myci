<h2><?php echo $title; ?></h2>



    <h3><?php echo $news_item['title']; ?></h3>
    <div class="main">
        <?php echo $news_item['text']; ?>
    </div>
    <p><a href="<?php echo site_url('/home/news/view/'.$news_item['slug']); ?>">View article</a></p>

