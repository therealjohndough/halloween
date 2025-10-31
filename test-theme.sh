#!/bin/bash

# Skyworld Cannabis Theme - Pre-Deployment Test Script
# Run this script to validate theme integrity before deployment

echo "🌿 Skyworld Cannabis Theme - Pre-Deployment Tests"
echo "=================================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

THEME_PATH="wp-content/themes/skyworld-cannabis"
ERRORS=0
WARNINGS=0

# Function to print status
print_status() {
    if [ $2 -eq 0 ]; then
        echo -e "${GREEN}✓${NC} $1"
    else
        echo -e "${RED}✗${NC} $1"
        ((ERRORS++))
    fi
}

print_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
    ((WARNINGS++))
}

print_info() {
    echo -e "${BLUE}ℹ${NC} $1"
}

echo -e "\n${BLUE}1. PHP Syntax Validation${NC}"
echo "------------------------"

# Check functions.php
if [ -f "$THEME_PATH/functions.php" ]; then
    php -l "$THEME_PATH/functions.php" > /dev/null 2>&1
    print_status "functions.php syntax check" $?
else
    print_status "functions.php exists" 1
fi

# Check all PHP template files
for file in "$THEME_PATH"/*.php; do
    if [ -f "$file" ]; then
        filename=$(basename "$file")
        php -l "$file" > /dev/null 2>&1
        print_status "$filename syntax check" $?
    fi
done

# Check template-parts
if [ -d "$THEME_PATH/template-parts" ]; then
    for file in "$THEME_PATH/template-parts"/**/*.php; do
        if [ -f "$file" ]; then
            filename=$(basename "$file")
            php -l "$file" > /dev/null 2>&1
            print_status "template-parts/$filename syntax check" $?
        fi
    done
fi

echo -e "\n${BLUE}2. Required Files Check${NC}"
echo "----------------------"

# Essential WordPress theme files
required_files=(
    "$THEME_PATH/style.css"
    "$THEME_PATH/functions.php"
    "$THEME_PATH/index.php"
)

for file in "${required_files[@]}"; do
    if [ -f "$file" ]; then
        print_status "$(basename "$file") exists" 0
    else
        print_status "$(basename "$file") exists" 1
    fi
done

echo -e "\n${BLUE}3. Design System Validation${NC}"
echo "---------------------------"

# Check design system CSS
if [ -f "$THEME_PATH/assets/css/design-system.css" ]; then
    print_status "design-system.css exists" 0
    
    # Check for key design system classes
    key_classes=(
        "\.u-mode-matte-black"
        "\.glass-card"
        "\.strain-tag-glass"
        "\.cannabinoid-indicator-glass"
        "\.terpene-meter-glass"
    )
    
    for class in "${key_classes[@]}"; do
        if grep -q "$class" "$THEME_PATH/assets/css/design-system.css"; then
            print_status "Design system class $class found" 0
        else
            print_status "Design system class $class found" 1
        fi
    done
else
    print_status "design-system.css exists" 1
fi

echo -e "\n${BLUE}4. Cannabis Component Validation${NC}"
echo "--------------------------------"

# Check for cannabis-specific components in CSS
cannabis_components=(
    "strain-tag"
    "effect-tag"
    "cannabinoid-indicator"
    "terpene-meter"
    "lab-tested-badge"
)

css_file="$THEME_PATH/assets/css/design-system.css"
if [ -f "$css_file" ]; then
    for component in "${cannabis_components[@]}"; do
        if grep -q "\.$component" "$css_file"; then
            print_status "Cannabis component .$component found in CSS" 0
        else
            print_warning "Cannabis component .$component not found in CSS"
        fi
    done
fi

echo -e "\n${BLUE}5. Compliance Features Check${NC}"
echo "----------------------------"

# Check for compliance-related code
compliance_checks=(
    "OCM-PROC-24-000030:NY OCM Processor License"
    "OCM-CULT-2023-000179:NY OCM Cultivator License"
    "21+:Age gate requirement"
    "store.*locator:Store locator functionality"
)

for check in "${compliance_checks[@]}"; do
    pattern="${check%%:*}"
    description="${check##*:}"
    
    if grep -r -i "$pattern" "$THEME_PATH" --include="*.php" > /dev/null 2>&1; then
        print_status "$description found" 0
    else
        print_warning "$description not found"
    fi
done

echo -e "\n${BLUE}6. WordPress Theme Header Validation${NC}"
echo "------------------------------------"

