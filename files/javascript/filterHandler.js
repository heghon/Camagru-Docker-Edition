// Definition of all the filters.

var videoElement = document.getElementById("videoFeed");
var picElement = document.getElementById("outputImage");
var filterElement1 = document.getElementById("Cadre1");
var filterElement2 = document.getElementById("Cadre2");
var filterElement3 = document.getElementById("Cadre3");
var filterElement4 = document.getElementById("Cadre4");
var filterElement5 = document.getElementById("Cadre5");
var filterElement6 = document.getElementById("Cadre6");
var filterElement = document.getElementById("positionnedFilter");

// This function will change the filter element on the page to fit the chosen filter.

function putFilter(number) {
    id = "filter" + number;
    filterPath = document.getElementById(id).src;
    filterElement.src = filterPath;
}