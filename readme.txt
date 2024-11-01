=== Mortgage Rates by WPrequal ===
Contributors: wprequal, reblogdog
Donate link: https://wprequal.com/donate/
Tags: mortgage, rates, finance, real estate, realtors, wprequal
Requires at least: 4.0
Tested up to: 4.7
Stable tag: /trunk
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A very basic way to display mortgage rates as a widget or with a shortcode on your WordPress website.

== Description ==

Display mortgage rates as a widget or with a shortcode on your WordPress website. This widget is mobile responsive and adjusts to any sidebar on any device. Or, you can use a shortcode to display mortgage rates anywhere on any page or post.

[WPrequal](https://wprequal.com "WPrequal Homepage") uses an external api to update the Mortgage Rates form.

__Shortcode__

Use the shortcode on any page:

`[wprequal_rates state="AZ"]`

The 2 letter state code is required for shortcodes. 

AL - Alabama
AK - Alaska
AZ - Arizona
AR - Arkansas
CA - California
CO - Colorado
CT - Connecticut
DE - Delaware
FL - Florida
GA - Georgia
HI - Hawaii
ID - Idaho
IL - Illinois
IN - Indiana
IA - Iowa
KS - Kansas
KY - Kentucky
LA - Louisiana
ME - Maine
MD - Maryland
MA - Massachusetts
MI - Michigan
MN - Minnesota
MS - Mississippi
MO - Missouri
MT - Montana
NE - Nebraska
NV - Nevada
NH - New Hampshire
NJ - New Jersey
NM - New Mexico
NY - New York
NC - North Carolina
ND - North Dakota
OH - Ohio
OK - Oklahoma
OR - Oregon
PA - Pennsylvania
RI - Rhode Island
SC - South Carolina
SD - South Dakota
TN - Tennessee
TX - Texas
UT - Utah
VT - Vermont
VA - Virginia
WA - Washington
WV - West Virginia
WI - Wisconsin
WY - Wyoming

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/wprequal-rates` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Navigate to WP Admin > Appearance > Widgets.
4. Set WPrequal widget into any widget area. 
5. Select your state.
6. Make sure to press save.

= Usage =

* Add the following code: `<?php do_action( 'display_wprequal_rates_body', $state ); ?>` to your template where you would like the rates form to appear. Set $state to the desired 2 letter state code.
* or
* Add the shortcode `[wprequal_rates state="AZ"]` to your page or post and configure default parameters.

= Shortcode parameters =

* state = any 2 letter US state code.

= Shortcode example =

`[wprequal_rates state="TX"]`


== Frequently Asked Questions ==

= Can I add the Mortgage Retes anywhere on my website? =

Yes. Both widget and shortcode are available. We also provide a WP action hook for advanced users.

== Screenshots ==

1. /assets/screenshot-1.png
2. /assets/screenshot-2.png

== Changelog ==

= 1.0.1 =

* bug fix - display location using shortcode
* allow for rates from multiple states on same site

= 1.0 =

* None

== Upgrade Notice ==

= 1.0.1 =

* Minor bug fixes. Upgrade recommended.