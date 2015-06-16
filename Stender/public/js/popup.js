/**
 * Opens a pop-up in the center of current browser window.
 *
 * @param name The name of the pop-up. The name should not contain any whitespace characters.
 *  Also it should not end with "Popup" because that is automatically added.
 * @param url The URL to open in the pop-up.
 * @param height The height of the pop-up.
 * @param width The width of the pop-up.
 * @returns {boolean} Return false. Return (the result) of this method
 *  in the event where it is called (for example in the onclick event) to
 *  prevent the browser from following the actual link.
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

    var attr = "height=" + height + ", width=" + width + ", top=" + top + ", left=" + left + ", menubar=no, location=yes, toolbar=no, status=yes, resizable=yes, scrollbars=yes";
    // If a pop-up with the same is already open, it will return the object reference/window handle. Otherwise it will open a new pop-up.
    // Pass the first parameter (url) as an empty string, so that the page will not get redirected if the pop-up is already open and on the correct page.
    var popupWindow = window.open("", (name + "Popup"), attr);

    // Redirect the page of the pop-up if it is not on the correct page.
    if (popupWindow.location != url)
    {
        popupWindow.location = url;
    }

    // Always give the focus to the pop-up
    if (window.focus)
    {
        popupWindow.focus()
    }

    // Make it possible to prevent the browser from following the actual link
    return false;
}