# Check style.css header
if [ -f "$THEME_PATH/style.css" ]; then
    if grep -q "Theme Name:" "$THEME_PATH/style.css"; then
        print_status "Theme header in style.css" 0
    else
        print_status "Theme header in style.css" 1
    fi
    
    if grep -q "Skyworld Cannabis" "$THEME_PATH/style.css"; then
        print_status "Skyworld Cannabis theme name" 0
    else
        print_warning "Skyworld Cannabis theme name not found"
    fi
fi

echo -e "\n${BLUE}7. Security Validation${NC}"
echo "---------------------"

# Check for proper escaping functions
security_functions=(
    "esc_html"
    "esc_attr"
    "esc_url"
    "sanitize_text_field"
)

for func in "${security_functions[@]}"; do
    if grep -r "$func" "$THEME_PATH" --include="*.php" > /dev/null 2>&1; then
        print_status "Security function $func used" 0
    else
        print_warning "Security function $func not found"
    fi
done

# Check for WordPress security constants
if grep -r "ABSPATH" "$THEME_PATH" --include="*.php" > /dev/null 2>&1; then
    print_status "ABSPATH security check found" 0
else
    print_warning "ABSPATH security check not found"
fi

echo -e "\n${BLUE}8. Performance Checks${NC}"
echo "--------------------"

# Check for image optimization hints
if [ -d "$THEME_PATH/assets/images" ]; then
    print_status "Images directory exists" 0
    
    # Count large images (>1MB)
    large_images=$(find "$THEME_PATH/assets/images" -name "*.jpg" -o -name "*.jpeg" -o -name "*.png" -size +1M 2>/dev/null | wc -l)
    if [ $large_images -eq 0 ]; then
        print_status "No large images (>1MB) found" 0
    else
        print_warning "$large_images large images found - consider optimization"
    fi
fi

# Check for minified CSS
if [ -f "$THEME_PATH/assets/css/design-system.css" ]; then
    file_size=$(wc -c < "$THEME_PATH/assets/css/design-system.css")
    if [ $file_size -lt 100000 ]; then  # Less than 100KB
        print_status "Design system CSS size reasonable (<100KB)" 0
    else
        print_warning "Design system CSS is large (${file_size} bytes) - consider minification"
    fi
fi

echo -e "\n${BLUE}9. ACF Integration Check${NC}"
echo "-------------------------"

# Check for ACF functions
acf_functions=(
    "get_field"
    "update_field"
    "have_rows"
    "the_row"
)

for func in "${acf_functions[@]}"; do
    if grep -r "$func" "$THEME_PATH" --include="*.php" > /dev/null 2>&1; then
        print_status "ACF function $func found" 0
    else
        print_warning "ACF function $func not found - may not need ACF"
    fi
done

echo -e "\n${BLUE}10. Strain Data Validation${NC}"
echo "--------------------------"

# Check for authentic Skyworld strains (not fabricated)
authentic_strains=(
    "Stay Puft"
    "Garlic Gravity"
    "Sherb Cream Pie"
    "Skyworld Wafflez"
    "White Apple Runtz"
)

for strain in "${authentic_strains[@]}"; do
    if grep -r "$strain" "$THEME_PATH" --include="*.php" > /dev/null 2>&1; then
        print_status "Authentic strain '$strain' found" 0
    else
        print_info "Authentic strain '$strain' not found (this is OK)"
    fi
done

# Check for common fake strain names that should NOT be there
fake_strains=(
    "Purple Haze"
    "White Widow"
    "Sour Diesel"
    "Green Crack"
    "Blue Dream"
)

for strain in "${fake_strains[@]}"; do
    if grep -r "$strain" "$THEME_PATH" --include="*.php" > /dev/null 2>&1; then
        print_status "Fake strain '$strain' NOT found" 1
        echo "  WARNING: Remove fake strain data - use only authentic Skyworld genetics"
    else
        print_status "Fake strain '$strain' NOT found" 0
    fi
done

echo -e "\n${BLUE}Test Results Summary${NC}"
echo "==================="

if [ $ERRORS -eq 0 ] && [ $WARNINGS -eq 0 ]; then
    echo -e "${GREEN}🎉 All tests passed! Theme is ready for deployment.${NC}"
    exit 0
elif [ $ERRORS -eq 0 ]; then
    echo -e "${YELLOW}⚠️  Tests passed with $WARNINGS warnings. Review warnings before deployment.${NC}"
    exit 0
else
    echo -e "${RED}❌ $ERRORS critical errors found. Fix errors before deployment.${NC}"
    if [ $WARNINGS -gt 0 ]; then
        echo -e "${YELLOW}   Also found $WARNINGS warnings to review.${NC}"
    fi
    exit 1
fi