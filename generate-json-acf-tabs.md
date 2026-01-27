# HTML to ACF JSON (TAB-based Sections with Visibility Toggle)

## OVERVIEW

Your task is to analyze the provided HTML and generate an **Advanced Custom Fields (ACF) JSON** structure.

⚠️ IMPORTANT CHANGE:
- DO NOT use a single long Flexible Content list
- EACH SECTION must be separated by **ACF TAB**
- EACH SECTION must have a **toggle field (true/false)** to control visibility

This structure is designed for:
- Better UX for content editors
- Clear section separation
- Easy enable/disable per section

---

## STEP 1 — GENERATE ACF JSON ONLY

### Your responsibilities:
- Analyze the **entire HTML page**
- Identify all sections (usually `<section>` blocks)
- Generate **complete ACF JSON**
- DO NOT output any PHP or HTML
- DO NOT fill content values
- After finishing, STOP and wait for approval of Step 2

---

## FIELD GROUP STRUCTURE (MANDATORY)

### 1️⃣ Main Field Group

```json
{
  "key": "group_[page_name]",
  "title": "[Page Name]",
  "fields": [],
  "location": [
    [
      {
        "param": "page_template",
        "operator": "==",
        "value": "template-[page_name].php"
      }
    ]
  ],
  "active": true
}
SECTION STRUCTURE (TAB-BASED)
Each section MUST follow this pattern:

2️⃣ TAB + VISIBILITY TOGGLE + CONTENT FIELDS
json
Sao chép mã
{
  "key": "tab_[section_name]",
  "label": "[Section Name]",
  "name": "",
  "type": "tab",
  "placement": "top"
},
{
  "key": "field_[section_name]_enable",
  "label": "Enable section",
  "name": "enable_section",
  "type": "true_false",
  "ui": 1,
  "default_value": 1
}
Then define all content fields for that section below the toggle.

FIELD MAPPING RULES
HTML Element	ACF Field Type
h1, h2, h3	text
p	wysiwyg
img	image
a	link
background image	image
repeating block	repeater
nested block	group

REPEATER RULES
Always use repeater for sliders, lists, cards

Repeater fields must contain all related sub-fields

No hardcoded limits unless stated in HTML

FORM RULES (IMPORTANT)
If the HTML section is a FORM:

DO NOT create ACF fields for inputs

Output must follow Contact Form 7 syntax

Layout must follow this structure:

html
Sao chép mã
<div class="wrap-form">
  <div class="form-group">
    [text* ho-va-ten placeholder "Họ và tên"]
  </div>
  <div class="form-group">
    [email* email placeholder "Email"]
  </div>
  <div class="form-group">
    [tel* so-dien-thoai placeholder "Số điện thoại"]
  </div>
  <div class="form-group col-span-2">
    [textarea noi-dung placeholder "Nội dung"]
  </div>
  <div class="frm-btnwrap">
    <button class="btn btn-primary">
      <span>GỬI</span>
      <em class="fa-solid fa-chevron-right"></em>
    </button>
  </div>
</div>
NAMING CONVENTIONS (STRICT)
Field key: field_[section]_[name]

Field name: snake_case

Tab key: tab_[section_name]

Image fields always named clearly (e.g. background_image, item_image)

STEP 2 — IMPLEMENT HTML (ONLY AFTER APPROVAL)
⚠️ DO NOT DO THIS STEP UNTIL ASKED

When asked:

Output PHP template code

Keep HTML structure 100% unchanged

Only replace content with ACF values

DO NOT use esc_html

Use utility functions for images only:

php
Sao chép mã
get_image_attrachment($image);
get_image_attrachment($image, 'url');
get_image_post($id);
FILE STRUCTURE (MANDATORY)
php
Sao chép mã
// File: page-[page_name].php
<?php
/*
Template name: Page - [Page Name]
*/
get_header();

if (have_rows('[page_name]_sections')):
  while (have_rows('[page_name]_sections')): the_row();
    if (get_sub_field('enable_section')):
      get_template_part('modules/[page_name]/[layout_name]');
    endif;
  endwhile;
endif;

get_footer();

modules/[page_name]/[section_name].php
FINAL RULES (ABSOLUTE)
❌ Do not change HTML classes

❌ Do not change DOM structure

❌ Do not output explanation

✅ JSON first, HTML later

✅ Tabs + toggle for every section