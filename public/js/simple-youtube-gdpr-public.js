/**
 * Loops in all ```.syg__box```
 * Assign onClick for each item`s button
 */
function element_lazyload() {
    var elements = document.querySelectorAll(".syg__box");

    // if we don't have elements -> return
    if (typeof (elements) === 'undefined' || elements === null || !elements) {
        console.warn('No elements found');
        return;
    }

    for (var i = 0; i < elements.length; i++) {// loop in all elements boxes
        // Get Play Button
        var syg__box__text__btn = elements[i].getElementsByClassName('syg__box__text__btn')[0];
        // if we don't have elements play button -> return
        if (typeof (syg__box__text__btn) === 'undefined' || syg__box__text__btn === null || !syg__box__text__btn) {
            console.warn('No Load Element Button found');
            continue;
        }
        // Put click events on Play buttons
        syg__box__text__btn.addEventListener("click", function () {
            var syg__box = this.parentNode.parentNode;
            var embed__wrapper = this.parentNode.parentNode.parentNode;
            // Get Text
            var syg__box__text = syg__box.getElementsByClassName('syg__box__text')[0];
            // if we don't have video text -> return
            if (typeof (syg__box__text) === 'undefined' || syg__box__text === null || !syg__box__text) {
                console.warn('No Text found');
                return;
            }
            // Find HTML in hidden <template>
            var template = syg__box.querySelector('.syg__box__html');
            template.innerHTML = template.innerHTML.replace('srcblockloading', 'src');// now load scripts! You WERE <template>!!!!

            // Test to see if the browser supports the HTML template element by checking
            // for the presence of the template element's content attribute.
            if (template.content) {
                var clone = document.importNode(template.content, true);
                embed__wrapper.appendChild(clone);
            } else {
                // Find another way to add the rows to the table because
                // the HTML template element is not supported.
                var cloneDiv = document.createElement('div');
                cloneDiv.innerHTML = template.innerHTML.trim();
                embed__wrapper.appendChild(cloneDiv);
            }
            // Get element Type
            var type = template.getAttribute('data-type');

            
/* Premium Code Stripped by Freemius */


            // Remove .syg__box
            embed__wrapper.removeChild(syg__box);

        });
    }// for youtube
}

/**
 * Running code when the document is ready
 *
 * @author https://plainjs.com/javascript/events/running-code-when-the-document-is-ready-15/
 * @param callback
 */
function ready(callback) {
    // in case the document is already rendered
    if (document.readyState != 'loading') callback();
    // modern browsers
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    // IE <= 8
    else document.attachEvent('onreadystatechange', function () {
            if (document.readyState == 'complete') callback();
        });
}

// Running code when the document is ready
ready(function () {
    // do something
    element_lazyload();
});