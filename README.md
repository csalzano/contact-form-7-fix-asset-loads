# Contact Form 7 - Fix Asset Loads

Contact Form 7 loads its JavaScript and CSS on every front-end page, even when no form is present. That unused payload slows pages that do not need it.

This add-on waits until a form actually renders, then loads the assets. Pages without a form never get the extra CSS or JS. Styles that would have run in the header are deferred to the footer so the decision can happen after the content.

No settings. Activate it alongside Contact Form 7 and it just works.
