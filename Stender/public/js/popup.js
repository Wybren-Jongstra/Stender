/**
 * Global var for keeping track of the open pop-up windows.
 * The code below will update this variable automatically.
 */
var popupWindowHandlers = {};

/**
 * Removes a pop-up from the list with open pop-up windows
 *
 * @param name The full name of the pop-up.
 */
function removePopupWindowHandler(name)
{
    // Find and remove item from popupWindowHandlers
    // Otherwise there is a problem with the code, so then throw an error.
    if(popupWindowHandlers[name])
    {
        delete popupWindowHandlers[name];
    }
    else
    {
        throw new TypeError("Pop-up with " + name + " doesn't exists in the array with pop-ups");
    }
}

/**
 * Find links that are pop-ups and activates the pop-up behaviour.
 *
 * An link that should behaves as a pop-up must have the following (data) attributes:
 * href="{link}"                The normal href attribute. The link to open in the pop-up.
 * data-rel="popup"             Used to detect if it is a pop-up.
 * data-popup-name="{name}"     @see The name parameter of openWindowCentredPopup.
 * data-popup-height="{height}" @see The height parameter of openWindowCentredPopup.
 * data-popup-width="{width}"   @see The width parameter of openWindowCentredPopup.
 *
 */
function findPopups()
{
    // Find popups
    for (var popups = document.getElementsByTagName("a"), i = 0; i < popups.length; i++)
    {
        if(popups[i].getAttribute("data-rel") == "popup")
        {
            // Add event with an event listener so it doesn't overwrite existing events.
            addEvent(popups[i], 'click', doOpenPopup);
        }
    }
}

/**
 * Adds an event to an element.
 * Takes care of older browser versions.
 *
 * @param elem      The element to which the event should be attached
 * @param eventType The type of the event. This name is without 'on'.
 * @param funct     The function that must be called when the event fires.
 * @returns {*}
 */
function addEvent(elem, eventType, funct){
    // Support older versions of IE
    if (elem.attachEvent)
    {
        return elem.attachEvent("on" + eventType, eventHandle);
    }
    else
    {
        // Support older version of Firefox
        return elem.addEventListener(eventType, funct, false);
    }
}

/**
 * Opens the pop-up in the right way.
 *    - Initializes the pop-up
 *    - Opens the pop-up.
 *    - Cancels the browsers default link action
 *    - Prevents the event from bubbling up
 * @param event The event object. It will passed by the browser automatically.
 * According to http://stackoverflow.com/a/5849454 this will even work in older versions of IE.
 */
function doOpenPopup(event)
{
    // Check if all the needed data attributes exists
    if( !this.getAttribute("data-popup-name") )
    {
        throw new TypeError("data-popup-name attribute is undefined");
    }
    else if( !this.getAttribute("data-popup-height") )
    {
        throw new TypeError("data-popup-height attribute is undefined");
    }
    else if( !this.getAttribute("data-popup-width") )
    {
        throw new TypeError("data-popup-width attribute is undefined");
    }
    else
    {
        openWindowCentredPopup(this.getAttribute("data-popup-name"), this.href, this.getAttribute("data-popup-height"), this.getAttribute("data-popup-width"));

        // Cancel the browsers default link action.
        if (event.preventDefault) // check if function exists
        {
            event.preventDefault();
        }
        else if (event.returnValue) // check for boolean value
        {
            // At this moment the above (standard) methods didn't work.
            // But this browser has support for the event.returnValue.
            // Supported by older versions of IE
            event.returnValue = false;
        }

        // Prevent the event from bubbling up so that no other/'higher level' listeners are called.
        if (! event.stopPropagation)  // check if function exists
        {
            event.stopPropagation();
        }
        else if ( ! event.returnValue) // check for boolean value
        {
            // At this moment the above (standard) methods didn't work.
            // But this browser has support for the event.returnValue
            // Support: older versions of IE, Firefox
            event.cancelBubble = true;
        }
    }
}

/**
 * Opens a pop-up in the center of current browser window.
 * When the pop-up is already open, it will focus that window and will, if needed, go to the correct URL.
 *
 * @param name The name of the pop-up. The name should not contain any whitespace characters.
 *  Also it should not end with "Popup" because that is automatically added.
 * @param url The URL to open in the pop-up.
 * @param height The height of the pop-up.
 * @param width The width of the pop-up.
 */
function openWindowCentredPopup(name, url, height, width)
{
    // Get the position of the window on the screen.
    // Works with dual screen monitors.
    var windowLeft = window.screenLeft ? window.screenLeft : window.screenX;
    var windowTop  = window.screenTop ? window.screenTop : window.screenY;

    var windowWidth = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth;
    var windowHeight = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight;

    /*
     * Try to center the pop-up in the middle of the window.
     * According to the standard it will not work when it will cause that the pop-up flows out of the screen.
     * If needed, correct the pop-up position with an offset so it won't hide the parent window.
     * This offset is based on the heights of browsers from different vendors.
     * It should be the same for the left and the top.
     */
    var offset = 55;
    var left = (windowLeft + (windowWidth / 2) - (width / 2)) > windowLeft ? (windowLeft + (windowWidth / 2) - (width / 2)) : windowLeft + offset;
    var top = (windowTop + (windowHeight / 2) - (height / 2)) > windowTop ? (windowTop + (windowHeight / 2) - (height / 2)) : windowTop + offset;

    // Some pop-up parameters
    var attr = "height=" + height + ", width=" + width + ", top=" + top + ", left=" + left + ", menubar=no, location=yes, toolbar=no, status=yes, resizable=yes, scrollbars=yes";
    var popupName = name + "Popup";

    // Some sites changes the name of the pop-up. Therefore an new pop-up will be opened instead of the already opened pop-up.
    // So save the pop-up window handlers by ourselves and try first to retrieve them.
    if(popupWindowHandlers[popupName] && ! popupWindowHandlers[popupName].closed)
    {
        popupWindow = popupWindowHandlers[popupName];
    }
    else if (popupWindowHandlers[popupName] === null)
    {
        // Prevent the creation of several identical pop-ups
        return;
    }
    else
    {
        // Enables the prevention of the creation of several identical pop-ups
        popupWindowHandlers[popupName] = null;
        // If a pop-up with the same name is already open, it will return the object reference/window handle. Otherwise it will open a new pop-up.
        // Pass the first parameter (url) as an empty string, so that the page will not get redirected if the pop-up is already open and on the correct page.
        popupWindowHandlers[popupName] = popupWindow = window.open(url, popupName, attr);
    }

    // If possible redirect the page of the pop-up if it is not on the correct page.
    try
    {
        if (popupWindow.location != url)
        {
            popupWindow.location = url;
        }
    }
    catch(e)
    {
        console.log(e)
    }

    // Always give the focus to the pop-up
    if (window.focus)
    {
        popupWindow.focus()
    }
}