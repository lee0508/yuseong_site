// index,js
function includeHTML(callback) {
    var z, i, elemnt, file, xhr;
    z = document.getElementsByTagName('*');
    for (i = 0; i < z.length; i++) {
        elemnt = z[i];
        file = elemnt.getAttribute('include-html');
        console.log(file);
        if (file) {
            xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        elemnt.innerHTML = this.responseText;
                    }
                    if (this.status == 404) {
                        elemnt.innerHTML = "Page not found";
                    }
                    elemnt.removeAttribute("include-html");
                    includeHTML(callback);
                }
            };            
            xhr.open('GET', file, true);
            xhr.send();
            return;
        }
    }
    setTimeout(function() {
        callback;
    }, 0);
}