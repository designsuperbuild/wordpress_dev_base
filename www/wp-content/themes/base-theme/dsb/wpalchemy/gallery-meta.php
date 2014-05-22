<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
 
    <p><a href="#" class="dodelete-docs button">Remove All</a></p>
    <?php while($mb->have_fields_and_multi('docs')): ?>
    
    <?php $mb->the_group_open(); ?>
        <div class="gallery-item-meta">
        <h3>Gallery Item</h3>
        <?php $mb->the_field('title'); ?>
        <label for="<?php $mb->the_name(); ?>">Title</label>
        <p><input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>

        <?php $mb->the_field('caption'); ?>
        <label for="<?php $mb->the_name(); ?>">Caption</label>
        <p><textarea id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/><?php $mb->the_value(); ?></textarea>
        </p>

        <?php $mb->the_field('link'); ?>
        <label for="<?php $mb->the_name(); ?>">Link</label>
        <p><input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>


        <?php $mb->the_field('imgurl'); ?>
        <p><label for="<?php $mb->the_name(); ?>">Image</label>
        <?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
        </p>
 
        <p>
            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
            <?php echo $wpalchemy_media_access->getButton(); ?>
        </p>
 
        
        <a href="#" class="dodelete button">Delete This Gallery Item</a>
        </div>
    <?php $mb->the_group_close(); ?>
    
    <?php endwhile; ?>
 
    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-docs button">Add</a></p>
 
</div>