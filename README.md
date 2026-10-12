# Contact Form 7 - Fix Asset Loads

> [!WARNING]
> This plugin is no longer maintained and will not receive updates. Use [Julienne](https://github.com/breakfastco/julienne) instead. It includes this plugin’s Contact Form 7 behavior and more optimizations: Blocksy and Astra companion stylesheets, plus the same kind of cleanup for WPForms, WooCommerce, Paid Memberships Pro, Easy Digital Downloads, Elementor, and SVG Support.

Deactivate this plugin once Julienne is active. Both manage the same Contact Form 7 assets.

## What this plugin did

Contact Form 7 loads its JavaScript and CSS on every front-end page, even when no form is present. That unused payload slows pages that do not need it.

This add-on waits until a form actually renders, then loads the assets. Pages without a form never get the extra CSS or JS. Styles that would have run in the header are deferred to the footer so the decision can happen after the content.

No settings. Activate it alongside Contact Form 7 and it just works.
