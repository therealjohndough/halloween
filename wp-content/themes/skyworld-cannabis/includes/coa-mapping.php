<?php
/**
 * Skyworld COA Data Mapping
 * Maps COA files to strains and products
 */

// COA file mapping based on uploaded files
$skyworld_coa_mapping = array(
    
    // Flower Strains (J suffix indicates flower)
    'strains' => array(
        'gorilla-glue' => array(
            'name' => 'Gorilla Glue',
            'code' => 'GG',
            'coa_files' => array(
                'COA-SW3725J-GG.pdf',
                'COA-SM060925-J35-GG-H6.pdf' // Hash hole variant
            ),
            'type' => 'hybrid',
            'description' => 'A potent hybrid known for its heavy-handed euphoria and relaxation.',
        ),
        
        'sunset-punch' => array(
            'name' => 'Sunset Punch',
            'code' => 'SP',
            'coa_files' => array(
                'COA-SW3725J-SP.pdf'
            ),
            'type' => 'indica',
            'description' => 'A fruity indica-dominant strain with relaxing sunset vibes.',
        ),
        
        'sour-cream-pie' => array(
            'name' => 'Sour Cream Pie',
            'code' => 'SCP',
            'coa_files' => array(
                'COA-SW3725J-SCP.pdf',
                'COA-SW031725-J35-SCP.pdf'
            ),
            'type' => 'hybrid',
            'description' => 'A creamy, tangy hybrid with dessert-like flavors.',
        ),
        
        'peanut-butter-gelato' => array(
            'name' => 'Peanut Butter Gelato',
            'code' => 'PBG',
            'coa_files' => array(
                'COA-SW3725J-PBG.pdf',
                'COA-SW042825-J35-PBG.pdf',
                'COA-SW051925-J32-PBG.pdf'
            ),
            'type' => 'hybrid',
            'description' => 'A nutty, creamy strain with gelato genetics.',
        ),
        
        'ghost-cookies' => array(
            'name' => 'Ghost Cookies',
            'code' => 'GC',
            'coa_files' => array(
                'COA-SW3725J-GC.pdf'
            ),
            'type' => 'hybrid',
            'description' => 'A mysterious hybrid with cookie genetics.',
        ),
        
        'key-lime-sorbet' => array(
            'name' => 'Key Lime Sorbet',
            'code' => 'KS',
            'coa_files' => array(
                'COA-SW3725J-KS.pdf'
            ),
            'type' => 'sativa',
            'description' => 'A citrusy sativa with refreshing sorbet flavors.',
        ),
        
        'white-zkittlez' => array(
            'name' => 'White Zkittlez',
            'code' => 'WZ',
            'coa_files' => array(
                'COA-SW3725J-WZ.pdf'
            ),
            'type' => 'hybrid',
            'description' => 'A fruity hybrid with zkittlez genetics.',
        ),
        
        'lemon-og' => array(
            'name' => 'Lemon OG',
            'code' => 'LO',
            'coa_files' => array(
                'COA-SW3725J-LO.pdf'
            ),
            'type' => 'hybrid',
            'description' => 'A citrusy OG strain with lemon flavors.',
        ),
        
        'moon-sugar' => array(
            'name' => 'Moon Sugar',
            'code' => 'MS',
            'coa_files' => array(
                'COA-SW063025-J35-MS.pdf'
            ),
            'type' => 'indica',
            'description' => 'A sweet indica with otherworldly effects.',
        ),
        
        'taste-buds' => array(
            'name' => 'Taste Buds',
            'code' => 'TB',
            'coa_files' => array(
                'COA-SW063025-J35-TB.pdf'
            ),
            'type' => 'hybrid',
            'description' => 'A flavorful hybrid that excites the palate.',
        )
    ),
    
    // Pre-roll Products
    'products' => array(
        
        // Standard Pre-rolls (0.5g)
        'pre-roll-gorilla-glue-05' => array(
            'name' => 'Gorilla Glue Pre-roll 0.5g',
            'strain' => 'gorilla-glue',
            'type' => 'pre-roll',
            'size' => '0.5g',
            'coa_files' => array(
                'COA-SW051925-PRE05X2-GG.pdf',
                'COA-SW040725-PRE05X6-GG.pdf',
                'COA-SW031725-PRE05-GG.pdf'
            )
        ),
        
        'pre-roll-sunset-punch-05' => array(
            'name' => 'Sunset Punch Pre-roll 0.5g',
            'strain' => 'sunset-punch',
            'type' => 'pre-roll',
            'size' => '0.5g',
            'coa_files' => array(
                'COA-SW040725-PRE05X2-SP.pdf',
                'COA-SW040725-PRE05X6-SP.pdf'
            )
        ),
        
        'pre-roll-sour-cream-pie-05' => array(
            'name' => 'Sour Cream Pie Pre-roll 0.5g',
            'strain' => 'sour-cream-pie',
            'type' => 'pre-roll',
            'size' => '0.5g',
            'coa_files' => array(
                'COA-SW040725-PRE05X2-SCP.pdf'
            )
        ),
        
        'pre-roll-peanut-butter-gelato-05' => array(
            'name' => 'Peanut Butter Gelato Pre-roll 0.5g',
            'strain' => 'peanut-butter-gelato',
            'type' => 'pre-roll',
            'size' => '0.5g',
            'coa_files' => array(
                'COA-SW060925-PRE05X2-PBG.pdf',
                'COA-SW060925-PRE5X6-PBG.pdf'
            )
        ),
        
        // 1g Pre-rolls
        'pre-roll-sour-cream-pie-1g' => array(
            'name' => 'Sour Cream Pie Pre-roll 1g',
            'strain' => 'sour-cream-pie',
            'type' => 'pre-roll',
            'size' => '1g',
            'coa_files' => array(
                'COA-SW031725-PRE1-SCP.pdf',
                'COA-SW040725-PRE1-SCP.pdf'
            )
        ),
        
        'pre-roll-sunset-punch-1g' => array(
            'name' => 'Sunset Punch Pre-roll 1g',
            'strain' => 'sunset-punch',
            'type' => 'pre-roll',
            'size' => '1g',
            'coa_files' => array(
                'COA-SW040725-PRE1-SP.pdf'
            )
        ),
        
        // Hash Holes
        'hash-hole-sunset-punch-pre-roll' => array(
            'name' => 'Sunset Punch Hash Hole Pre-roll',
            'strain' => 'sunset-punch',
            'type' => 'hash-hole',
            'size' => '1g',
            'coa_files' => array(
                'COA-SW051925-HH-SPXPR.pdf'
            )
        ),
        
        // Special Products
        'pre-roll-sb-05' => array(
            'name' => 'SB Pre-roll 0.5g',
            'strain' => 'unknown-sb', // Need to identify this strain
            'type' => 'pre-roll',
            'size' => '0.5g',
            'coa_files' => array(
                'COA-SW060925-PRE05X2-SB.pdf'
            )
        ),
        
        'pre-roll-moon-sugar-05' => array(
            'name' => 'Moon Sugar Pre-roll 0.5g',
            'strain' => 'moon-sugar',
            'type' => 'pre-roll',
            'size' => '0.5g',
            'coa_files' => array(
                'COA-SW063025-PRE05X2-MS.pdf'
            )
        ),
        
        'pre-roll-taste-buds-05' => array(
            'name' => 'Taste Buds Pre-roll 0.5g',
            'strain' => 'taste-buds',
            'type' => 'pre-roll',
            'size' => '0.5g',
            'coa_files' => array(
                'COA-SW063025-PRE05X2-TB.pdf'
            )
        ),
        
        'pre-roll-war-05' => array(
            'name' => 'WAR Pre-roll 0.5g',
            'strain' => 'unknown-war', // Need to identify this strain
            'type' => 'pre-roll',
            'size' => '0.5g',
            'coa_files' => array(
                'COA-SW063025-PRE05-WAR.pdf'
            )
        )
    )
);

// Function to get COA path
function get_coa_file_path($filename) {
    return get_template_directory_uri() . '/assets/coas/' . $filename;
}

// Function to get strain by code
function get_strain_by_code($code) {
    global $skyworld_coa_mapping;
    
    foreach ($skyworld_coa_mapping['strains'] as $slug => $strain) {
        if ($strain['code'] === $code) {
            return $strain;
        }
    }
    
    return null;
}

// Function to get products by strain
function get_products_by_strain($strain_slug) {
    global $skyworld_coa_mapping;
    
    $products = array();
    
    foreach ($skyworld_coa_mapping['products'] as $product_slug => $product) {
        if ($product['strain'] === $strain_slug) {
            $products[] = $product;
        }
    }
    
    return $products;
}