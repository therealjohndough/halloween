<?php
/**
 * Block: Strain Profile
 * 
 * @package Skyworld_Cannabis
 * @since 1.0.0
 */

// Get ACF fields
$strain_name = get_sub_field('pb_strain_name');
$strain_type = get_sub_field('pb_strain_type');
$strain_effects = get_sub_field('pb_strain_effects');
$strain_aroma = get_sub_field('pb_strain_aroma');
$strain_lineage = get_sub_field('pb_strain_lineage');
$strain_terpenes = get_sub_field('pb_strain_terpenes');
$strain_description = get_sub_field('pb_strain_description');

$has_effects = !empty($strain_effects) && is_array($strain_effects);
$has_terpenes = !empty($strain_terpenes) && is_array($strain_terpenes);

// Map strain types to display labels and classes
$strain_type_map = array(
    'indica' => array('label' => 'Indica', 'class' => 'indica'),
    'sativa' => array('label' => 'Sativa', 'class' => 'sativa'),
    'hybrid' => array('label' => 'Hybrid', 'class' => 'hybrid'),
    'specialty' => array('label' => 'Specialty', 'class' => 'specialty')
);

$type_info = $strain_type_map[$strain_type] ?? array('label' => 'Unknown', 'class' => 'unknown');
?>

<div class="strain-profile-wrapper">
    <div class="container">
        
        <div class="strain-profile-header">
            
            <?php if ($strain_name) : ?>
                <h2 class="strain-name"><?php echo esc_html($strain_name); ?></h2>
            <?php endif; ?>
            
            <?php if ($strain_type) : ?>
                <span class="strain-type strain-type-<?php echo esc_attr($type_info['class']); ?>">
                    <?php echo esc_html($type_info['label']); ?>
                </span>
            <?php endif; ?>
            
        </div>
        
        <div class="strain-profile-content">
            
            <div class="strain-details-grid">
                
                <?php if ($has_effects) : ?>
                    <div class="strain-detail-section">
                        <h4 class="detail-label">Primary Effects</h4>
                        <div class="effects-tags">
                            <?php foreach ($strain_effects as $effect) : ?>
                                <span class="effect-tag"><?php echo esc_html(ucfirst($effect)); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($strain_aroma) : ?>
                    <div class="strain-detail-section">
                        <h4 class="detail-label">Aroma & Flavor</h4>
                        <p class="detail-value"><?php echo esc_html($strain_aroma); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if ($strain_lineage) : ?>
                    <div class="strain-detail-section">
                        <h4 class="detail-label">Lineage</h4>
                        <p class="detail-value"><?php echo esc_html($strain_lineage); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if ($has_terpenes) : ?>
                    <div class="strain-detail-section full-width">
                        <h4 class="detail-label">Terpene Profile</h4>
                        <div class="terpenes-list">
                            <?php foreach ($strain_terpenes as $terpene) : 
                                $terpene_name = $terpene['pb_terpene_name'] ?? '';
                                $terpene_percentage = $terpene['pb_terpene_percentage'] ?? '';
                                
                                if ($terpene_name) :
                            ?>
                                <div class="terpene-item">
                                    <span class="terpene-name"><?php echo esc_html(ucfirst($terpene_name)); ?></span>
                                    <?php if ($terpene_percentage) : ?>
                                        <span class="terpene-percentage"><?php echo esc_html($terpene_percentage); ?>%</span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; 
                            endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>
            
            <?php if ($strain_description) : ?>
                <div class="strain-cultivation-notes">
                    <h4 class="notes-label">Notes From Cultivation</h4>
                    <div class="notes-content">
                        <?php echo wp_kses_post($strain_description); ?>
                    </div>
                </div>
            <?php endif; ?>
            
        </div>
        
    </div>
</div>