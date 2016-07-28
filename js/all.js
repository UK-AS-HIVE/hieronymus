/**
 * A single file to load all JS for the style guide.
 * This is a placeholder until a proper JS compile task
 * can be put together using browserify
 */

/**
* Accordion
 * based on https://github.com/18F/web-design-standards/blob/18f-pages-staging/src/js/components/accordion.js
 * NOTE: released as CC0 1.0 public domain from the above source
**/

function Accordion($el) {
    var self = this;
    this.$root = $el;
    this.$root.addEventHandler('click', function(ev) {
        console.log('click');
        var expanded = JSON.parse($el.getAttribute('aria-expanded'));
        ev.preventDefault();
        self.hideAll();
        if (!expanded) {
            self.show($el);
        }
    });
}

Accordion.prototype.$ = function(selector) {
    return this.$root.find(selector);
}

Accordion.prototype.hide = function($button) {
    var selector = $button.getAttribute('aria-controls');
    var $content = this.getElementById(selector);

    $button.setAttribute('aria-expanded', false);
    $content.setAttribute('aria-hidden', true);
};

Accordion.prototype.show = function($button) {
    var selector = $button.getAttribute('aria-controls');
    var $content = this.getElementById(selector);

    $button.setAttribute('aria-expanded', true);
    $content.setAttribute('aria-hidden', false);
};

Accordion.prototype.hideAll = function() {
    var self = this;
    var buttons = this.querySelectorAll('button')
    Array.prototype.forEach.call(buttons, function(el, i) {
        self.hide(el);
    });
};

var accordions = document.querySelectorAll('[class^=uk-accordion]')
Array.prototype.forEach.call(accordions, function(el, i) {
    new Accordion(el);
});


/**
 * Search bar
 */

function Searchbar($el) {
    var self=this;
    this.$root = $el;
    this.$root.querySelector('button').addEventListener('click', function(ev){
        self.$root.setAttribute('aria-hidden', true);
    })
}

//TODO: resolve modified versions
var searchbars = document.querySelectorAll('.uk-search-bar');
Array.prototype.forEach.call(searchbars, function (el, i) {
    new Searchbar(el);
});


/**
 * * Search button
 */

function SearchButton($el) {
    $el.addEventListener('click', function(ev){
        //get the target ID
        var targetId = ev.currentTarget.getAttribute('aria-controls');
        var searchbar = document.getElementById(targetId)
        searchbar.setAttribute("aria-hidden", false)
        searchbar.querySelector('input[type="search"]').focus();
    });
}

var buttons = document.querySelectorAll('.uk-global-header__search-button button');
Array.prototype.forEach.call(buttons, function (el, i) {
    new SearchButton(el);
});


