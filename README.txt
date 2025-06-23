=== MP Smart Content Timekeeper ===
Contributors: mayankbpandya
Tags: reading time, content engagement, progress bar, reading goals, time tracking
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Enhance user engagement with smart reading time estimates and interactive progress tracking.

== Description ==

MP Smart Content Timekeeper helps content creators improve reader engagement by displaying:

✅ Estimated reading time
✅ Interactive progress bar
✅ Customizable progress bar colors
✅ Reading goal system
✅ Mobile-responsive design

= Key Features =
- Automatic reading time calculation based on content length
- Sticky progress bar with customizable colors
- Reading goal setting functionality
- Shortcode support for goal widgets
- WordPress Customizer integration
- GDPR-friendly implementation (uses localStorage)

= Why Choose This Plugin? =
- Lightweight (under 100KB total assets)
- No external dependencies
- Translation-ready
- Follows WordPress coding standards
- Regular updates and maintenance

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/mp-smart-content-timekeeper` directory
2. Activate the plugin through the 'Plugins' screen
3. Configure settings under Settings > Content Timekeeper
4. Add reading goal shortcode: [mp_reading_goal]

== Frequently Asked Questions ==

= How accurate is the reading time calculation? =
Based on configurable words-per-minute (default 200 WPM). Adjust in settings.

= Can I change the progress bar color? =
Yes! Customize it in the plugin settings using the color picker.

= Does this work with page builders? =
Yes, compatible with Gutenberg and major page builders.

= Is this plugin translation-ready? =
Yes, includes .pot file in /languages directory.

= How to position the progress bar? =
It's automatically fixed at the top of the viewport.

== Screenshots ==

1. Progress bar and reading time display on single post
2. Reading goal widget with time selection
3. Plugin settings screen with color picker
4. Mobile-responsive progress bar display

== Changelog ==

= 1.0.0 =
* Initial release
* Features: Reading time calculator, progress bar, goal system
* Admin settings: Color picker, WPM configuration

== Upgrade Notice ==

= 1.0.0 =
Initial plugin release

== Guidelines Compliance ==

This plugin follows all WordPress.org plugin directory requirements:

✔️ PHP/JS best practices
✔️ Proper escaping/sanitization
✔️ Nonce verification
✔️ No hidden code/links
✔️ GPL-compliant licensing
✔️ Validated readme formatting
✔️ Proper script/style enqueuing
✔️ No premium upsells

== Important Submission Notes ==

Before submission, ensure:

1. License header exists in all PHP files
2. All code is original or properly attributed
3. Screenshots are actual plugin images (recommended size: 772x250px)
4. Tested with WordPress PHPCSS and PHPStan
5. No debug code remains
6. Translation files are properly formatted
7. Documentation matches actual functionality

== Internationalization ==

Translations are welcome! The plugin includes:
- Full text domain support (`mp-sct-content-timekeeper`)
- .pot file in /languages directory
- RTL CSS support