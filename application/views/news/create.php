<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('home/news/create'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" value="<?php echo set_value('title'); ?>" /><br />
    <!-- 在页面输出隐藏域 -->
    <?php echo form_hidden('hid', $hid); ?>
    <label for="text">Text</label>
    <!-- 错误之后可以保留原来的输入 -->
    <textarea name="text"><?php echo set_value('text'); ?></textarea><br />

    <input type="submit" name="submit" value="Create news item" />

</form>