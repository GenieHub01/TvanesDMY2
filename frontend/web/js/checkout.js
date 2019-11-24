/*global $, alert , console */

$(function () {
    'use strict';
    
    
    
    new NiceCountryInput($("#country-sel")).init();

    
});

function onChangeCallback(ctr) {
    
    'use strict';

    console.log("The country was changed: " + ctr);

}
          
