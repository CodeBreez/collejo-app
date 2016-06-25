// Opera 8.0+
Collejo.browser.isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
// Firefox 1.0+
Collejo.browser.isFirefox = typeof InstallTrigger !== 'undefined';
// At least Safari 3+: "[object HTMLElementConstructor]"
Collejo.browser.isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
// Internet Explorer 6-11
Collejo.browser.isIE = /*@cc_on!@*/ false || !!document.documentMode;
// Edge 20+
Collejo.browser.isEdge = !Collejo.browser.isIE && !!window.StyleMedia;
// Chrome 1+
Collejo.browser.isChrome = !!window.chrome && !!window.chrome.webstore;
// Blink engine detection
Collejo.browser.isBlink = (Collejo.browser.isChrome || Collejo.browser.isOpera) && !!window.CSS;