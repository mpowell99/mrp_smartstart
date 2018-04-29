# MRP SmartStart

**Contributors:** mpowell99
**Requires at least:** WordPress 4.4  
**Tested up to:** WordPress 4.9.5  
**Stable tag:** 1.0  
**Version:** 1.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

## Description

A sample theme developed to mirror the static HTML page for SmartStart

## Installation and Configuration
MRP SmartStart Theme
Installation and Configuration Steps

1. Install the theme
`# cd wp-config/themes/`
`# git clone https://github.com/mpowell99/mrp_smartstart`


1. Activate theme from WP-Admin


1. Install plugins
 * Advanced Custom Fields
 * Contact Form 7
 * WP-PageNavi


1. Add New Custom Fields
**Field Group:** Position
*Fields*
Label | Name | Type
----- | ---- | ----
Position | position | text

*Location:*
Show this field group if {post type} {is equal to} {team}

**Field Group:** Social Media
*Fields:*
Label | Name | Type
----- | ---- | ----
Twitter | twitter | Text
Facebook | facebook | Text
Skype | skype | Text
LinkedIn | linkedin | Text
Google Plus | googleplus | Text
Email | email | Email
*Location:*
Show this field group if {post type} {is equal to} {team}

**Field Group: Website**
*Fields:*
Label | Name | Type
----- | ---- | ----
Website | website | text

*Location:*
Show this field group if {post type} {is equal to} {portfolio}


1. Configure the Contact Form
Edit "Contact form 1" and paste in following:

`<p class="input-block">
<label> <strong>Your Name</strong> (required)
    [text* your-name] </label>
</p>

<p class="input-block">
<label> <strong>Your Email</strong> (required)
    [email* your-email] </label>
</p>

<p class="input-block">
<label> <strong>Subject</strong>
    [text your-subject] </label>
</p>

<p class="textarea-block">
<label> <strong>Your Message</strong>
    [textarea your-message] </label>
</p>

[submit "Send"]`

Then add the short-code to the Contact Page


1. Customize the Theme
**Site Identity**
	*Logo:* Add Logo

**Custom Headers**
	Provide appropriate headers and descriptions to each field.

**Contact Page Settings**


1. Add Some Team Members


1. Add Some Projects
*Don't forget to mark four of them as "Featured"*


1. Add Some Blog Posts



## Changelog

### 1.0
* Released: April 29, 2018

Initial release
