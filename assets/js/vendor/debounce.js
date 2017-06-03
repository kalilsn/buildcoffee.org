//Taken from underscore via https://davidwalsh.name/javascript-debounce-function
function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) {
                func.apply(context, args);
            }
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) {
            func.apply(context, args);
        }
    };
}

//Also from underscore (http://underscorejs.org/docs/underscore.html)
function throttle(func, wait, options) {
    var context, args, result;
    var now = Date.now || function() {
        return new Date().getTime();
    };
    var timeout = null;
    var previous = 0;
    if (!options) {
        options = {};
    }
    var later = function() {
        previous = options.leading === false ? 0 : now();
        timeout = null;
        result = func.apply(context, args);
    if (!timeout) {
        context = args = null;
    }
    };
    return function() {
        var n = now();
        if (!previous && options.leading === false) {
            previous = n;
        }
        var remaining = wait - (n - previous);
        context = this;
        args = arguments;
        if (remaining <= 0 || remaining > wait) {
        if (timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        previous = n;
        result = func.apply(context, args);
        if (!timeout) {
            context = args = null;
        }
        } else if (!timeout && options.trailing !== false) {
            timeout = setTimeout(later, remaining);
        }
        return result;
    };
}
