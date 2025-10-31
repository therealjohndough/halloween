name: Pull Request
description: Submit changes to the Skyworld Cannabis theme
title: ""
body:
  - type: markdown
    attributes:
      value: |
        ## 🚀 Pull Request
        
        Thank you for contributing to the Skyworld Cannabis WordPress theme!
        Please ensure all changes comply with cannabis industry regulations.

  - type: dropdown
    id: pr-type
    attributes:
      label: Type of Change
      description: What type of change does this PR introduce?
      options:
        - Bug Fix
        - New Feature
        - Design System Enhancement
        - Cannabis Component Addition
        - Performance Improvement
        - Documentation Update
        - Security Fix
        - Compliance Update
    validations:
      required: true

  - type: textarea
    id: description
    attributes:
      label: Description
      description: Describe your changes in detail
      placeholder: |
        **What this PR does:**
        - Adds new glass morphism terpene meter component
        - Improves mobile responsiveness for strain cards
        - Updates compliance text with current NY OCM licenses
        
        **Why these changes are needed:**
        - Enhances user experience for cannabis customers
        - Maintains regulatory compliance
        - Improves brand presentation

  - type: checkboxes
    id: cannabis-compliance
    attributes:
      label: Cannabis Compliance Checklist
      description: Verify compliance with cannabis industry regulations
      options:
        - label: Age gate functionality is preserved (21+ verification)
          required: true
        - label: NY OCM license numbers are current and displayed
          required: true
        - label: No medical or therapeutic claims are made
          required: true
        - label: Store locator conversion flow is maintained
          required: true
        - label: No e-commerce functionality is introduced
          required: true
        - label: Only authentic Skyworld strain data is used
          required: true

  - type: checkboxes
    id: technical-checklist
    attributes:
      label: Technical Quality Checklist
      options:
        - label: Code follows WordPress coding standards
        - label: All outputs are properly escaped (esc_html, esc_attr)
        - label: All inputs are properly sanitized
        - label: Functions are prefixed with 'skyworld_'
        - label: Design system classes are used consistently
        - label: Glass morphism effects work correctly
        - label: Mobile responsiveness is maintained
        - label: Performance impact is minimal

  - type: checkboxes
    id: testing-checklist
    attributes:
      label: Testing Checklist
      options:
        - label: Tested on local WordPress installation
        - label: PHP syntax validation passes
        - label: JavaScript console shows no errors
        - label: Mobile devices tested (iOS/Android)
        - label: Cross-browser compatibility verified
        - label: ACF fields function correctly
        - label: Page load performance is acceptable

  - type: textarea
    id: strain-data
    attributes:
      label: Strain Data Verification
      description: If this PR involves strain data, confirm authenticity
      placeholder: |
        **Strain Names Used:**
        - Stay Puft ✓ (authentic Skyworld genetics)
        - Garlic Gravity ✓ (authentic Skyworld genetics)
        
        **Data Sources:**
        - Official Skyworld strain information
        - Lab-tested cannabinoid profiles
        - Authentic terpene analysis results
        
        **No fabricated data used** ✓

  - type: textarea
    id: visual-changes
    attributes:
      label: Visual Changes
      description: If UI changes are included, describe them
      placeholder: |
        **Design System Components Used:**
        - .strain-tag-glass for glass morphism strain indicators
        - .u-mode-matte-black for ultra-clean black aesthetic
        - .cannabinoid-indicator-glass for THC/CBD displays
        
        **Brand Compliance:**
        - Skyworld orange (#FF8C00) used consistently
        - Professional cannabis industry styling maintained
        - Mobile-first responsive design preserved

  - type: textarea
    id: screenshots
    attributes:
      label: Screenshots
      description: Add screenshots of visual changes (before/after if applicable)
      placeholder: |
        **Before:**
        [Upload screenshot]
        
        **After:**
        [Upload screenshot]
        
        **Mobile View:**
        [Upload mobile screenshot]

  - type: checkboxes
    id: final-checklist
    attributes:
      label: Final Review Checklist
      options:
        - label: I have read the CONTRIBUTING.md guidelines
        - label: My code follows the cannabis compliance requirements
        - label: I have tested these changes thoroughly
        - label: Documentation has been updated if necessary
        - label: This PR maintains the professional Skyworld brand standards