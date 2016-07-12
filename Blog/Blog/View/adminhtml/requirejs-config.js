/**
 * @copyright Copyright (c) 2016 www.magebuzz.com
 */

var config = {
    map: {
        '*': {
            customerSuggest: 'MageBuzz_Blog/js/customer-suggest'
        }
    },
    paths: {
        'magebuzz/multifile': 'MageBuzz_Blog/js/jquery.MultiFile',
    },
    shim: {
        'magebuzz/multifile': {
            deps: ['jquery']
        }
    }
};
